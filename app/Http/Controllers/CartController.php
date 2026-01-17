<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'category' => $request->category ?? 'Sparepart',
            'qty' => 1
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Barang berhasil masuk keranjang!');    
    }

    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            // Re-index array agar tidak ada kunci yang lompat
            session()->put('cart', array_values($cart));
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}