<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aksesoris', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Aksesoris lho!'); 
    
    return view('aksesoris.index');
});

Route::get('/service_motor', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Service Motor lho!'); 
    
    return view('service_motor.index');
});

Route::get('/cuci_motor', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Cuci Motor lho!'); 
    
    return view('cuci_motor.index');
});

Route::get('/modifikasi_motor', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Modifikasi Motor lho!'); 
    
    return view('modifikasi_motor.index');
});

Route::get('/sparepart_motor', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Sparepart Motor lho!'); 
    
    return view('sparepart_motor.index');
});


// ini buat navbar
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Halaman Aksesoris (folder aksesoris/index.blade.php)
Route::get('/aksesoris', function () {
    return view('aksesoris.index');
})->name('aksesoris_motor.index');

// Halaman Cuci Motor (folder cuci_motor/index.blade.php)
Route::get('/cuci-motor', function () {
    return view('cuci_motor.index');
})->name('cuci_motor.index');

// Halaman Modifikasi (folder modifikasi_motor/index.blade.php)
Route::get('/modifikasi', function () {
    return view('modifikasi_motor.index');
})->name('modifikasi_motor.index');

// Halaman Service (folder service_motor/index.blade.php)
Route::get('/service', function () {
    return view('service_motor.index');
})->name('service_motor.index');

// Halaman Sparepart (folder sparepart_motor/index.blade.php)
Route::get('/sparepart', function () {
    return view('sparepart_motor.index');
})->name('sparepart_motor.index');