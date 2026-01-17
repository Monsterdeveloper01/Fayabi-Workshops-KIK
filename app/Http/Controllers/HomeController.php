<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MotorSale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 4 Sparepart & Aksesoris terbaru
        $products = Product::latest()->take(4)->get();

        // 2. Ambil 4 Unit Motor yang statusnya 'reviewed' atau 'pending' (untuk dipajang)
        $motorUnits = MotorSale::latest()->take(4)->get();

        // 3. Kita kirim ke view welcome.blade.php
        return view('welcome', compact('products', 'motorUnits'));
    }
}