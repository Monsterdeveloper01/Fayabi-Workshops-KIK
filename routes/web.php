<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AksesorisController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/news/{id}', function ($id) {
    return view('news.show'); 
});

/*
|--------------------------------------------------------------------------
| 2. ROUTE SETELAH LOGIN (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- PROFILE MANAGEMENT ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- AREA KHUSUS VENDOR (Role Check) ---
    Route::middleware(['role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [VendorController::class, 'index'])->name('dashboard');
        Route::get('/my-products', [VendorController::class, 'products'])->name('products');
        Route::get('/create-product', [VendorController::class, 'create'])->name('create');
        Route::post('/store-product', [VendorController::class, 'store'])->name('store');
        
        // Pesanan Masuk untuk Vendor
        Route::get('/orders', [VendorController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{id}', [VendorController::class, 'showOrder'])->name('orders.show');
    });

    // --- SISTEM CHAT (User & Vendor) ---
    // Gunakan nama yang konsisten agar tidak error di Blade
    Route::get('/chats', [ChatController::class, 'index'])->name('chat.list');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

    // --- BELANJA (Sparepart & Aksesoris) ---
    Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart.index');
    Route::get('/aksesoris', [AksesorisController::class, 'index'])->name('aksesoris.index');

    // --- PESANAN SAYA (User) ---
    Route::get('/pesanan_saya', [OrderController::class, 'myOrders'])->name('pesanan_saya.index');
    Route::get('/booking_history', function () {
        return view('booking_history.index');
    })->name('booking.history');

    // --- KERANJANG & CHECKOUT ---
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // --- JASA & LAINNYA ---
    Route::get('/service_motor', function () { return view('service_motor.index'); });
    Route::get('/cuci_motor', function () { return view('cuci_motor.index'); });
    Route::get('/modifikasi_motor', function () { return view('modifikasi_motor.index'); });
    Route::get('/jual', function () { return view('jual.index'); });

    // --- BRAND PAGES ---
    $brands = ['harley', 'aprilia', 'ducati', 'kawasaki', 'ktm', 'suzuki', 'yamaha', 'honda', 'bmw'];
    foreach ($brands as $brand) {
        Route::get("/brand/{$brand}", function () use ($brand) { 
            return view("brand.{$brand}"); 
        })->name("brand.{$brand}");
    }
});

require __DIR__.'/auth.php';