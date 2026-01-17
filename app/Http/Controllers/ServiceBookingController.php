<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceBookingController extends Controller
{
    public function index()
{
    // Mengambil riwayat booking milik user yang sedang login
    // Diurutkan dari yang terbaru
    $bookings = ServiceBooking::where('user_id', Auth::id())
                ->latest()
                ->get();

    return view('booking_history.index', compact('bookings'));
}
    public function store(Request $request)
    {
        // Validasi dasar yang ada di semua form
        $rules = [
            'service_type' => 'required',
            'nama' => 'required|string|max:255',
            'whatsapp' => 'required',
            'tanggal' => 'required|date',
        ];

        // Jalankan validasi
        $request->validate($rules);

        // Simpan data dengan Mapping Field (Menyesuaikan input form dengan kolom tabel)
        ServiceBooking::create([
            'user_id'      => Auth::id(),
            'service_type' => $request->service_type,
            'nama'         => $request->nama,
            'whatsapp'     => $request->whatsapp,
            
            // Mapping field yang berbeda-beda tiap form
            'motor_brand'  => $request->tipe, // Dari select 'merk' atau 'tipe'
            'motor_model'  => $request->model,
            'motor_size'   => $request->ukuran,
            
            'package_name' => $request->paket ?? $request->jenis_service ?? 'Modifikasi Custom',
            'booking_date' => $request->tanggal,
            'booking_time' => $request->jam,
            'budget'       => $request->budget ? str_replace(['Rp', '.', ' '], '', $request->budget) : null,
            'notes'        => $request->catatan,
        ]);

        return redirect()->back()->with('status', 'Booking ' . ucfirst($request->service_type) . ' berhasil dikirim!');
    }
}