@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    
    /* Animasi Slider */
    @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-scroll { animation: scroll 30s linear infinite; }
    .animate-scroll:hover { animation-play-state: paused; }
    .slider-mask { mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); }
</style>

{{-- HELPER VISUAL: Mapping Ikon Kategori Aksesoris --}}
@php
    function getAksesorisStyle($slug) {
        $styles = [
            'helm-apparel'   => ['icon' => 'fa-helmet-safety', 'color' => 'orange'],
            'knalpot-racing' => ['icon' => 'fa-fire-burner', 'color' => 'red'],
            'velg-ban'       => ['icon' => 'fa-ring', 'color' => 'yellow'], // Velg = Ring
            'suspensi'       => ['icon' => 'fa-spring', 'color' => 'blue'], // Spring = Per/Suspensi
            'default'        => ['icon' => 'fa-gem', 'color' => 'gray'] 
        ];
        return $styles[$slug] ?? $styles['default'];
    }

    // Data Slider (Tetap Hardcode biar tampilan atasnya bagus)
    $sliderBrands = [
        ['name' => 'RCB', 'color' => 'red'], ['name' => 'BRT', 'color' => 'orange'],
        ['name' => 'TDR', 'color' => 'yellow'], ['name' => 'YSS', 'color' => 'blue'],
        ['name' => 'MOTO1', 'color' => 'purple']
    ];
@endphp

<div x-data="{ 
    mobileFilterOpen: false, 
    modalOpen: false,
    selectedProduct: { id: '', name: '', price: '', desc: '', type: '', brand: '', image: '', color: 'red' }
}" class="min-h-screen pb-20 bg-slate-50 relative">

    <div class="bg-slate-900 text-white pt-10 pb-16 relative overflow-hidden border-b-4 border-red-600 z-20 shadow-[inset_0_6px_10px_-4px_rgba(0,0,0,0.6)]">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-600 text-red-400 text-xs font-bold uppercase tracking-widest mb-4">
                Lifestyle & Performance
            </span>
            <h1 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter mb-4">
                Pusat <span class="text-red-500">Aksesoris</span> Terlengkap
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
                Upgrade tampilan dan performa motormu dengan part <span class="text-white font-bold">Racing & Modifikasi</span> terbaik.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-8 relative z-30 mb-12">
        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-6">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] text-center mb-6">Official Brands Partner</h2>
            <div class="slider-mask overflow-hidden w-full relative">
                <div class="flex animate-scroll w-max gap-8">
                    @for ($i = 0; $i < 4; $i++) 
                        @foreach($sliderBrands as $brand)
                        <div class="w-[140px] h-[80px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center grayscale hover:grayscale-0 hover:border-{{ $brand['color'] }}-500 transition-all duration-300 cursor-pointer">
                            <span class="text-xl font-black text-slate-300 italic">{{ $brand['name'] }}</span>
                        </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside class="w-full lg:w-1/4">
                <button @click="mobileFilterOpen = !mobileFilterOpen" class="lg:hidden w-full bg-slate-900 text-white shadow-md rounded-xl p-4 flex justify-between items-center mb-4 font-bold">
                    <span><i class="fa-solid fa-filter mr-2"></i> Filter Produk</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <form action="{{ route('aksesoris.index') }}" method="GET">
                    <div :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-24">
                        
                        <div class="mb-6">
                            <label class="text-xs font-bold text-slate-800 uppercase mb-2 block">Cari Produk</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Knalpot, Velg..." class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 pl-9 pr-3 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
                                <button type="submit" class="absolute left-3 top-2.5 text-slate-400 hover:text-red-600">
                                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-6 border-t border-slate-100 pt-6">
                            <label class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 block">Merek / Brand</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar pr-2">
                                @foreach($brands as $brand)
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" name="brands[]" value="{{ $brand }}" onchange="this.form.submit()"
                                        {{ in_array($brand, request('brands', [])) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-slate-300 text-red-600 focus:ring-red-500">
                                    <span class="text-sm text-slate-500 group-hover:text-slate-900 uppercase">{{ $brand }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6 border-t border-slate-100 pt-6">
                            <label class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 block">Rentang Harga</label>
                            <div class="flex items-center gap-2 mb-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-1/2 bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs">
                                <span class="text-slate-300">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-1/2 bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs">
                            </div>
                            <button type="submit" class="w-full bg-slate-900 text-white text-xs font-bold py-2 rounded-lg hover:bg-slate-800 transition-colors mt-2">Terapkan</button>
                        </div>
                        
                        @if(request()->hasAny(['search', 'brands', 'min_price', 'max_price']))
                            <a href="{{ route('aksesoris.index') }}" class="block text-center w-full mt-4 text-xs font-bold text-red-500 hover:underline">Reset Filter</a>
                        @endif
                    </div>
                </form>
            </aside>

            <main class="w-full lg:w-3/4 space-y-12">
                
                @forelse($categories as $cat)
                    @if($cat->products->count() > 0)
                        @php $style = getAksesorisStyle($cat->slug); @endphp
                        
                        <div>
                            <div class="flex items-center justify-between mb-6 border-b border-slate-200 pb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-{{ $style['color'] }}-100 flex items-center justify-center text-{{ $style['color'] }}-600">
                                        <i class="fa-solid {{ $style['icon'] }}"></i>
                                    </div>
                                    <h2 class="text-2xl font-black text-slate-800 italic uppercase">{{ $cat->name }}</h2>
                                </div>
                                <span class="text-xs font-bold bg-slate-100 px-3 py-1 rounded-full text-slate-500">{{ $cat->products->count() }} Item</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach($cat->products as $item)
                                <div class="group bg-white rounded-2xl border border-slate-100 p-4 hover:shadow-2xl hover:shadow-{{ $style['color'] }}-500/10 hover:border-{{ $style['color'] }}-500 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                                    
                                    <div class="absolute top-4 left-4 z-10">
                                        @if($item->stock > 0)
                                            <span class="bg-slate-900 text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">Ready</span>
                                        @else
                                            <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">Habis</span>
                                        @endif
                                    </div>

                                    <div class="w-full h-56 bg-slate-50 rounded-xl mb-4 overflow-hidden relative flex items-center justify-center group-hover:bg-white transition-colors">
                                        @if($item->image)
                                            <img src="{{ Storage::url($item->image) }}" class="w-full h-full object-contain mix-blend-multiply group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="text-slate-300 text-center">
                                                <i class="fa-solid fa-image text-3xl mb-2"></i>
                                                <p class="text-[10px]">No Image</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 flex flex-col">
                                        <p class="text-xs font-bold text-{{ $style['color'] }}-600 uppercase tracking-widest mb-1">{{ $item->brand ?? 'Generic' }}</p>
                                        <h3 class="text-lg font-bold text-slate-800 leading-tight mb-2 line-clamp-2">{{ $item->name }}</h3>
                                        
                                        <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                                            <div>
                                                <p class="text-[10px] text-slate-400">Harga Terbaik</p>
                                                <span class="text-xl font-black text-slate-900">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                            </div>
                                            
                                            {{-- UPDATE DI SINI: MENAMBAHKAN ID PADA OBJEK ALPINE --}}
                                            <button 
                                                @click="modalOpen = true; selectedProduct = {
                                                    id: '{{ $item->id }}',  {{-- <--- PENTING! --}}
                                                    name: '{{ addslashes($item->name) }}',
                                                    brand: '{{ $item->brand ?? 'Generic' }}',
                                                    type: '{{ $cat->name }}',
                                                    price: 'Rp {{ number_format($item->price, 0, ',', '.') }}',
                                                    desc: '{{ addslashes($item->description) }}',
                                                    image: '{{ $item->image ? Storage::url($item->image) : '' }}',
                                                    color: '{{ $style['color'] }}'
                                                }"
                                                class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center hover:bg-{{ $style['color'] }}-600 transition-colors shadow-lg hover:shadow-{{ $style['color'] }}-500/30">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-20">
                        <div class="inline-block w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-helmet-un text-4xl text-slate-300"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-700">Produk Tidak Ditemukan</h3>
                        <p class="text-slate-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
                        <a href="{{ route('aksesoris.index') }}" class="inline-block mt-4 text-red-600 font-bold hover:underline">Reset Filter</a>
                    </div>
                @endforelse

            </main>
        </div>
    </div>

    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4" x-cloak>
        <div @click="modalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl relative overflow-hidden flex flex-col md:flex-row animate-fade-in-up max-h-[90vh]">
            <button @click="modalOpen = false" class="absolute top-4 right-4 z-20 w-8 h-8 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-slate-900 transition-colors shadow-sm cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="w-full md:w-1/2 bg-slate-50 flex items-center justify-center p-8 relative">
                 <div class="absolute inset-0 opacity-10 bg-gradient-to-br from-transparent" :class="`to-${selectedProduct.color}-600`"></div>
                 
                 <img x-show="selectedProduct.image" :src="selectedProduct.image" class="w-full h-full object-contain mix-blend-multiply relative z-10">
                 <div x-show="!selectedProduct.image" class="text-center text-slate-300">
                     <i class="fa-solid fa-image text-6xl mb-4"></i>
                     <p>No Image Preview</p>
                 </div>
            </div>

            <div class="w-full md:w-1/2 p-8 overflow-y-auto">
                <div class="mb-1">
                    <span x-text="selectedProduct.brand" :class="`text-${selectedProduct.color}-600`" class="text-sm font-bold uppercase tracking-widest"></span>
                </div>
                
                <h2 x-text="selectedProduct.name" class="text-3xl font-black text-slate-800 italic mb-2 leading-tight"></h2>
                
                <div class="flex items-center gap-1 text-amber-400 text-sm mb-4">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    <span class="text-slate-400 text-xs ml-2">(Review)</span>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 mb-6">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Harga Penawaran</p>
                    <span x-text="selectedProduct.price" class="text-3xl font-black text-slate-900"></span>
                </div>

                <div class="mb-6 h-32 overflow-y-auto custom-scrollbar pr-2">
                    <h3 class="text-sm font-bold text-slate-800 mb-2">Deskripsi Produk</h3>
                    <p x-text="selectedProduct.desc" class="text-slate-500 text-sm leading-relaxed whitespace-pre-line"></p>
                </div>

                {{-- UPDATE DI SINI: FORM MODAL DENGAN INPUT HIDDEN ID --}}
                <form method="POST" action="{{ route('cart.add') }}" class="flex gap-3">
                    @csrf
                    {{-- Input Hidden untuk mengirim ID Produk --}}
                    <input type="hidden" name="product_id" :value="selectedProduct.id">

                    <button class="flex-1 bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-slate-900/20">
                        <i class="fa-solid fa-cart-shopping mr-2"></i> Beli Sekarang
                    </button>
                    <button type="button" class="w-12 h-12 flex items-center justify-center border border-slate-200 rounded-xl hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection