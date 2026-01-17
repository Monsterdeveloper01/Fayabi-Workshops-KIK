@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-slate-950 py-10">
    <div class="max-w-7xl mx-auto px-4">
        
        {{-- Header --}}
        <div class="mb-10">
            <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">Control <span class="text-red-600">Center</span></h1>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em]">Master Administrator Panel</p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            {{-- Revenue --}}
            <div class="bg-slate-900 border border-white/10 p-6 rounded-[2rem]">
                <p class="text-slate-500 text-[10px] font-black uppercase mb-2">Total Pendapatan</p>
                <h3 class="text-2xl font-black text-white italic">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            </div>
            {{-- Pending Jasa --}}
            <div class="bg-slate-900 border border-white/10 p-6 rounded-[2rem]">
                <p class="text-slate-500 text-[10px] font-black uppercase mb-2">Antrean Jasa</p>
                <div class="flex items-center gap-3">
                    <h3 class="text-3xl font-black text-blue-500 italic">{{ $stats['pending_services'] }}</h3>
                    <span class="text-[9px] bg-blue-500/10 text-blue-500 px-2 py-1 rounded-lg font-bold">Pending</span>
                </div>
            </div>
            {{-- Motor Sales --}}
            <div class="bg-slate-900 border border-white/10 p-6 rounded-[2rem]">
                <p class="text-slate-500 text-[10px] font-black uppercase mb-2">Penawaran Motor</p>
                <h3 class="text-3xl font-black text-amber-500 italic">{{ $stats['pending_motor_sales'] }}</h3>
            </div>
            {{-- Users --}}
            <div class="bg-slate-900 border border-white/10 p-6 rounded-[2rem]">
                <p class="text-slate-500 text-[10px] font-black uppercase mb-2">Total Customer</p>
                <h3 class="text-3xl font-black text-white italic">{{ $stats['total_customers'] }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- List Booking Terbaru --}}
            <div class="bg-slate-900 border border-white/10 rounded-[2.5rem] overflow-hidden">
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <h4 class="text-white font-black uppercase italic text-sm">Booking Jasa Terbaru</h4>
                    <a href="{{ route('admin.bookings.index') }}" class="text-red-600 text-[10px] font-black uppercase">Lihat Semua</a>
                </div>
                <div class="divide-y divide-white/5">
                    @foreach($recentBookings as $booking)
                    <div class="p-5 flex items-center justify-between hover:bg-white/5 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-600/20 text-blue-500 flex items-center justify-center">
                                <i class="fa-solid fa-screwdriver-wrench text-sm"></i>
                            </div>
                            <div>
                                <p class="text-white text-xs font-bold uppercase">{{ $booking->nama }}</p>
                                <p class="text-slate-500 text-[9px] font-bold uppercase tracking-tighter">{{ $booking->package_name }} - {{ $booking->motor_model }}</p>
                            </div>
                        </div>
                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="bg-slate-950 text-[9px] font-black text-white border border-white/10 rounded-lg px-2 py-1 outline-none focus:border-blue-500 transition-all">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                <option value="process" {{ $booking->status == 'process' ? 'selected' : '' }}>PROSES</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>SELESAI</option>
                            </select>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- List Penawaran Motor --}}
            <div class="bg-slate-900 border border-white/10 rounded-[2.5rem] overflow-hidden">
                <div class="p-6 border-b border-white/5">
                    <h4 class="text-white font-black uppercase italic text-sm">Penawaran Motor Masuk</h4>
                </div>
                <div class="divide-y divide-white/5">
                    @foreach($recentSales as $sale)
                    <div class="p-5 flex items-center gap-4">
                        <img src="{{ Storage::url($sale->image) }}" class="w-12 h-12 rounded-xl object-cover">
                        <div class="flex-1">
                            <p class="text-white text-xs font-bold uppercase">{{ $sale->brand }} {{ $sale->model }}</p>
                            <p class="text-amber-500 text-[10px] font-black italic">Rp {{ number_format($sale->price_offer, 0, ',', '.') }}</p>
                        </div>
                        <a href="https://wa.me/{{ $sale->whatsapp }}" target="_blank" class="w-8 h-8 rounded-lg bg-green-500/10 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all">
                            <i class="fa-brands fa-whatsapp text-xs"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection