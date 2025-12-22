<?php

namespace App\Http\Controllers;

use App\Models\Courts;
use App\Models\CourtCategories;
use Illuminate\Http\Request;

class CourtsController extends Controller
{
    public function index(Request $request)
    {
        $query = Courts::with('courtCategory');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('court_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('court_category_id', $request->input('category_id'));
        }

        $courts = $query->paginate(9)->withQueryString();
        $categories = CourtCategories::all();

        // PERHATIKAN: Memanggil view di folder admin/courts
        return view('admin.courts.index', compact('courts', 'categories'));
    }

    public function create()
    {
        $categories = CourtCategories::all();
        // PERHATIKAN: Memanggil view di folder admin/courts
        return view('admin.courts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'court_category_id' => 'required|exists:court_categories,id',
            'court_code'        => 'required|in:A,B,C',
            'location'          => 'required|string|max:255',
            'price_per_hour'    => 'required|numeric|min:0',
            'description'       => 'nullable|string',
            'is_available'      => 'boolean',
        ]);

        $category = CourtCategories::findOrFail($request->court_category_id);
        
        // Generate Nama Otomatis: "Indoor - Lapangan A"
        $generatedName = $category->name . ' - Lapangan ' . $request->court_code;

        // Cek Duplikasi
        if (Courts::where('court_name', $generatedName)->exists()) {
            return back()->withInput()->with('error', "Lapangan $generatedName sudah ada! Silakan pilih kode lain.");
        }

        Courts::create([
            'court_category_id' => $request->court_category_id,
            'court_name'        => $generatedName,
            'location'          => $request->location,
            'price_per_hour'    => $request->price_per_hour,
            'description'       => $request->description,
            'is_available'      => $request->has('is_available') ? 1 : 0,
        ]);

        return redirect()->route('courts.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $court = Courts::findOrFail($id);
        $categories = CourtCategories::all();
        
        // Ambil kode terakhir (A/B/C) dari nama lapangan
        $currentCode = substr($court->court_name, -1); 

        // PERHATIKAN: Memanggil view di folder admin/courts
        return view('admin.courts.edit', compact('court', 'categories', 'currentCode'));
    }

    public function update(Request $request, string $id)
    {
        $court = Courts::findOrFail($id);

        $request->validate([
            'court_category_id' => 'required|exists:court_categories,id',
            'court_code'        => 'required|in:A,B,C',
            'location'          => 'required|string|max:255',
            'price_per_hour'    => 'required|numeric|min:0',
            'description'       => 'nullable|string',
            'is_available'      => 'boolean',
        ]);

        $category = CourtCategories::findOrFail($request->court_category_id);
        $generatedName = $category->name . ' - Lapangan ' . $request->court_code;

        if ($court->court_name !== $generatedName && Courts::where('court_name', $generatedName)->exists()) {
            return back()->withInput()->with('error', "Lapangan $generatedName sudah ada!");
        }

        $court->update([
            'court_category_id' => $request->court_category_id,
            'court_name'        => $generatedName,
            'location'          => $request->location,
            'price_per_hour'    => $request->price_per_hour,
            'description'       => $request->description,
            'is_available'      => $request->has('is_available') ? 1 : 0,
        ]);

        return redirect()->route('courts.index')->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $court = Courts::findOrFail($id);
        $court->delete();
        return redirect()->route('courts.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}