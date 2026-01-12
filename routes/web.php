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