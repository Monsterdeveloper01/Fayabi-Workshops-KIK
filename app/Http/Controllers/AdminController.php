<?php

namespace App\Http\Controllers;

use App\Models\ServiceBooking;
use App\Models\MotorSale;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik Ringkas
        $stats = [
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
            'pending_services' => ServiceBooking::where('status', 'pending')->count(),
            'pending_motor_sales' => MotorSale::where('status', 'pending')->count(),
            'total_customers' => User::where('role', 'user')->count(),
        ];

        // Aktivitas Terbaru
        $recentBookings = ServiceBooking::latest()->take(5)->get();
        $recentSales = MotorSale::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentSales'));
    }

    // Mengelola Semua Booking (Jasa)
    public function bookings()
    {
        $bookings = ServiceBooking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    // Update Status Jasa (Cuci/Service/Modif)
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = ServiceBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('status', 'Status Jasa #' . $id . ' Berhasil Diperbarui!');
    }
}