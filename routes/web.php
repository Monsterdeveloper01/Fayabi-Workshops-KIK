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
use App\Http\Controllers\MotorSaleController;
use App\Http\Controllers\ServiceBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::get('/jual', [MotorSaleController::class, 'index'])->name('jual.index');
    Route::post('/jual/store', [MotorSaleController::class, 'store'])->name('jual.store');
    Route::get('/jual/status/{id}', [MotorSaleController::class, 'show'])->name('jual.show');
    Route::middleware(['auth'])->group(function () {
    Route::post('/booking/store', [ServiceBookingController::class, 'store'])->name('booking.store');
});

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Main Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Management Jasa (Cuci, Service, Modif)
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings.index');
    Route::patch('/bookings/{id}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.update');

    // Management Jual Motor (User Offer)
    Route::get('/motor-sales', [AdminController::class, 'motorSales'])->name('motor-sales.index');
    
    // Vendor Monitoring (Histori Penjualan Vendor)
    Route::get('/vendor-reports', [AdminController::class, 'vendorReports'])->name('vendor.reports');
});

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
    Route::get('/booking_history', [ServiceBookingController::class, 'index'])->name('booking.history');

    // --- KERANJANG & CHECKOUT ---
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // --- JASA & LAINNYA ---
    Route::get('/service_motor', function () { return view('service_motor.index'); });
    Route::get('/cuci_motor', function () { return view('cuci_motor.index'); });
    Route::get('/modifikasi_motor', function () { return view('modifikasi_motor.index'); });

    // --- BRAND PAGES ---
    $brands = ['harley', 'aprilia', 'ducati', 'kawasaki', 'ktm', 'suzuki', 'yamaha', 'honda', 'bmw'];
    foreach ($brands as $brand) {
        Route::get("/brand/{$brand}", function () use ($brand) { 
            return view("brand.{$brand}"); 
        })->name("brand.{$brand}");
    }
});

require __DIR__.'/auth.php';