<?php

namespace App\Http\Controllers;

use App\Models\MotorSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MotorSaleController extends Controller
{
    public function index()
    {
        // AMBIL DATA: Ini bagian yang sering terlewat
        // Kita ambil semua motor yang dijual oleh user yang sedang login
        $mySales = MotorSale::where('user_id', Auth::id())->latest()->get();

        // KIRIM DATA: Masukkan $mySales ke dalam compact
        return view('jual.index', compact('mySales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'mileage' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',
            'price_offer' => 'required|numeric',
            'whatsapp' => 'required',
        ]);

        // Handle Upload Foto
        $imagePath = $request->file('image')->store('motor_sales', 'public');

        MotorSale::create([
            'user_id' => Auth::id(),
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'image' => $imagePath,
            'price_offer' => $request->price_offer,
            'whatsapp' => $request->whatsapp,
        ]);

        return redirect()->route('jual.index')->with('status', 'Penawaran berhasil dikirim!');
    }

    public function show($id)
{
    // Cari data berdasarkan ID dan pastikan ini milik user yang sedang login (Security)
    $motor = MotorSale::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    return view('jual.show', compact('motor'));
}
}