@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* --- ANIMASI SLIDER TETAP ADA --- */
    @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-scroll { animation: scroll 30s linear infinite; }
    .animate-scroll:hover { animation-play-state: paused; }
    .slider-mask { mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); }
    
    /* Scrollbar custom untuk modal */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
    
            [x-cloak] { display: none !important; }
        /* Animasi Loading Overlay */
    #loader {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.9); /* slate-900 */
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.5s ease-out;
    }
    
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(255, 255, 255, 0.1);
        border-top: 5px solid #ef4444; /* red-500 */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loader-hidden {
        opacity: 0;
        pointer-events: none;
    }

        /* Efek Staggered Animation untuk Menu Mobile */
    .mobile-nav-item {
        opacity: 0;
        transform: translateX(-20px);
    }

    /* Saat menu terbuka, jalankan animasi pada tiap item */
    [x-show="openMobile"] .mobile-nav-item {
        animation: slideInRight 0.4s forwards;
        animation-delay: calc(var(--delay) * 0.1s);
    }

    @keyframes slideInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Efek Glassmorphism tambahan */
    .bg-slate-900\/95 {
        background-color: rgba(15, 23, 42, 0.95);
    }

</style>

@php
    $brands = [
        [
            'name' => 'RCB',
            'full_name' => 'Racing Boy',
            'color' => 'red', // Merah
            'desc' => 'Master Rem, Velg, dan Suspensi',
            'products' => ['Velg SP522 Gold', 'Master Rem S1 Radial', 'Shockbreaker VS Series']
        ],
        [
            'name' => 'BRT',
            'full_name' => 'Bintang Racing Team',
            'color' => 'orange', // Orange
            'desc' => 'ECU Juken, Noken As, dan Piston',
            'products' => ['ECU Juken 5++', 'Super Head 22/25', 'Paket Bore Up Ceramic']
        ],
        [
            'name' => 'DAYTONA',
            'full_name' => 'Daytona Japan',
            'color' => 'green', // Hijau
            'desc' => 'Knalpot, Kampas Ganda, dan Filter',
            'products' => ['Knalpot GP Taper', 'Kampas Ganda Carbon', 'Gas Spontan Tombol']
        ],
        [
            'name' => 'YSS',
            'full_name' => 'YSS Suspension',
            'color' => 'blue', // Biru
            'desc' => 'Shockbreaker Tabung & Non-Tabung',
            'products' => ['G-Sport Series', 'G-Top Series', 'DTG Hybrid Shock']
        ],
        [
            'name' => 'TDR',
            'full_name' => 'TDR Racing',
            'color' => 'yellow', // Kuning (Sesuai request snippet kamu)
            'desc' => 'High Performance Parts',
            'products' => ['Roller CVT', 'Per CVT Racing', 'Disc Brake Floating']
        ],
    ];
@endphp
<div x-data="{ 
    mobileFilterOpen: false, 
    modalOpen: false,
    selectedProduct: { name: '', price: '', desc: '', img: '', brand: '' }
}" class="min-h-screen pb-20 relative">

  
    <div class="bg-slate-900 text-white pt-10 pb-16 relative overflow-hidden border-b-4 border-red-600 z-20 shadow-[inset_0_6px_10px_-4px_rgba(0,0,0,0.6)]">
        
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
        
        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-red-600/20 border border-red-600 text-red-400 text-xs font-bold uppercase tracking-widest mb-4">
                Aksesoris & Modifikasi
            </span>
            <h1 class="text-3xl md:text-5xl font-black italic uppercase tracking-tighter mb-4">
                Pusat <span class="text-red-500">Aksesoris</span> Terlengkap
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
                Sedia Aksesoris motor <span class="text-white font-bold">Terbaik</span>, OEM, hingga Aftermarket pilihan. Jaminan presisi untuk motormu.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 mb-10">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-16">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] text-center mb-6">
                Official Brands Partner
            </h2>
            <div class="slider-mask overflow-hidden w-full relative">
                <div class="flex animate-scroll w-max gap-8">
                    
                    {{-- Loop 2x untuk efek infinite scroll --}}
                    @for ($i = 0; $i < 2; $i++) 
                        
                        {{-- Loop Data Brands dari PHP di atas --}}
                        @foreach($brands as $brand)
                        <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-{{ $brand['color'] }}-500 hover:shadow-lg hover:shadow-{{ $brand['color'] }}-500/10 transition-all duration-300">
                            
                            <div class="text-center group-hover:scale-110 transition-transform duration-300 relative z-10 p-2">
                                
                                <img src="" alt="{{ $brand['name'] }}" class="h-10 object-contain mx-auto mb-1 hidden"> 
                                
                                <span class="text-2xl font-black text-slate-700 italic block leading-none">
                                    {{ $brand['name'] }}
                                </span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">
                                    {{ $brand['name'] == 'RCB' ? 'Racing Boy' : ($brand['name'] == 'BRT' ? 'Bintang Racing' : 'Official Partner') }}
                                </span>

                            </div>

                        </div>
                        @endforeach

                    @endfor

                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        
        <div class="lg:hidden mb-4">
            <button @click="mobileFilterOpen = !mobileFilterOpen" class="w-full flex items-center justify-between bg-slate-900 text-white px-4 py-3 rounded-xl font-bold">
                <span><i class="fa-solid fa-filter mr-2"></i> Filter & Cari</span>
                <i :class="mobileFilterOpen ? 'fa-chevron-up' : 'fa-chevron-down'" class="fa-solid transition-transform"></i>
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <aside :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="w-full lg:w-1/4 space-y-6 transition-all">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sticky top-24 shadow-sm">
                    
                    <div class="mb-6">
                        <label class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-2 block">Cari Produk</label>
                        <div class="relative">
                            <input type="text" placeholder="Velg, Knalpot..." class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-slate-400 transition-colors">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                        </div>
                    </div>

                    <div class="mb-6 border-t border-slate-100 pt-6">
                        <label class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 block">Merek / Brand</label>
                        <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar pr-2">
                            @foreach($brands as $brand)
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-0">
                                <span class="text-sm text-slate-500 group-hover:text-slate-900">{{ $brand['name'] }}</span>
                            </label>
                            @endforeach
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-0">
                                <span class="text-sm text-slate-500 group-hover:text-slate-900">Kawahara</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-0">
                                <span class="text-sm text-slate-500 group-hover:text-slate-900">Moto 1</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6 border-t border-slate-100 pt-6">
                        <label class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3 block">Rentang Harga</label>
                        <div class="flex items-center gap-2 mb-2">
                            <input type="number" placeholder="Min" class="w-1/2 bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs">
                            <span class="text-slate-300">-</span>
                            <input type="number" placeholder="Max" class="w-1/2 bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs">
                        </div>
                        <button class="w-full bg-slate-900 text-white text-xs font-bold py-2 rounded-lg hover:bg-slate-800 transition-colors mt-2">Terapkan Filter</button>
                    </div>

                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                
                @foreach($brands as $brand)
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                             <div class="w-1.5 h-6 bg-{{ $brand['color'] }}-600 rounded-full"></div>
                             <h3 class="text-xl font-black text-slate-800 italic uppercase">{{ $brand['name'] }}</h3>
                        </div>
                        <a href="#" class="text-xs font-bold text-{{ $brand['color'] }}-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($brand['products'] as $productName)
                        <div class="bg-white rounded-2xl border border-slate-100 p-4 hover:shadow-xl hover:shadow-{{ $brand['color'] }}-500/10 transition-all duration-300 group">
                            
                            <div class="w-full h-48 bg-slate-50 rounded-xl mb-4 relative flex items-center justify-center overflow-hidden">
                                <span class="absolute top-2 left-2 bg-slate-900 text-white text-[9px] font-bold px-2 py-1 rounded uppercase">Original</span>
                                
                                <img src="" alt="Produk" class="w-full h-full object-contain mix-blend-multiply opacity-80 group-hover:scale-105 transition-transform">
                                <div class="absolute text-slate-300 flex flex-col items-center">
                                    <i class="fa-solid fa-image text-2xl mb-1"></i>
                                    <span class="text-[10px]">No Image</span>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-bold text-slate-800 leading-tight mb-1 truncate">{{ $productName }}</h4>
                                <p class="text-xs text-slate-400 mb-2">{{ $brand['full_name'] }}</p>
                                
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-lg font-black text-slate-900">Rp 450.000</span>
                                    
                                    <button 
                                        @click="modalOpen = true; selectedProduct = { 
                                            name: '{{ $productName }}', 
                                            price: 'Rp 450.000', 
                                            desc: 'Part {{ $brand['name'] }} original kualitas balap. Cocok untuk harian dan touring. Material kuat dan presisi.', 
                                            brand: '{{ $brand['name'] }}',
                                            color: '{{ $brand['color'] }}'
                                        }"
                                        class="bg-white border border-slate-200 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-full hover:bg-{{ $brand['color'] }}-600 hover:text-white hover:border-{{ $brand['color'] }}-600 transition-colors"
                                    >
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </main>
        </div>
    </div>


    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4" x-cloak>
        
        <div 
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalOpen = false" 
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
        ></div>

        <div 
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-10"
            class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl relative overflow-hidden flex flex-col md:flex-row max-h-[90vh] md:max-h-auto"
        >
            <button @click="modalOpen = false" class="absolute top-4 right-4 z-20 w-8 h-8 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-slate-900 transition-colors shadow-sm cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="w-full md:w-1/2 bg-slate-50 flex items-center justify-center p-8 relative">
                 <div class="absolute inset-0 opacity-10 bg-gradient-to-br from-transparent" :class="`to-${selectedProduct.color}-600`"></div>
                 
                 <div class="text-center text-slate-300">
                     <i class="fa-solid fa-image text-6xl mb-4"></i>
                     <p>Product Image Preview</p>
                 </div>
                 </div>

            <div class="w-full md:w-1/2 p-8 overflow-y-auto">
                <div class="mb-1">
                    <span x-text="selectedProduct.brand" :class="`text-${selectedProduct.color}-600`" class="text-sm font-bold uppercase tracking-widest"></span>
                </div>
                
                <h2 x-text="selectedProduct.name" class="text-3xl font-black text-slate-800 italic mb-2 leading-tight"></h2>
                
                <div class="flex items-center gap-2 text-amber-400 text-sm mb-4">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span class="text-slate-400 text-xs">(24 Ulasan)</span>
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 mb-6">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Harga Special</p>
                    <span x-text="selectedProduct.price" class="text-3xl font-black text-slate-900"></span>
                </div>

                <div class="mb-6">
                    <h3 class="text-sm font-bold text-slate-800 mb-2">Deskripsi Produk</h3>
                    <p x-text="selectedProduct.desc" class="text-slate-500 text-sm leading-relaxed"></p>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="border border-slate-200 rounded-lg p-3 text-center cursor-pointer hover:border-slate-800 transition-colors">
                        <span class="block text-xs text-slate-400">Garansi</span>
                        <span class="font-bold text-slate-800 text-sm">6 Bulan</span>
                    </div>
                    <div class="border border-slate-200 rounded-lg p-3 text-center cursor-pointer hover:border-slate-800 transition-colors">
                        <span class="block text-xs text-slate-400">Kondisi</span>
                        <span class="font-bold text-slate-800 text-sm">Baru (New)</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button class="flex-1 bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-slate-900/20">
                        <i class="fa-solid fa-cart-shopping mr-2"></i> Beli Sekarang
                    </button>
                    <button class="w-12 h-12 flex items-center justify-center border border-slate-200 rounded-xl hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
