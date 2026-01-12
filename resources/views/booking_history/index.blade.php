@extends('layouts.app')

@section('content')
    <main class="py-8">
        <section class="max-w-3xl mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Riwayat <span class="text-red-600">Booking</span></h2>
                <span class="bg-slate-800 text-white text-[10px] font-black px-3 py-1 rounded-full border border-white/10 uppercase tracking-widest">5 Transaksi</span>
            </div>

            <div class="space-y-4">
                {{-- Contoh Item Riwayat: Service --}}
                <div class="bg-slate-900/90 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-red-600/50 transition-all group">
                    <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-600/20 border border-blue-600/50 flex items-center justify-center text-blue-500">
                                <i class="fa-solid fa-screwdriver-wrench text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-black uppercase text-sm tracking-tight">Service & Maintenance</h3>
                                <p class="text-slate-400 text-xs font-bold">Yamaha R15 - 12 Jan 2026</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="text-[9px] bg-green-500/20 text-green-500 px-2 py-0.5 rounded-md font-black uppercase border border-green-500/30">Selesai</span>
                                    <span class="text-[9px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded-md font-black uppercase italic">#BK-9901</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="flex-1 md:flex-none px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg hover:bg-white hover:text-slate-900 transition-all">Detail</button>
                            <button class="flex-1 md:flex-none px-4 py-2 bg-red-600 text-white text-[10px] font-black uppercase rounded-lg shadow-lg shadow-red-600/20">Ulas</button>
                        </div>
                    </div>
                </div>

                {{-- Contoh Item Riwayat: Cuci --}}
                <div class="bg-slate-900/90 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-red-600/50 transition-all">
                    <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-red-600/20 border border-red-600/50 flex items-center justify-center text-red-500">
                                <i class="fa-solid fa-soap text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-black uppercase text-sm tracking-tight">Cuci Steam Premium</h3>
                                <p class="text-slate-400 text-xs font-bold">Honda Vario 160 - 10 Jan 2026</p>
                                <div class="mt-2 flex gap-2">
                                    <span class="text-[9px] bg-yellow-500/20 text-yellow-500 px-2 py-0.5 rounded-md font-black uppercase border border-yellow-500/30">Proses</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="w-full md:w-auto px-4 py-2 bg-slate-800 text-white text-[10px] font-black uppercase rounded-lg">Cek Antrean</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection