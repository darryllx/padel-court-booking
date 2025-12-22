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

        // Fitur Search (Nama Lapangan atau Lokasi)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('court_name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Fitur Filter: Berdasarkan Kategori
        if ($request->filled('category_id')) {
            $query->where('court_category_id', $request->input('category_id'));
        }

        // Fitur Filter: Berdasarkan Status Ketersediaan (Available / Not)
        if ($request->filled('is_available')) {
            $query->where('is_available', $request->input('is_available'));
        }

        $courts = $query->paginate(10)->withQueryString();
        
        // Kirim data categories untuk opsi filter di view
        $categories = CourtCategories::all();

        return view('courts.index', compact('courts', 'categories'));
    }


    public function create()
    {
        // Ambil data kategori untuk dropdown select option
        $categories = CourtCategories::all();
        return view('courts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'court_category_id' => 'required|exists:court_categories,id',
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'boolean', // Checkbox untuk ketersediaan
        ]);

        $validated['is_available'] = $request->has('is_available');

        Courts::create($validated);

        return redirect()->route('courts.index')
                         ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $court = Courts::with('courtCategory')->findOrFail($id);
        return view('courts.show', compact('court'));
    }

    public function edit(string $id)
    {
        $court = Courts::findOrFail($id);
        $categories = CourtCategories::all();
        return view('courts.edit', compact('court', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $court = Courts::findOrFail($id);

        $validated = $request->validate([
            'court_category_id' => 'required|exists:court_categories,id',
            'court_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'boolean',
        ]);
        
        // Handle checkbox update
        $validated['is_available'] = $request->has('is_available');

        $court->update($validated);

        return redirect()->route('courts.index')
                         ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $court = Courts::findOrFail($id);
        $court->delete();

        return redirect()->route('courts.index')
                         ->with('success', 'Lapangan berhasil dihapus.');
    }
}
