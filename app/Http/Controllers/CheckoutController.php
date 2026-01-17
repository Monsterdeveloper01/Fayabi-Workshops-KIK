<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    // 1. Tampilkan Halaman Checkout
   public function index()
    {
        // 1. Cek Apakah User Login?
        if (Auth::check()) {
            $user = Auth::user();

            // 2. CEK ALAMAT: Jika alamat kosong, paksa isi dulu
            if (empty($user->address_line) || empty($user->phone_number)) {
                return redirect()->route('profile.edit')
                    ->with('status', 'Harap lengkapi Alamat Pengiriman dan No. HP sebelum melakukan Checkout!');
            }

            // Ambil Cart dari Database
            $dbCarts = Cart::where('user_id', $user->id)->with('product.category')->get();
            $cartItems = [];

            foreach ($dbCarts as $item) {
                if($item->product) {
                    $cartItems[] = [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'image' => $item->product->image ? asset('storage/'.$item->product->image) : null,
                        'category' => $item->product->category->name ?? 'General',
                        'qty' => $item->qty
                    ];
                }
            }
        } else {
            // Jika Tamu (Guest)
            // Opsional: Kamu bisa memaksa login di sini jika mau
            // return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan checkout.');
            
            $cartItems = session()->get('cart', []);
        }

        if (empty($cartItems)) {
            return redirect('/')->with('error', 'Keranjang kosong!');
        }

        // Kirim data user juga ke view
        return view('checkout.index', compact('cartItems'));
    }
    // 2. Proses Simpan Order (Header & Detail)
    public function process(Request $request)
    {
        // Validasi
        $request->validate([
            'email' => 'required|email',
            'payment' => 'required',
        ]);

        // Gunakan DB Transaction agar kalau detail gagal, header gak kebuat (Aman!)
        DB::beginTransaction();

        try {
            $user = Auth::user(); // Bisa null kalau guest (opsional: harus login dulu sebaiknya)
            
            // Hitung Total (Ambil ulang dari DB/Session biar aman dari inspect element hack)
            $cartItems = [];
            if ($user) {
                $dbCarts = Cart::where('user_id', $user->id)->with('product')->get();
                foreach($dbCarts as $c) {
                    $cartItems[] = [
                        'product_id' => $c->product_id,
                        'name' => $c->product->name,
                        'price' => $c->product->price,
                        'qty' => $c->qty
                    ];
                }
            } else {
                $cartItems = session()->get('cart', []);
            }

            // Hitung matematika harga
            $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['qty']);
            $ppn = $subtotal * 0.11;
            $serviceFee = 2500;
            $totalPrice = $subtotal + $ppn + $serviceFee;

            // 1. SIMPAN HEADER (Table Orders)
            $order = Order::create([
                'user_id' => $user ? $user->id : 1, // Jika guest, kasih ke user ID 1 (Admin/Anonim) atau paksa login
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_method' => $request->payment,
                'payment_status' => 'unpaid',
                'email' => $request->email,
            ]);

            // 2. SIMPAN DETAIL (Table Order Items)
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'], // Pastikan key ini ada
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                ]);
            }

            // 3. BERSIHKAN KERANJANG
            if ($user) {
                Cart::where('user_id', $user->id)->delete();
            } else {
                session()->forget('cart');
            }

            DB::commit(); // Simpan permanen

            // Redirect ke halaman sukses / invoice
            return redirect()->route('booking.history')->with('status', 'Pesanan Berhasil Dibuat! Order ID: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua kalau error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}