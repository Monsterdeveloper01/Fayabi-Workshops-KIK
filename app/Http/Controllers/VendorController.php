<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    // 1. Halaman Dashboard Vendor
    public function index()
    {
        // Ambil produk HANYA milik vendor yang sedang login
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('vendor.dashboard', compact('products'));
    }

    // 2. Halaman Tambah Produk (Form)
    public function create()
    {
        // Ambil semua kategori untuk Dropdown (LOV)
        $categories = Category::all();
        return view('vendor.create', compact('categories'));
    }

    public function products(Request $request)
{
    // 1. Base Query: Ambil produk milik vendor yang login
    $query = Product::where('user_id', Auth::id());

    // 2. Logika Filter Statistik
    $filter = $request->query('filter');
    $title = 'Semua Produk'; // Judul default

    switch ($filter) {
        case 'termahal':
            $query->orderBy('price', 'desc');
            $title = 'Produk Sultan (Termahal)';
            break;
            
        case 'termurah':
            $query->orderBy('price', 'asc');
            $title = 'Produk Hemat (Termurah)';
            break;

        case 'terlaku':
            // Asumsi: Stok paling sedikit = Paling Laku (Sementara, sebelum ada tabel transaksi)
            $query->orderBy('stock', 'asc'); 
            $title = 'Paling Laku / Stok Menipis';
            break;

        case 'jarang_dibeli':
            // Asumsi: Stok masih banyak & update terakhir sudah lama
            $query->orderBy('stock', 'desc')->orderBy('updated_at', 'asc');
            $title = 'Stok Menumpuk (Jarang Dibeli)';
            break;

        default:
            $query->latest(); // Default: Terbaru
            break;
    }

    // 3. Eksekusi dengan Pagination (12 produk per halaman)
    $products = $query->paginate(12)->withQueryString();

    return view('vendor.products', compact('products', 'filter', 'title'));
}

    // 3. Proses Simpan Produk ke Database
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Simpan Data
        Product::create([
            'user_id' => Auth::id(), // ID Vendor Otomatis
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'brand' => $request->brand,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'condition' => $request->condition,
            'description' => $request->description,
            'compatibility' => $request->compatibility,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.dashboard')->with('status', 'Produk Berhasil Dijual!');
    }
}