<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Courts;
use App\Models\User;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $query = Bookings::with(['user', 'court'])->latest();

        // Fitur Search: Cari nama user yang booking
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Fitur Filter: Status Booking (Pending, Confirmed, etc)
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Fitur Filter: Tanggal Booking Tertentu
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->input('date'));
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $courts = Courts::where('is_available', true)->get();
        return view('bookings.create', compact('users', 'courts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'court_id' => 'required|exists:courts,id',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'total_price' => 'required|numeric|min:0',
            'status' => 'in:Pending,Confirmed,Cancelled,Completed'
        ]);
        
        // Jika status tidak diisi, maka default nya akan Pending
        if (!$request->filled('status')) {
            $validated['status'] = 'Pending';
        }

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
        $users = User::all();
        $courts = Courts::all(); 
        return view('bookings.edit', compact('booking', 'users', 'courts'));
    }

    public function update(Request $request, string $id)
    {
        $booking = Bookings::findOrFail($id);

        $validated = $request->validate([
            'court_id' => 'exists:courts,id',
            'booking_date' => 'date',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time',
            'total_price' => 'numeric|min:0',
            'status' => 'in:Pending,Confirmed,Cancelled,Completed'
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
}