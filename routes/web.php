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
    $allNews = [
        1 => [
            'title' => 'Gelar Workshop Modifikasi Honda Seri Matic',
            'author' => 'Admin Fayabi',
            'date' => 'Jumat, 15 Januari 2026',
            'image' => 'https://i.pinimg.com/736x/5f/25/d2/5f25d2d67ca43e707c2f0629ed439417.jpg',
            'content' => 'Fayabi Workshop sukses menggelar edukasi modifikasi khusus motor Matic. Fokus utama adalah pada sektor CVT dan kenyamanan harian...'
        ],
        2 => [
            'title' => 'Layanan Detailing Keramik Pro Kini Tersedia',
            'author' => 'Tim Detailing',
            'date' => 'Kamis, 10 Januari 2026',
            'image' => 'https://images.unsplash.com/photo-1615172282427-9a57ef2d142e?q=80&w=800',
            'content' => 'Kami memperkenalkan teknologi Nano Ceramic Coating terbaru yang mampu melindungi cat motor Anda hingga 3 tahun dari cuaca ekstrem...'
        ],
        3 => [
            'title' => 'Tips Merawat Mesin Motor di Musim Hujan',
            'author' => 'Mekanik Senior',
            'date' => 'Rabu, 02 Januari 2026',
            'image' => 'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=800',
            'content' => 'Air hujan yang bersifat asam seringkali memicu korosi. Pastikan Anda selalu membilas motor setelah terkena hujan untuk menjaga mesin...'
        ]
    ];

    $news = $allNews[$id] ?? $allNews[1];

    return view('news.show', compact('news'));
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