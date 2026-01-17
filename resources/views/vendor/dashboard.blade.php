@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 relative overflow-hidden">
    
    {{-- Background Glow Effects --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-red-600/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-4 py-10 relative z-10">

        {{-- 1. HEADER & ACTION --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 mb-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Vendor Area</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white italic uppercase tracking-tighter">
                    Halo, <span class="text-red-600">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-slate-400 text-sm mt-1">Kelola stok aksesoris dan sparepartmu di sini.</p>
            </div>

            <a href="{{ route('vendor.create') }}" class="group relative px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-black rounded-xl uppercase tracking-wider text-xs shadow-lg shadow-red-600/20 transition-all hover:scale-105">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-lg"></i> Upload Produk Baru
                </span>
            </a>
        </div>

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-8 p-4 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-center gap-4 text-green-400">
            <div class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <h4 class="font-bold text-sm">Berhasil!</h4>
                <p class="text-xs opacity-80">{{ session('status') }}</p>
            </div>
        </div>
        @endif

        {{-- 2. STATISTIK CARDS --}}
        @php
            // Hitung data dummy/real sederhana
            $totalProduk = $products->count();
            $totalStok = $products->sum('stock');
            $estimasiAset = $products->sum(function($p) { return $p->price * $p->stock; });
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-3xl relative overflow-hidden group hover:border-red-500/50 transition-colors">
                <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-box-open text-6xl text-white"></i>
                </div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Produk</p>
                <h3 class="text-4xl font-black text-white">{{ $totalProduk }} <span class="text-lg text-slate-500 font-medium">Item</span></h3>
            </div>

            <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-3xl relative overflow-hidden group hover:border-blue-500/50 transition-colors">
                <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-layer-group text-6xl text-white"></i>
                </div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Sisa Stok Fisik</p>
                <h3 class="text-4xl font-black text-white">{{ $totalStok }} <span class="text-lg text-slate-500 font-medium">Unit</span></h3>
            </div>

            <div class="bg-slate-900/50 backdrop-blur-md border border-white/5 p-6 rounded-3xl relative overflow-hidden group hover:border-amber-500/50 transition-colors">
                <div class="absolute right-0 top-0 p-6 opacity-10 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-wallet text-6xl text-white"></i>
                </div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Estimasi Nilai Aset</p>
                <h3 class="text-2xl md:text-3xl font-black text-white truncate">Rp {{ number_format($estimasiAset, 0, ',', '.') }}</h3>
            </div>
        </div>

        {{-- 3. TABEL PRODUK --}}
        <div class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-lg font-black text-white italic uppercase tracking-wider">
                    <i class="fa-solid fa-list-ul text-red-600 mr-2"></i> Inventaris Saya
                </h3>
                
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Cari SKU / Nama..." class="bg-slate-950 border border-slate-800 rounded-full py-2 pl-10 pr-4 text-xs text-white focus:border-red-600 focus:outline-none w-64">
                    <i class="fa-solid fa-search absolute left-3.5 top-2.5 text-slate-500 text-xs"></i>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-white/5 bg-slate-950/50">
                            <th class="p-5">Info Produk</th>
                            <th class="p-5">Kategori</th>
                            <th class="p-5">Harga</th>
                            <th class="p-5 text-center">Stok</th>
                            <th class="p-5 text-center">Kondisi</th>
                            <th class="p-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        
                        @forelse($products as $item)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="p-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-slate-800 border border-white/10 overflow-hidden flex items-center justify-center shrink-0">
                                        @if($item->image)
                                            <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-image text-slate-600"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-sm mb-1 group-hover:text-red-500 transition-colors line-clamp-1">{{ $item->name }}</h4>
                                        <p class="text-[10px] text-slate-500 uppercase">{{ $item->brand ?? 'No Brand' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="p-5">
                                @if($item->category->type == 'aksesoris')
                                    <span class="inline-block px-2 py-1 rounded bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[10px] font-bold uppercase">Aksesoris</span>
                                @else
                                    <span class="inline-block px-2 py-1 rounded bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold uppercase">Sparepart</span>
                                @endif
                                <p class="text-xs text-slate-400 mt-1">{{ $item->category->name }}</p>
                            </td>

                            <td class="p-5">
                                <span class="text-white font-bold text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </td>

                            <td class="p-5 text-center">
                                @if($item->stock > 5)
                                    <span class="text-green-400 font-bold text-sm">{{ $item->stock }}</span>
                                @elseif($item->stock > 0)
                                    <span class="text-amber-500 font-bold text-sm">{{ $item->stock }}</span>
                                    <p class="text-[9px] text-amber-500/70">Menipis</p>
                                @else
                                    <span class="text-red-500 font-bold text-sm">Habis</span>
                                @endif
                            </td>

                            <td class="p-5 text-center">
                                <span class="text-xs text-slate-300 capitalize">{{ $item->condition }}</span>
                            </td>

                            <td class="p-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="w-8 h-8 rounded-lg bg-slate-800 text-slate-400 hover:bg-white hover:text-slate-900 transition-colors flex items-center justify-center" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                    <button class="w-8 h-8 rounded-lg bg-slate-800 text-slate-400 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center">
                                <div class="inline-block p-4 rounded-full bg-slate-800 mb-4">
                                    <i class="fa-solid fa-box-open text-3xl text-slate-600"></i>
                                </div>
                                <h3 class="text-white font-bold mb-1">Belum ada produk</h3>
                                <p class="text-slate-500 text-xs mb-4">Mulai jualan dengan mengupload produk pertamamu.</p>
                                <a href="{{ route('vendor.create') }}" class="text-red-500 text-xs font-bold hover:underline uppercase tracking-widest">
                                    Upload Sekarang
                                </a>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-white/5 bg-slate-950/30">
                <p class="text-center text-[10px] text-slate-600 uppercase font-bold tracking-widest">
                    Menampilkan {{ $products->count() }} Produk Terakhir
                </p>
            </div>
        </div>

    </div>
</div>
@endsection