@extends('layouts.app')

@section('content')
<div class="bg-slate-950 min-h-screen py-10 relative overflow-hidden">
    
    {{-- Glow Effects --}}
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
        <div>
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
                <a href="{{ route('pesanan_saya.index', ['status' => $t['id']]) }}" 
                   class="px-4 py-3 text-xs font-black uppercase tracking-widest border-b-2 transition-all whitespace-nowrap 
                   {{ $status === $t['id'] ? 'text-red-600 border-red-600' : 'text-slate-500 border-transparent hover:text-slate-300' }}">
                    {{ $t['label'] }}
                </a>
                @endforeach
            </div>

            {{-- List Pesanan --}}
            @forelse($orders as $order)
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 mb-6 group hover:border-red-600/30 transition-all">
                    <div class="flex justify-between items-center mb-4 border-b border-white/5 pb-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Order #{{ $order->order_number }}</span>
                        <span class="px-3 py-1 bg-red-600/10 text-red-500 rounded-full text-[9px] font-black uppercase tracking-tighter">
                            {{ $order->status }}
                        </span>
                    </div>

                    @foreach($order->items as $item)
                    <div class="flex gap-4 mb-4">
                        <div class="w-16 h-16 bg-slate-900 rounded-2xl overflow-hidden border border-white/5">
                            <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="text-white font-bold text-sm leading-tight">{{ $item->product_name }}</h4>
                            <p class="text-slate-500 text-xs mt-1">{{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach

                    <div class="flex justify-between items-center mt-6 border-t border-white/5 pt-4">
                        <div>
                            <p class="text-[9px] text-slate-500 uppercase font-black tracking-widest">Total Bill</p>
                            <p class="text-lg font-black text-white italic tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="#" class="px-5 py-2 bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase rounded-lg hover:bg-white/10 transition-all">Detail</a>
                            @if($order->status === 'pending' && $order->payment_status === 'unpaid')
                                <button class="px-5 py-2 bg-red-600 text-white text-[10px] font-black uppercase rounded-lg hover:bg-red-700 transition-all shadow-lg shadow-red-600/20">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-12 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-slate-900/50 rounded-full flex items-center justify-center mb-6 border border-white/5">
                        <i class="fa-solid fa-clipboard-list text-4xl text-slate-700"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase italic tracking-tighter">Tidak Ada Pesanan</h3>
                    <p class="text-slate-500 text-sm max-w-xs mb-8">Belum ada transaksi di tab ini.</p>
                    <a href="{{ url('/') }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all">
                        Cari Sparepart
                    </a>
                </div>
            @endforelse

            {{-- Rekomendasi --}}
            <div class="mt-20">
                <div class="flex items-center gap-4 mb-10">
                    <div class="h-px bg-white/5 flex-1"></div>
                    <h2 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.4em] italic">Recommended</h2>
                    <div class="h-px bg-white/5 flex-1"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($recommendations as $rec)
                    <div class="group cursor-pointer">
                        <div class="relative aspect-square rounded-[2rem] overflow-hidden bg-white/5 border border-white/10 mb-4 transition-all group-hover:border-red-600/50 shadow-2xl">
                            <img src="{{ $rec->image ? asset('storage/'.$rec->image) : 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        </div>
                        <h4 class="text-white font-bold text-xs truncate px-1 uppercase tracking-tight">{{ $rec->name }}</h4>
                        <span class="text-red-600 font-black text-xs px-1 italic">Rp {{ number_format($rec->price, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
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