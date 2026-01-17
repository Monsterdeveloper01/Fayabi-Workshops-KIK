@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

{{-- HELPER VISUAL: Mapping Nama Kategori Database ke Ikon & Warna --}}
@php
    function getCategoryStyle($slug) {
        $styles = [
            'oli-cairan'   => ['icon' => 'fa-oil-can', 'color' => 'amber'],
            'mesin-piston' => ['icon' => 'fa-gears', 'color' => 'red'],
            'pengereman'   => ['icon' => 'fa-motorcycle', 'color' => 'slate'],
            'kelistrikan'  => ['icon' => 'fa-bolt', 'color' => 'blue'],
            // Default style jika kategori baru ditambah
            'default'      => ['icon' => 'fa-box', 'color' => 'gray'] 
        ];
        return $styles[$slug] ?? $styles['default'];
    }
@endphp

<div x-data="{ 
    mobileFilterOpen: false, 
    modalOpen: false,
    selectedProduct: { name: '', price: '', desc: '', type: '', brand: '', image: '' }
}" class="min-h-screen pb-20 bg-slate-50 relative">

    <div class="bg-slate-900 text-white pt-10 pb-16 relative overflow-hidden border-b-4 border-red-600 z-20 shadow-[inset_0_6px_10px_-4px_rgba(0,0,0,0.6)]">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-600 text-red-400 text-xs font-bold uppercase tracking-widest mb-4">
                Bengkel & Maintenance
            </span>
            <h1 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter mb-4">
                Pusat <span class="text-red-500">Sparepart</span> Terlengkap
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
                Sedia suku cadang <span class="text-white font-bold">Genuine (Original)</span>, OEM, hingga Aftermarket pilihan.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-1/4">
                
                <button @click="mobileFilterOpen = !mobileFilterOpen" class="lg:hidden w-full bg-white shadow-md rounded-xl p-4 flex justify-between items-center mb-4 font-bold text-slate-800">
                    <span><i class="fa-solid fa-filter text-red-600 mr-2"></i> Filter Sparepart</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <form action="{{ route('sparepart.index') }}" method="GET">
                    <div :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-24">
                        
                        <div class="mb-6">
                            <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Cari Part / Kode</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Misal: Kampas Rem Vario..." class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 pl-9 pr-3 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
                                <button type="submit" class="absolute left-3 top-2.5 text-slate-400 hover:text-red-600">
                                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Kategori Part</label>
                            <div class="space-y-1 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                                @foreach($categories as $cat)
                                    @php $style = getCategoryStyle($cat->slug); @endphp
                                    <a href="#cat-{{ $cat->id }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 text-slate-600 hover:text-red-600 transition-colors group">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-red-100 group-hover:text-red-600 transition-colors">
                                            <i class="fa-solid {{ $style['icon'] }} text-xs"></i>
                                        </div>
                                        <span class="text-sm font-medium">{{ $cat->name }}</span>
                                        <span class="ml-auto text-[10px] bg-slate-100 px-2 rounded-full text-slate-400">{{ $cat->products->count() }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <label class="text-xs font-bold text-slate-400 uppercase mb-3 block">Kondisi</label>
                            
                            <label class="flex items-center gap-2 mb-2 cursor-pointer hover:bg-slate-50 p-1 rounded">
                                <input type="checkbox" name="condition[]" value="baru" onchange="this.form.submit()" 
                                    {{ in_array('baru', request('condition', [])) ? 'checked' : '' }}
                                    class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                                <span class="text-sm text-slate-600">Baru (New)</span>
                            </label>
                             <label class="flex items-center gap-2 mb-2 cursor-pointer hover:bg-slate-50 p-1 rounded">
                                <input type="checkbox" name="condition[]" value="bekas" onchange="this.form.submit()" 
                                    {{ in_array('bekas', request('condition', [])) ? 'checked' : '' }}
                                    class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                                <span class="text-sm text-slate-600">Bekas (Second)</span>
                            </label>
                        </div>

                        @if(request()->has('search') || request()->has('condition'))
                            <a href="{{ route('sparepart.index') }}" class="block text-center w-full mt-4 text-xs font-bold text-red-500 hover:underline">
                                Reset Filter
                            </a>
                        @endif

                    </div>
                </form>
            </aside>

            <main class="w-full lg:w-3/4 space-y-10">
                
                @forelse($categories as $cat)
                    {{-- Hanya tampilkan kategori jika ada produknya (setelah difilter) --}}
                    @if($cat->products->count() > 0)
                        @php $style = getCategoryStyle($cat->slug); @endphp
                        
                        <div id="cat-{{ $cat->id }}" class="scroll-mt-28">
                            <div class="flex items-center gap-3 mb-6 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                <div class="w-10 h-10 rounded-lg bg-{{ $style['color'] }}-100 flex items-center justify-center text-{{ $style['color'] }}-600">
                                    <i class="fa-solid {{ $style['icon'] }} text-lg"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-black text-slate-800 uppercase italic">{{ $cat->name }}</h2>
                                    <p class="text-xs text-slate-400">Menampilkan {{ $cat->products->count() }} produk tersedia</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                                @foreach($cat->products as $item)
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 hover:shadow-xl hover:border-red-400 transition-all duration-300 group relative flex flex-col h-full">
                                        
                                        <div class="absolute top-0 right-0 z-10">
                                            <span class="text-[10px] font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg text-white
                                                {{ $item->condition == 'baru' ? 'bg-blue-600' : 'bg-orange-500' }}">
                                                {{ ucfirst($item->condition) }}
                                            </span>
                                        </div>

                                        <div class="h-40 bg-slate-50 rounded-lg mb-3 flex items-center justify-center overflow-hidden relative">
                                            @if($item->image)
                                                <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                            @else
                                                <div class="absolute text-slate-300 flex flex-col items-center">
                                                    <i class="fa-solid fa-box-open text-3xl mb-1"></i>
                                                    <span class="text-[10px]">No Image</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 flex flex-col">
                                            <p class="text-xs text-slate-400 mb-1 font-semibold uppercase truncate">{{ $item->brand ?? 'No Brand' }}</p>
                                            <h3 class="font-bold text-slate-800 leading-tight mb-2 line-clamp-2 min-h-[2.5rem]">{{ $item->name }}</h3>
                                            
                                            <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                                                <span class="font-black text-slate-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                                
                                                <button 
                                            @click="modalOpen = true; selectedProduct = {
                                                id: '{{ $item->id }}',   {{-- <--- INI WAJIB DITAMBAHKAN --}}
                                                name: '{{ addslashes($item->name) }}',
                                                brand: '{{ $item->brand ?? 'No Brand' }}',
                                                type: '{{ ucfirst($item->condition) }}',
                                                price: 'Rp {{ number_format($item->price, 0, ',', '.') }}',
                                                desc: '{{ addslashes($item->description) }}',
                                                image: '{{ $item->image ? Storage::url($item->image) : '' }}'
                                            }"
                                            class="text-xs font-bold text-white bg-slate-800 px-3 py-1.5 rounded-full hover:bg-red-600 transition-colors">
                                            Lihat
                                        </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border border-slate-200 border-dashed">
                        <i class="fa-solid fa-box-open text-6xl text-slate-200 mb-4"></i>
                        <h3 class="text-xl font-black text-slate-700">Tidak ada produk ditemukan</h3>
                        <p class="text-slate-400">Coba kata kunci lain atau reset filter.</p>
                        <a href="{{ route('sparepart.index') }}" class="inline-block mt-4 text-red-600 font-bold text-sm hover:underline">Reset Pencarian</a>
                    </div>
                @endforelse

            </main>
        </div>
    </div>

    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4" x-cloak>
        <div @click="modalOpen = false" class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl relative overflow-hidden flex flex-col md:flex-row animate-fade-in-up">
            <button @click="modalOpen = false" class="absolute top-3 right-3 z-20 w-8 h-8 bg-slate-100 hover:bg-red-100 text-slate-500 hover:text-red-500 rounded-full flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="w-full md:w-2/5 bg-slate-100 flex items-center justify-center p-6 relative">
                <img x-show="selectedProduct.image" :src="selectedProduct.image" class="w-full h-full object-contain mix-blend-multiply">
                <div x-show="!selectedProduct.image" class="text-center">
                    <i class="fa-solid fa-box text-6xl text-slate-300"></i>
                    <p class="text-xs text-slate-400 mt-2">No Image</p>
                </div>
            </div>

            <div class="w-full md:w-3/5 p-6">
                <div class="flex items-center gap-2 mb-1">
                    <span x-text="selectedProduct.type" class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-800 text-white uppercase"></span>
                    <span x-text="selectedProduct.brand" class="text-xs font-bold text-slate-500 uppercase"></span>
                </div>
                
                <h2 x-text="selectedProduct.name" class="text-2xl font-black text-slate-800 italic mb-2 leading-tight"></h2>
                <div x-text="selectedProduct.price" class="text-xl font-bold text-red-600 mb-4"></div>
                
                <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 mb-4 h-32 overflow-y-auto custom-scrollbar">
                    <p class="text-xs font-bold text-slate-400 mb-1">Deskripsi & Spesifikasi:</p>
                    <p x-text="selectedProduct.desc" class="text-sm text-slate-600 leading-relaxed whitespace-pre-line"></p>
                </div>

                <form method="POST" action="{{ route('cart.add') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="product_id" :value="selectedProduct.id">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-red-600/20">
                        <i class="fa-solid fa-cart-shopping mr-2"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection