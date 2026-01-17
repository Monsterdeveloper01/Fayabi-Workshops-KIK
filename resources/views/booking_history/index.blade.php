@extends('layouts.app')

@section('content')
    {{-- Background Wrapper --}}
    <main class="py-12 min-h-screen bg-slate-950 relative overflow-hidden">
        
        {{-- Elemen Dekoratif Background --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <section class="max-w-3xl mx-auto px-4 relative z-10">
            {{-- Header Section --}}
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
                    <span class="text-white text-[10px] font-black uppercase tracking-widest">5 Transaksi Tersimpan</span>
                </div>
            </div>

            <div class="space-y-6">
                {{-- Item 1: Service --}}
                <div class="relative group">
                    {{-- Efek Glow saat Hover --}}
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    
                    <div class="relative bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden transition-all">
                        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex items-start gap-5">
                                {{-- Icon Container --}}
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600/20 to-blue-900/40 border border-blue-500/30 flex items-center justify-center text-blue-500 shadow-lg">
                                        <i class="fa-solid fa-screwdriver-wrench text-2xl"></i>
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-4 border-slate-900 flex items-center justify-center">
                                        <i class="fa-solid fa-check text-[10px] text-white"></i>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-white font-black uppercase text-sm md:text-base tracking-tight">Service & Maintenance</h3>
                                        <span class="text-[9px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded font-bold italic tracking-tighter">#BK-9901</span>
                                    </div>
                                    <p class="text-slate-400 text-xs font-bold flex items-center gap-2">
                                        <i class="fa-solid fa-motorcycle text-red-600"></i> Yamaha R15 
                                        <span class="text-slate-600">•</span> 
                                        <i class="fa-solid fa-calendar text-red-600"></i> 12 Jan 2026
                                    </p>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <span class="text-[9px] bg-green-500/10 text-green-500 px-3 py-1 rounded-full font-black uppercase border border-green-500/20">Selesai</span>
                                        <span class="text-[9px] bg-white/5 text-slate-300 px-3 py-1 rounded-full font-black uppercase border border-white/10">Oli Mesin</span>
                                        <span class="text-[9px] bg-white/5 text-slate-300 px-3 py-1 rounded-full font-black uppercase border border-white/10">Tune Up</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex md:flex-col lg:flex-row items-center gap-3 pt-4 md:pt-0 border-t md:border-t-0 border-white/5">
                                <button class="flex-1 md:w-full lg:w-auto px-6 py-2.5 bg-white/5 text-white text-[10px] font-black uppercase rounded-xl border border-white/10 hover:bg-white hover:text-slate-900 transition-all">Detail</button>
                                <button class="flex-1 md:w-full lg:w-auto px-6 py-2.5 bg-red-600 text-white text-[10px] font-black uppercase rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-star"></i> Ulas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Item 2: Cuci --}}
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-600 to-red-600 rounded-2xl blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                    
                    <div class="relative bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden transition-all">
                        <div class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="flex items-start gap-5">
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-600/20 to-red-900/40 border border-red-500/30 flex items-center justify-center text-red-500 shadow-lg">
                                        <i class="fa-solid fa-soap text-2xl"></i>
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-yellow-500 rounded-full border-4 border-slate-900 flex items-center justify-center animate-pulse">
                                        <i class="fa-solid fa-clock text-[10px] text-slate-900"></i>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h3 class="text-white font-black uppercase text-sm md:text-base tracking-tight">Cuci Steam Premium</h3>
                                        <span class="text-[9px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded font-bold italic tracking-tighter">#BK-9912</span>
                                    </div>
                                    <p class="text-slate-400 text-xs font-bold flex items-center gap-2">
                                        <i class="fa-solid fa-motorcycle text-red-600"></i> Honda Vario 160 
                                        <span class="text-slate-600">•</span> 
                                        <i class="fa-solid fa-calendar text-red-600"></i> 10 Jan 2026
                                    </p>
                                    
                                    <div class="mt-4 flex gap-2">
                                        <span class="text-[9px] bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full font-black uppercase border border-yellow-500/20">Sedang Diproses</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 pt-4 md:pt-0 border-t md:border-t-0 border-white/5">
                                <button class="w-full md:w-auto px-8 py-3 bg-slate-800 hover:bg-slate-700 text-white text-[10px] font-black uppercase rounded-xl border border-white/10 transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-eye"></i> Cek Antrean
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Empty State Suggestion --}}
            <div class="mt-12 text-center">
                <p class="text-slate-600 text-[10px] font-bold uppercase tracking-[0.4em] mb-4">Butuh Perawatan Lagi?</p>
                <a href="/service_motor" class="inline-flex items-center gap-3 text-white bg-white/5 border border-white/10 px-8 py-4 rounded-2xl hover:bg-red-600 hover:border-red-600 transition-all group">
                    <span class="text-xs font-black uppercase tracking-widest">Buat Booking Baru</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </section>
    </main>
@endsection