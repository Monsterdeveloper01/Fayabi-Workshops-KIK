<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\MotorSale; // PENTING: Harus di-import agar tidak error
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function myOrders(Request $request)
    {
        // 1. Inisialisasi data dasar
        $status = $request->query('status', 'belum_bayar');
        $userId = Auth::id();

        // 2. Ambil data Penjualan Motor milik user (Unit yang dia jual)
        $mySales = MotorSale::where('user_id', $userId)->latest()->get();

        // 3. Query untuk Pesanan Belanja (Sparepart/Aksesoris)
        $query = Order::where('user_id', $userId)->with('items.product');

        // 4. Logika Filter Status Pesanan
        switch ($status) {
            case 'belum_bayar':
                $query->where('payment_status', 'unpaid')->where('status', 'pending');
                break;
            case 'dikemas':
                // Biasanya status 'dikemas' adalah pesanan yang sudah lunas tapi status masih pending/processing
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

        // 5. Eksekusi Query
        $orders = $query->latest()->get();

        // 6. Ambil rekomendasi produk acak
        $recommendations = Product::inRandomOrder()->take(4)->get();

        // 7. Kirim ke View
        return view('pesanan_saya.index', compact('orders', 'status', 'recommendations', 'mySales'));
    }
}