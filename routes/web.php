<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK (Bisa Diakses Siapa Saja)
|--------------------------------------------------------------------------
| Route ini ditaruh DI LUAR middleware 'auth'.
| Biasanya halaman depan/landing page.
*/

Route::get('/', function () {
    return view('welcome');
});

  Route::get('/news/{id}', function ($id) {
        return view('news.show'); 
    });

/*
|--------------------------------------------------------------------------
| 2. ROUTE PROTECTED (HARUS LOGIN DULU)
|--------------------------------------------------------------------------
| Semua route di dalam group ini WAJIB Login.
| Kalau belum login, otomatis dilempar ke halaman Login.
*/

Route::middleware(['auth'])->group(function () {

    // --- Menu Utama (Aksesoris & Sparepart) ---
    Route::get('/aksesoris', function () {
        return view('aksesoris.index');
    });

    Route::get('/sparepart', function () {
        return view('sparepart.index');
    });

    // --- Menu Jasa ---
    Route::get('/service_motor', function () {
        return view('service_motor.index');
    });

    Route::get('/cuci_motor', function () {
        return view('cuci_motor.index');
    });

    Route::get('/modifikasi_motor', function () {
        return view('modifikasi_motor.index');
    });

    // --- Fitur User ---
    Route::get('/profile_setting', function () {
        return view('profile_setting.index');
    });

    Route::get('/booking_history', function () {
        return view('booking_history.index');
    });
    
    Route::get('/jual', function () {
        return view('jual.index');
    });

    // --- Transaksi (Cart & Checkout) ---
    Route::get('/checkout', function () {
        $cartItems = session()->get('cart', []); 
        return view('checkout.index', compact('cartItems'));
    })->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{index}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // --- News (Opsional: Kalau mau baca berita harus login) ---
  

    // --- Brand Pages ---
    Route::get('/brand/harley', function () { return view('brand.harley'); });
    Route::get('/brand/aprilia', function () { return view('brand.aprilia'); });
    Route::get('/brand/ducati', function () { return view('brand.ducati'); });
    Route::get('/brand/kawasaki', function () { return view('brand.kawasaki'); });
    Route::get('/brand/ktm', function () { return view('brand.ktm'); });
    Route::get('/brand/suzuki', function () { return view('brand.suzuki'); });
    Route::get('/brand/yamaha', function () { return view('brand.yamaha'); });
    Route::get('/brand/honda', function () { return view('brand.honda'); });
    Route::get('/brand/bmw', function () { return view('brand.bmw'); });

}); 
// <--- Jangan lupa tutup kurung kurawal dan tutup kurung biasa di sini!