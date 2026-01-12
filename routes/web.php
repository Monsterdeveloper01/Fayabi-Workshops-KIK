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