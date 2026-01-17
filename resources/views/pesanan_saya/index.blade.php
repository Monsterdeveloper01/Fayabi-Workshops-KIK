@extends('layouts.app')

@section('content')
<div class="bg-slate-950 min-h-screen py-10 relative overflow-hidden">
    
    <div class="absolute top-0 -left-20 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 -right-20 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 relative z-10">
        
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ url('/') }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-red-600 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Pesanan <span class="text-red-600">Saya</span></h1>
        </div>

        {{-- Tab Navigation --}}
        <div x-data="{ tab: 'belum_bayar' }">
            <div class="flex items-center justify-between border-b border-white/5 overflow-x-auto no-scrollbar mb-8">
                @php
                    $tabs = [
                        ['id' => 'belum_bayar', 'label' => 'Belum Bayar'],
                        ['id' => 'dikemas', 'label' => 'Dikemas'],
                        ['id' => 'dikirim', 'label' => 'Dikirim'],
                        ['id' => 'selesai', 'label' => 'Selesai'],
                        ['id' => 'pembatalan', 'label' => 'Pembatalan'],
                    ];
                @endphp

                @foreach($tabs as $t)
                <button @click="tab = '{{ $t['id'] }}'" 
                        :class="tab === '{{ $t['id'] }}' ? 'text-red-600 border-red-600' : 'text-slate-500 border-transparent hover:text-slate-300'"
                        class="px-4 py-3 text-xs font-black uppercase tracking-widest border-b-2 transition-all whitespace-nowrap">
                    {{ $t['label'] }}
                </button>
                @endforeach
            </div>

            {{-- Empty State Content (Seperti di Gambar) --}}
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-12 flex flex-col items-center justify-center text-center">
                <div class="w-32 h-32 bg-slate-900/50 rounded-full flex items-center justify-center mb-6 border border-white/5 shadow-inner">
                    <i class="fa-solid fa-clipboard-list text-5xl text-slate-700"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Belum ada pesanan</h3>
                <p class="text-slate-500 text-sm max-w-xs mb-8">Sepertinya kamu belum melakukan transaksi apapun hari ini.</p>
                <a href="{{ url('/') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all transform hover:scale-105 shadow-lg shadow-red-600/20">
                    Mulai Belanja
                </a>
            </div>

            {{-- Rekomendasi "Kamu Mungkin Juga Suka" --}}
            <div class="mt-16">
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-px bg-white/10 flex-1"></div>
                    <h2 class="text-xs font-black text-slate-500 uppercase tracking-[0.3em]">Kamu Mungkin Juga Suka</h2>
                    <div class="h-px bg-white/10 flex-1"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    {{-- Dummy Product 1 --}}
                    <div class="group">
                        <div class="relative aspect-square rounded-3xl overflow-hidden bg-white/5 border border-white/10 mb-4 transition-all group-hover:border-red-600/50">
                            <img src="https://images.unsplash.com/photo-1558981403-c5f9199a28bc?q=80&w=500" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-2 py-1 rounded-md">-52%</div>
                        </div>
                        <h4 class="text-white font-bold text-sm truncate px-1">Jas Hujan Motor Waterproof</h4>
                        <div class="flex items-center justify-between mt-2 px-1">
                            <span class="text-red-600 font-black text-sm">Rp 260.440</span>
                            <span class="text-[9px] text-slate-500 font-bold uppercase">18 Terjual</span>
                        </div>
                    </div>

                    {{-- Dummy Product 2 --}}
                    <div class="group">
                        <div class="relative aspect-square rounded-3xl overflow-hidden bg-white/5 border border-white/10 mb-4 transition-all group-hover:border-red-600/50">
                            <img src="https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?q=80&w=500" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-2 py-1 rounded-md">-59%</div>
                        </div>
                        <h4 class="text-white font-bold text-sm truncate px-1">Ransel Wanita Laptop</h4>
                        <div class="flex items-center justify-between mt-2 px-1">
                            <span class="text-red-600 font-black text-sm">Rp 461.208</span>
                            <span class="text-[9px] text-slate-500 font-bold uppercase">3RB+ Terjual</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection