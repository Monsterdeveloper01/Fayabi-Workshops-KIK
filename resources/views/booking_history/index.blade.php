@extends('layouts.app')

@section('content')
    <main class="py-12 min-h-screen bg-slate-950 relative overflow-hidden">
        {{-- Glow Decor --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <section class="max-w-3xl mx-auto px-4 relative z-10">
            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="h-1 w-8 bg-red-600"></div>
                        <span class="text-red-600 font-black uppercase tracking-[0.3em] text-[10px]">Activity Logs</span>
                    </div>
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Riwayat <span class="text-red-600">Booking</span></h2>
                </div>
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 px-4 py-2 rounded-2xl backdrop-blur-md">
                    <i class="fa-solid fa-receipt text-red-500"></i>
                    <span class="text-white text-[10px] font-black uppercase tracking-widest">{{ $bookings->count() }} Transaksi Tersimpan</span>
                </div>
            </div>

            <div class="space-y-6">
                @forelse($bookings as $booking)
                <div class="relative group">
                    {{-- Glow Effect on Hover --}}
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    
                    <div class="relative bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex items-start gap-5">
                                {{-- Dynamic Icon based on Service Type --}}
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg
                                        {{ $booking->service_type == 'cuci' ? 'bg-red-600/20 text-red-500 border-red-500/30' : '' }}
                                        {{ $booking->service_type == 'servis' ? 'bg-blue-600/20 text-blue-500 border-blue-500/30' : '' }}
                                        {{ $booking->service_type == 'modifikasi' ? 'bg-orange-600/20 text-orange-500 border-orange-500/30' : '' }}
                                        border">
                                        
                                        @if($booking->service_type == 'cuci') <i class="fa-solid fa-soap text-2xl"></i>
                                        @elseif($booking->service_type == 'servis') <i class="fa-solid fa-screwdriver-wrench text-2xl"></i>
                                        @else <i class="fa-solid fa-gear text-2xl"></i> @endif
                                    </div>
                                    
                                    {{-- Mini Status Icon --}}
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-4 border-slate-900 flex items-center justify-center
                                        {{ $booking->status == 'completed' ? 'bg-green-500' : 'bg-yellow-500 animate-pulse' }}">
                                        <i class="fa-solid {{ $booking->status == 'completed' ? 'fa-check' : 'fa-clock' }} text-[10px] text-white"></i>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-white font-black uppercase text-sm md:text-base tracking-tight">
                                            {{ $booking->package_name }}
                                        </h3>
                                        <span class="text-[9px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded font-bold italic tracking-tighter">#BK-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <p class="text-slate-400 text-xs font-bold flex items-center gap-2">
                                        <i class="fa-solid fa-motorcycle text-red-600"></i> {{ $booking->motor_model ?? 'Unit Motor' }} 
                                        <span class="text-slate-600">•</span> 
                                        <i class="fa-solid fa-calendar text-red-600"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                    </p>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        {{-- Badge Status --}}
                                        <span class="text-[9px] px-3 py-1 rounded-full font-black uppercase border 
                                            {{ $booking->status == 'completed' ? 'bg-green-500/10 text-green-500 border-green-500/20' : 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' }}">
                                            {{ $booking->status == 'completed' ? 'Selesai' : 'Diproses' }}
                                        </span>
                                        <span class="text-[9px] bg-white/5 text-slate-300 px-3 py-1 rounded-full font-black uppercase border border-white/10 italic">
                                            {{ ucfirst($booking->service_type) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex md:flex-col lg:flex-row items-center gap-3 pt-4 md:pt-0 border-t md:border-t-0 border-white/5">
                                <button class="flex-1 md:w-full lg:w-auto px-6 py-2.5 bg-white/5 text-white text-[10px] font-black uppercase rounded-xl border border-white/10 hover:bg-white hover:text-slate-900 transition-all">Detail</button>
                                
                                @if($booking->status == 'completed')
                                <button class="flex-1 md:w-full lg:w-auto px-6 py-2.5 bg-red-600 text-white text-[10px] font-black uppercase rounded-xl shadow-lg hover:bg-red-700 transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-star"></i> Ulas
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Tampilan jika belum ada data --}}
                <div class="py-20 text-center bg-slate-900/40 rounded-[2.5rem] border border-dashed border-white/10">
                    <i class="fa-solid fa-calendar-xmark text-5xl text-slate-700 mb-4"></i>
                    <h3 class="text-white font-black uppercase italic">Belum Ada Riwayat</h3>
                    <p class="text-slate-500 text-xs font-medium">Anda belum melakukan booking perawatan motor apapun.</p>
                </div>
                @endforelse
            </div>

            {{-- Booking Suggestion --}}
            <div class="mt-12 text-center">
                <p class="text-slate-600 text-[10px] font-bold uppercase tracking-[0.4em] mb-4">Butuh Perawatan Lagi?</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/service_motor" class="inline-flex items-center gap-3 text-white bg-white/5 border border-white/10 px-6 py-3 rounded-2xl hover:bg-red-600 transition-all group">
                        <span class="text-[10px] font-black uppercase tracking-widest">Service</span>
                    </a>
                    <a href="/cuci_motor" class="inline-flex items-center gap-3 text-white bg-white/5 border border-white/10 px-6 py-3 rounded-2xl hover:bg-blue-600 transition-all group">
                        <span class="text-[10px] font-black uppercase tracking-widest">Cuci</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection