<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AksesorisController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil List Brand yang ada di database (khusus produk aksesoris)
        // Gunanya untuk mengisi Filter Sidebar secara otomatis
        $brands = Product::whereHas('category', function($q) {
            $q->where('type', 'aksesoris');
        })->select('brand')->distinct()->pluck('brand');

        // 2. Ambil Kategori tipe 'aksesoris' beserta produknya
        $categories = Category::where('type', 'aksesoris')
            ->with(['products' => function($query) use ($request) {
                
                // --- FILTER PENCARIAN (Nama Produk) ---
                if ($request->filled('search')) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                }

                // --- FILTER BRAND (Checkbox Sidebar) ---
                if ($request->filled('brands')) {
                    $query->whereIn('brand', $request->brands);
                }

                // --- FILTER HARGA ---
                if ($request->filled('min_price')) {
                    $query->where('price', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $query->where('price', '<=', $request->max_price);
                }
                
            }])
            ->get();

        return view('aksesoris.index', compact('categories', 'brands'));
    }
}