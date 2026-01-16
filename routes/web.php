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

Route::get('/sparepart', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Modifikasi Motor lho!');

    return view('sparepart.index');
});

Route::get('/profile_setting', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Profile Setting lho!');

    return view('profile_setting.index');
});

Route::get('/booking_history', function () {
    // Kita "matikan" dulu view-nya buat ngetes
    // dd('Halo, ini route Booking History lho!');

    return view('booking_history.index');
});

Route::get('/news/{id}', function ($id) {
    return view('news.show'); 
});

// Brand Routes

Route::get('/brand/harley', function () {
    return view('brand.harley');
});

Route::get('/brand/aprilia', function () {
    return view('brand.aprilia');
});

Route::get('/brand/ducati', function () {
    return view('brand.ducati');
});

Route::get('/brand/kawasaki', function () {
    return view('brand.kawasaki');
});

Route::get('/brand/ktm', function () {
    return view('brand.ktm');
});

Route::get('/brand/suzuki', function () {
    return view('brand.suzuki');
});

Route::get('/brand/yamaha', function () {
    return view('brand.yamaha');
});

Route::get('/brand/honda', function () {
    return view('brand.honda');
});

Route::get('/brand/bmw', function () {
    return view('brand.bmw');
});

Route::get('/jual', function () {
    return view('jual.index');
});