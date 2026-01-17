@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-slate-950 py-12 relative overflow-hidden">
    {{-- Glow Decor --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 max-w-5xl">
        
        {{-- Header & Back --}}
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('pesanan_saya.index') }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-amber-600 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Detail <span class="text-amber-500">Penawaran</span></h1>
                <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest">ID Penawaran: #MTR-{{ $motor->id }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KIRI: STATUS TRACKER & INFO HARGA --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Status Progress --}}
                <div class="bg-slate-900/40 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8">
                    <h3 class="text-white font-black uppercase italic text-xs tracking-wider mb-8 border-b border-white/5 pb-4">
                        Status Proses
                    </h3>

                    <div class="relative space-y-8">
                        {{-- Garis Tengah --}}
                        <div class="absolute left-[15px] top-0 bottom-0 w-0.5 bg-white/10"></div>

                        {{-- Step 1 --}}
                        <div class="relative flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full z-10 flex items-center justify-center text-[10px] font-black {{ $motor->status != 'cancelled' ? 'bg-amber-500 text-slate-950 shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-white uppercase">Terkirim</p>
                                <p class="text-[9px] text-slate-500 uppercase">{{ $motor->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        {{-- Step 2 --}}
                        <div class="relative flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full z-10 flex items-center justify-center text-[10px] font-black {{ in_array($motor->status, ['reviewed', 'sold']) ? 'bg-amber-500 text-slate-950 shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black {{ in_array($motor->status, ['reviewed', 'sold']) ? 'text-white' : 'text-slate-600' }} uppercase">Review Admin</p>
                                <p class="text-[9px] text-slate-500 uppercase">Tahap Verifikasi Data</p>
                            </div>
                        </div>

                        {{-- Step 3 --}}
                        <div class="relative flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full z-10 flex items-center justify-center text-[10px] font-black {{ $motor->status == 'sold' ? 'bg-green-500 text-slate-950 shadow-[0_0_15px_rgba(34,197,94,0.5)]' : 'bg-slate-800 text-slate-500' }}">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black {{ $motor->status == 'sold' ? 'text-white' : 'text-slate-600' }} uppercase">Terjual / Selesai</p>
                                <p class="text-[9px] text-slate-500 uppercase">Unit Berpindah Tangan</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Harga Penawaran --}}
                <div class="bg-amber-500 rounded-[2.5rem] p-8 text-slate-950">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1">Harga Penawaran Anda</p>
                    <h2 class="text-3xl font-black italic tracking-tighter">Rp {{ number_format($motor->price_offer, 0, ',', '.') }}</h2>
                    <div class="mt-6 pt-6 border-t border-slate-950/10">
                        <a href="https://wa.me/{{ $motor->whatsapp }}" class="flex items-center justify-center gap-2 bg-slate-950 text-white w-full py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-transform">
                            <i class="fa-brands fa-whatsapp"></i> Chat Admin Kami
                        </a>
                    </div>
                </div>
            </div>

            {{-- KANAN: DETAIL UNIT (2/3) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Foto & Unit Name --}}
                <div class="bg-slate-900/40 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] overflow-hidden">
                    <div class="h-64 md:h-80 w-full relative">
                        <img src="{{ Storage::url($motor->image) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                        <div class="absolute bottom-8 left-8">
                            <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-2 inline-block">{{ $motor->brand }}</span>
                            <h2 class="text-3xl font-black text-white italic uppercase tracking-tighter">{{ $motor->model }}</h2>
                        </div>
                    </div>

                    <div class="p-8 md:p-10">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10">
                            <div>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-1">Tahun Produksi</p>
                                <p class="text-white font-bold">{{ $motor->year }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-1">Jarak Tempuh</p>
                                <p class="text-white font-bold">{{ number_format($motor->mileage, 0, ',', '.') }} KM</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-1">WhatsApp Terdaftar</p>
                                <p class="text-white font-bold">{{ $motor->whatsapp }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-white font-black uppercase italic text-sm tracking-wider border-l-4 border-amber-500 pl-3">Deskripsi Kondisi</h3>
                            <div class="bg-white/5 rounded-3xl p-6 border border-white/5">
                                <p class="text-slate-400 text-sm leading-relaxed whitespace-pre-line font-medium">
                                    {{ $motor->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Warning Box --}}
                <div class="p-6 bg-blue-500/5 border border-blue-500/20 rounded-3xl flex gap-4 items-start">
                    <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                    <div>
                        <h4 class="text-blue-500 font-black uppercase text-[10px] tracking-widest mb-1">Informasi Pengecekan</h4>
                        <p class="text-slate-500 text-xs font-bold leading-relaxed">
                            Pastikan Anda membawa dokumen asli (STNK & BPKB) saat tim inspeksi kami melakukan kunjungan atau saat Anda membawa unit ke Workshop. Penawaran harga bersifat estimasi sebelum inspeksi fisik dilakukan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection