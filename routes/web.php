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

// brands

Route::get('/brand/honda', function () {
    return view('brands.honda');
});

Route::get('/brand/yamaha', function () {
    return view('brands.yamaha');
});

Route::get('/brand/suzuki', function () {
    return view('brands.suzuki');
});

Route::get('/brand/kawasaki', function () {
    return view('brands.kawasaki');
});

Route::get('/brand/harley', function () {
    return view('brands.harley');
});

Route::get('/brand/ducati', function () {
    return view('brands.ducati');
});

Route::get('/brand/ktm', function () {
    return view('brands.ktm');
});

Route::get('/brand/aprilia', function () {
    return view('brands.aprilia');
});
