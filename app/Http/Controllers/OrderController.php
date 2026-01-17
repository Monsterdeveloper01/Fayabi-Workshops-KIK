<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrders(Request $request)
    {
        // Ambil status dari klik tab, default 'belum_bayar'
        $status = $request->query('status', 'belum_bayar');
        $userId = Auth::id();

        $query = Order::where('user_id', $userId)->with('items.product');

        // Logika Filter Status
        switch ($status) {
            case 'belum_bayar':
                $query->where('payment_status', 'unpaid')->where('status', 'pending');
                break;
            case 'dikemas':
                $query->where('payment_status', 'paid')->where('status', 'pending');
                break;
            case 'dikirim':
                $query->where('status', 'shipped');
                break;
            case 'selesai':
                $query->where('status', 'completed');
                break;
            case 'pembatalan':
                $query->where('status', 'cancelled');
                break;
        }

        $orders = $query->latest()->get();

        // Data rekomendasi produk acak
        $recommendations = Product::inRandomOrder()->take(4)->get();

        // Mengarahkan ke views/pesanan_saya/index.blade.php
        return view('pesanan_saya.index', compact('orders', 'status', 'recommendations'));
    }
}