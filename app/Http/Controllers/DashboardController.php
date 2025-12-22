<?php

namespace App\Http\Controllers;

use App\Models\Courts;
use App\Models\CourtCategories;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

        return view('dashboard.courts.index', compact('courts', 'categories'));
    }

}