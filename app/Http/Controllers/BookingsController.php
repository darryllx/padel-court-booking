<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Courts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $query = Bookings::with(['user', 'court'])->latest();

        // 🔍 Search: user name ATAU customer name (guest)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%");
                })
                ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tanggal
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $courts = Courts::where('is_available', true)->get();

        return view('bookings.create', compact('courts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'court_id' => 'required|exists:courts,id',

            // Personal Info (WAJIB, editable)
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',

            'booking_date' => 'required|date',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'total_price'  => 'required|numeric|min:0',
        ]);

        // 🔐 Jika user login → isi user_id
        $validated['user_id'] = Auth::check() ? Auth::id() : null;

        // Default status
        $validated['status'] = 'Pending';

        Bookings::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dibuat.');
    }

    public function show(string $id)
    {
        $booking = Bookings::with(['user', 'court'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function edit(string $id)
    {
        $booking = Bookings::findOrFail($id);
        $courts  = Courts::where('is_available', true)->get();

        return view('bookings.edit', compact('booking', 'courts'));
    }

    public function update(Request $request, string $id)
    {
        $booking = Bookings::findOrFail($id);

        $validated = $request->validate([
            'court_id' => 'exists:courts,id',

            // Personal Info tetap editable
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',

            'booking_date' => 'date',
            'start_time'   => 'date_format:H:i',
            'end_time'     => 'date_format:H:i|after:start_time',
            'total_price'  => 'numeric|min:0',
            'status'       => 'in:Pending,Confirmed,Cancelled,Completed',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function myBookings()
    {
        $bookings = Bookings::with('court')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('mybookings', compact('bookings'));
    }

    public function processPayment(Request $request)
    {
        // 1. Validate Payment & Booking Data
        $validated = $request->validate([
            'payment_method' => 'required',
            'court_id'       => 'required|exists:courts,id',
            'booking_date'   => 'required|date',
            'start_time'     => 'required', 
            'total_price'    => 'required|numeric',
            'customer_name'  => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'notes'          => 'nullable|string',
        ]);

        // 2. Kalkulasi waktu berakhir
        $startTime = Carbon::createFromFormat('H:i', $validated['start_time']);

        // default 1 jam jika hours tidak dikirim
        $hours = $request->input('hours', 1);

        $endTime = $startTime->copy()->addHours($hours);

        // 3. Membuat Booking
        $booking = Bookings::create([
            'user_id'        => Auth::id(), // Nullable if guest, but protected by auth middleware usually
            'court_id'       => $validated['court_id'],
            'booking_date'   => $validated['booking_date'],
            'start_time'     => $startTime->format('H:i'),
            'end_time'       => $endTime->format('H:i'),
            'total_price'    => $validated['total_price'] * 1.05, // Store total with tax? Or sent from front? 
                                // Ideally recalculate server side for security. 
                                // For now using what's passed or recalculating:
                                // request('price') was subtotal. 
            'status'         => 'Confirmed', // Simulate successful payment
            'customer_name'  => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'notes'          => $validated['notes'] ?? null,
        ]);

        return redirect()
        ->route('booking.success', $booking->id)
        ->with('success', 'Payment successful and booking confirmed!');    
    }
}
