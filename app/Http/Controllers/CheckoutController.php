<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Tangkap data satu barang dari request
        // 2. Bungkus ke dalam array agar namanya sesuai dengan yang diminta View ($cartItems)
        $cartItems = [
            [
                'name'  => $request->name,
                'price' => (int) $request->price,
                'image' => $request->image,
                'qty'   => 1, // Default quantity untuk Buy Now
            ]
        ];

        // 3. Kirimkan dengan nama variabel yang diharapkan oleh View yaitu 'cartItems'
        return view('checkout.index', compact('cartItems'));
    }
}