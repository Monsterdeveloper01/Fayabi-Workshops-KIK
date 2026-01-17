<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product; 
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
        // Validasi Input
        $request->validate([
            'email' => 'required|email',
            'payment' => 'required',
        ]);

        // Mulai Transaksi Database (PENTING AGAR DATA KONSISTEN)
        DB::beginTransaction();

        try {
            $user = Auth::user();

            // 1. Ambil Data Keranjang Terbaru dari Database
            // Kita ambil fresh dari DB biar datanya valid (bukan dari session/cache lama)
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
                // Logic Guest (Opsional, tapi sebaiknya dipaksa login)
                $cartItems = session()->get('cart', []);
            }

            // Cek keranjang kosong
            if (empty($cartItems)) {
                throw new \Exception("Keranjang belanja kosong.");
            }

            // Hitung Total Bayar
            $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['qty']);
            $ppn = $subtotal * 0.11;
            $serviceFee = 2500;
            $totalPrice = $subtotal + $ppn + $serviceFee;

            // 2. SIMPAN HEADER ORDER (Data Umum)
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_method' => $request->payment,
                'payment_status' => 'unpaid',
                'email' => $request->email, // Email dari form checkout
                // Simpan alamat snapshot saat checkout (Opsional tapi bagus)
                // 'shipping_address' => $user->address_line . ', ' . $user->city
            ]);

            // 3. LOOP BARANG: CEK STOK & KURANGI STOK
            foreach ($cartItems as $item) {
                
                // A. Ambil Data Produk Asli dari DB
                // Gunakan lockForUpdate() biar gak rebutan stok sama user lain di detik yg sama
                $product = Product::where('id', $item['product_id'])->lockForUpdate()->first();

                if (!$product) {
                    throw new \Exception("Produk '{$item['name']}' tidak ditemukan atau sudah dihapus.");
                }

                // B. VALIDASI: Cek Apakah Stok Cukup?
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok Habis! Produk '{$product->name}' hanya tersisa {$product->stock} item.");
                }

                // C. UPDATE: Kurangi Stok Produk
                $product->decrement('stock', $item['qty']);

                // D. Simpan ke Order Item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name, // Snapshot nama (jaga2 kalo diganti admin)
                    'price' => $product->price,       // Snapshot harga saat beli
                    'qty' => $item['qty'],
                ]);
            }

            // 4. BERSIHKAN KERANJANG
            if ($user) {
                Cart::where('user_id', $user->id)->delete();
            } else {
                session()->forget('cart');
            }

            // Jika semua lancar, Simpan Perubahan Permanen
            DB::commit();

            // Redirect Sukses
            return redirect()->route('booking.history')->with('status', 'Pesanan Berhasil! Order ID: ' . $order->order_number);

        } catch (\Exception $e) {
            // Jika ada error (misal stok kurang), Batalkan SEMUA perubahan database
            DB::rollBack(); 
            
            // Kembalikan user ke halaman checkout dengan pesan error
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}