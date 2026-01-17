<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Kategori tipe 'sparepart'
        // Kita gunakan 'with' untuk mengambil produk di dalamnya (Eager Loading)
        $categories = Category::where('type', 'sparepart')
            ->with(['products' => function($query) use ($request) {
                
                // --- LOGIKA FILTER PENCARIAN ---
                if ($request->has('search') && $request->search != '') {
                    $query->where('name', 'like', '%' . $request->search . '%')
                          ->orWhere('brand', 'like', '%' . $request->search . '%');
                }

                // --- LOGIKA FILTER KONDISI (Baru/Bekas) ---
                if ($request->has('condition')) {
                    $query->whereIn('condition', $request->condition);
                }
                
            }])
            ->get();

        return view('sparepart.index', compact('categories'));
    }
}