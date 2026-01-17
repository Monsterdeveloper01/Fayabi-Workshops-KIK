@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 py-10 relative overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none" 
         style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;">
    </div>

    <div class="container mx-auto px-4 relative z-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">
                    Manajemen <span class="text-red-600">Produk</span>
                </h1>
                <p class="text-slate-400 text-sm mt-1">Kelola etalase tokomu dengan cerdas.</p>
            </div>
            
            <a href="{{ route('vendor.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-red-600/20 transition-all transform hover:scale-105 flex items-center gap-2 text-sm uppercase tracking-wider">
                <i class="fa-solid fa-plus"></i> Tambah Baru
            </a>
        </div>

        {{-- STATISTIC FILTER BAR (TOMBOL FILTER) --}}
        <div class="bg-slate-900/50 backdrop-blur-md border border-white/10 p-2 rounded-2xl mb-10 overflow-x-auto">
            <div class="flex items-center gap-2 min-w-max">
                
                {{-- 1. SEMUA (Default) --}}
                <a href="{{ route('vendor.products') }}" 
                   class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 {{ request('filter') == null ? 'bg-slate-100 text-slate-900' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-layer-group"></i> Semua
                </a>

                {{-- 2. TERLAKU (Best Seller) --}}
                <a href="{{ route('vendor.products', ['filter' => 'terlaku']) }}" 
                   class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 {{ request('filter') == 'terlaku' ? 'bg-amber-500 text-slate-900 shadow-lg shadow-amber-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-amber-500' }}">
                    <i class="fa-solid fa-fire"></i> Paling Laku
                </a>

                {{-- 3. TERMAHAL (Sultan) --}}
                <a href="{{ route('vendor.products', ['filter' => 'termahal']) }}" 
                   class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 {{ request('filter') == 'termahal' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-white/5 hover:text-purple-400' }}">
                    <i class="fa-solid fa-crown"></i> Termahal
                </a>

                {{-- 4. TERMURAH (Budget) --}}
                <a href="{{ route('vendor.products', ['filter' => 'termurah']) }}" 
                   class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 {{ request('filter') == 'termurah' ? 'bg-green-600 text-white shadow-lg shadow-green-600/20' : 'text-slate-400 hover:bg-white/5 hover:text-green-400' }}">
                    <i class="fa-solid fa-tags"></i> Termurah
                </a>

                {{-- 5. JARANG DIBELI (Stok Numpuk) --}}
                <a href="{{ route('vendor.products', ['filter' => 'jarang_dibeli']) }}" 
                   class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-widest transition-all flex items-center gap-2 {{ request('filter') == 'jarang_dibeli' ? 'bg-slate-700 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-red-400' }}">
                    <i class="fa-solid fa-box-archive"></i> Stok Numpuk
                </a>

            </div>
        </div>

        {{-- JUDUL FILTER AKTIF --}}
        <div class="mb-6 border-l-4 border-red-600 pl-4">
            <h2 class="text-xl font-bold text-white uppercase">{{ $title }}</h2>
            <p class="text-xs text-slate-500">Menampilkan {{ $products->count() }} item</p>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @forelse($products as $item)
            <div class="group bg-slate-900 border border-white/5 rounded-2xl overflow-hidden hover:border-red-600/50 hover:shadow-xl hover:shadow-red-600/10 transition-all duration-300 relative">
                
                {{-- Tombol Aksi (Edit/Hapus) - Muncul saat Hover --}}
                <div class="absolute top-3 right-3 z-20 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300">
                    <button class="w-8 h-8 rounded-lg bg-white text-slate-900 hover:bg-amber-400 flex items-center justify-center shadow-lg" title="Edit">
                        <i class="fa-solid fa-pen text-xs"></i>
                    </button>
                    <button class="w-8 h-8 rounded-lg bg-white text-slate-900 hover:bg-red-600 hover:text-white flex items-center justify-center shadow-lg" title="Hapus">
                        <i class="fa-solid fa-trash text-xs"></i>
                    </button>
                </div>

                {{-- Image Thumbnail --}}
                <div class="h-48 bg-slate-800 relative overflow-hidden flex items-center justify-center">
                    @if($item->image)
                        <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                    @else
                        <i class="fa-solid fa-image text-4xl text-slate-600"></i>
                    @endif
                    
                    {{-- Badge Stok --}}
                    <div class="absolute bottom-2 left-2 px-2 py-1 rounded bg-black/60 backdrop-blur-sm border border-white/10">
                        <p class="text-[10px] font-bold {{ $item->stock < 5 ? 'text-red-500' : 'text-green-400' }}">
                            Stok: {{ $item->stock }}
                        </p>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    {{-- Kategori Badge --}}
                    <span class="inline-block text-[9px] font-black uppercase tracking-wider mb-2 px-2 py-0.5 rounded 
                        {{ $item->category->type == 'aksesoris' ? 'bg-purple-500/10 text-purple-400' : 'bg-blue-500/10 text-blue-400' }}">
                        {{ $item->category->name }}
                    </span>

                    <h3 class="text-white font-bold text-lg leading-tight mb-1 truncate">{{ $item->name }}</h3>
                    <p class="text-slate-500 text-xs mb-3">{{ $item->brand ?? 'No Brand' }}</p>

                    <div class="flex items-center justify-between border-t border-white/5 pt-3">
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-400 uppercase">Harga Jual</span>
                            <span class="text-red-500 font-black text-lg">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div class="inline-block w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-filter-circle-xmark text-2xl text-slate-500"></i>
                </div>
                <h3 class="text-white font-bold text-lg">Tidak ada produk ditemukan</h3>
                <p class="text-slate-500 text-sm">Coba ubah filter atau tambah produk baru.</p>
            </div>
            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-10">
            {{ $products->links() }} 
        </div>

    </div>
</div>
@endsection