<?php

namespace App\Http\Controllers;

use App\Models\CourtCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourtCategoriesController extends Controller
{
    /**
     * Menampilkan daftar kategori lapangan (admin only)
     */
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = CourtCategories::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('category_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $query->latest()->paginate(10)->withQueryString();

        return view('admin.court-categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.court-categories.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        CourtCategories::create($validated);

        return redirect()
            ->route('court-categories.index')
            ->with('success', 'Kategori lapangan berhasil ditambahkan.');
    }

    /**
     * Form edit kategori
     */
    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $category = CourtCategories::findOrFail($id);

        return view('admin.court-categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $category = CourtCategories::findOrFail($id);

        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()
            ->route('court-categories.index')
            ->with('success', 'Kategori lapangan berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        CourtCategories::findOrFail($id)->delete();

        return redirect()
            ->route('court-categories.index')
            ->with('success', 'Kategori lapangan berhasil dihapus.');
    }
}
