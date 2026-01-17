@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 py-12 relative overflow-hidden">
    
    {{-- Elemen Dekoratif --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10 max-w-5xl">
        
        {{-- Breadcrumb & Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('vendor.orders.index') }}" class="w-12 h-12 rounded-2xl bg-slate-900 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:border-red-600 transition-all group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">
                        Detail <span class="text-red-600">Pesanan</span>
                    </h1>
                    <p class="text-slate-500 font-mono text-xs tracking-widest uppercase">Invoice: {{ $order->order_number }}</p>
                </div>
            </div>

            {{-- Badge Status Order --}}
            <div class="flex items-center gap-3 bg-white/5 border border-white/10 p-2 rounded-2xl">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Status Pesanan:</span>
                <span class="px-4 py-1.5 rounded-xl text-xs font-black uppercase italic tracking-wider
                    {{ $order->status == 'pending' ? 'bg-amber-500/20 text-amber-500 border border-amber-500/30' : 'bg-green-500/20 text-green-500 border border-green-500/30' }}">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KIRI: INFORMASI PEMBELI & ALAMAT --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Data Customer --}}
                <div class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-[2rem] p-8">
                    <h3 class="text-white font-black uppercase italic text-sm tracking-wider mb-6 border-b border-white/5 pb-4">
                        <i class="fa-solid fa-user-tag text-red-600 mr-2"></i> Data Pelanggan
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-red-600/10 border border-red-600/20 flex items-center justify-center text-red-500 shadow-[0_0_15px_rgba(220,0,46,0.2)]">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest">Nama Lengkap</p>
                                <p class="text-sm text-white font-bold">{{ $order->user->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-600/10 border border-blue-600/20 flex items-center justify-center text-blue-500">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest">No. WhatsApp</p>
                                <p class="text-sm text-white font-bold">{{ $order->user->phone_number ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Alamat Pengiriman --}}
                <div class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-[2rem] p-8">
                    <h3 class="text-white font-black uppercase italic text-sm tracking-wider mb-6 border-b border-white/5 pb-4">
                        <i class="fa-solid fa-map-location-dot text-red-600 mr-2"></i> Alamat Kirim
                    </h3>
                    
                    @if($order->user->address_line)
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Penerima</p>
                            <p class="text-sm text-white font-bold">{{ $order->user->recipient_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Detail Jalan</p>
                            <p class="text-xs text-slate-300 leading-relaxed font-medium">
                                {{ $order->user->address_line }}
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Kota</p>
                                <p class="text-xs text-white font-bold uppercase">{{ $order->user->city }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Kode Pos</p>
                                <p class="text-xs text-white font-bold">{{ $order->user->postal_code }}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-red-500 text-xs italic font-bold">Alamat tidak ditemukan!</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- KANAN: DAFTAR BARANG --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl">
                    <div class="p-8 border-b border-white/5 flex items-center justify-between">
                        <h3 class="text-white font-black uppercase italic text-sm tracking-wider">
                            Daftar Produk Anda <span class="text-slate-500 font-normal lowercase ml-2">({{ $vendorItems->count() }} item)</span>
                        </h3>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full">Items Only from Your Shop</span>
                    </div>

                    <div class="divide-y divide-white/5">
                        @foreach($vendorItems as $item)
                        <div class="p-8 flex flex-col md:flex-row items-center gap-6 group hover:bg-white/[0.02] transition-colors">
                            {{-- Foto Produk --}}
                            <div class="w-24 h-24 rounded-2xl bg-slate-800 border border-white/10 overflow-hidden flex-shrink-0 relative group-hover:border-red-600/50 transition-colors">
                                @if($item->product && $item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-600">
                                        <i class="fa-solid fa-image text-2xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                            </div>

                            {{-- Info Produk --}}
                            <div class="flex-grow text-center md:text-left">
                                <h4 class="text-lg font-black text-white italic uppercase leading-tight mb-1">{{ $item->product_name }}</h4>
                                <div class="flex flex-wrap justify-center md:justify-start gap-3 items-center mt-2">
                                    <span class="text-[10px] font-black text-red-500 uppercase tracking-widest bg-red-500/10 px-2 py-0.5 rounded">ID: PRD-{{ $item->product_id }}</span>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Qty: {{ $item->qty }}</span>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="text-center md:text-right flex-shrink-0">
                                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest mb-1">Total Harga</p>
                                <p class="text-xl font-black text-white tracking-tighter italic">
                                    Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                </p>
                                <p class="text-[10px] text-slate-500 font-bold">@ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Total Pendapatan Vendor --}}
                    <div class="p-8 bg-white/[0.03] border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-black tracking-[0.2em] mb-1">Subtotal Pendapatan Anda</p>
                            <p class="text-sm text-slate-500 font-medium italic italic">Excl. Shipping & Service Fee</p>
                        </div>
                        <div class="text-right">
                            <span class="text-3xl font-black text-white italic tracking-tighter">
                                Rp {{ number_format($vendorTotal, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap justify-end gap-4">
                    <button onclick="window.print()" class="px-6 py-4 rounded-2xl border border-white/10 text-slate-300 font-black uppercase text-xs tracking-widest hover:bg-white/5 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Cetak Label
                    </button>
                    <button class="px-8 py-4 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-black uppercase text-xs tracking-[0.2em] transition-all shadow-[0_10px_30px_rgba(220,0,46,0.3)] transform active:scale-95 flex items-center gap-2">
                        <i class="fa-solid fa-truck-fast"></i> Proses Pengiriman
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        nav, .absolute, button, a { display: none !important; }
        .bg-slate-950 { background: white !important; color: black !important; }
        .text-white { color: black !important; }
        .bg-slate-900\/50 { background: white !important; border: 1px solid #eee !important; }
        .lg:col-span-1, .lg:col-span-2 { width: 100% !important; }
    }
</style>
@endsection