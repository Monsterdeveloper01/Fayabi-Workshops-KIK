<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Cek Produk dulu valid atau tidak
        $product = Product::find($request->product_id); // Pastikan di form ada input hidden name="product_id"
        if(!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan');

        // LOGIKA 1: JIKA USER LOGIN (Pakai Database)
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

            if ($cart) {
                $cart->increment('qty'); // Kalau udah ada, tambah qty aja
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'qty' => 1
                ]);
            }
        } 
        // LOGIKA 2: JIKA GUEST (Pakai Session)
        else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['qty']++;
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id, // Penting buat checkout nanti
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'category' => $product->category->name ?? 'Sparepart',
                    'qty' => 1
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Barang masuk keranjang!');
    }

    public function removeFromCart($id)
    {
        if (Auth::check()) {
            // Hapus dari Database (berdasarkan ID tabel carts, bukan ID produk)
            Cart::where('id', $id)->orWhere('product_id', $id)->where('user_id', Auth::id())->delete();
        } else {
            // Hapus dari Session
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Item dihapus.');
    }
}