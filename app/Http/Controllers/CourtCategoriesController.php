<?php

namespace App\Http\Controllers;

use App\Models\CourtCategories;
use Illuminate\Http\Request;

class CourtCategoriesController extends Controller
{
    
    public function index(Request $request)
    {
        $query = CourtCategories::query();

        // Fitur Search (Nama Kategori)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('category_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Pagination digunakan agar hasil search rapi
        $categories = $query->paginate(10)->withQueryString();

        return view('court_categories.index', compact('categories'));
    }

    
    public function create()
    {
        // Menampilkan form tambah
        return view('court_categories.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        CourtCategories::create($validated);

        return redirect()->route('court-categories.index')
                         ->with('success', 'Kategori lapangan berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $category = CourtCategories::findOrFail($id);
        return view('court_categories.show', compact('category'));
    }


    public function edit(string $id)
    {
        $category = CourtCategories::findOrFail($id);
        // Menampilkan form edit
        return view('court_categories.edit', compact('category'));
    }


    public function update(Request $request, string $id)
    {
        $category = CourtCategories::findOrFail($id);

        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('court-categories.index')
                         ->with('success', 'Kategori lapangan berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $category = CourtCategories::findOrFail($id);
        $category->delete();

        return redirect()->route('court-categories.index')
                         ->with('success', 'Kategori lapangan berhasil dihapus.');
    }
}
