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