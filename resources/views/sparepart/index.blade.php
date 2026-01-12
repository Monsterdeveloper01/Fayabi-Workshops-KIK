@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    [x-cloak] { display: none !important; }
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

{{-- DATA DUMMY SPAREPART (Lengkap: Ori & Aftermarket) --}}
@php
    $categories = [
        [
            'id' => 'oli',
            'name' => 'Oli & Cairan',
            'icon' => 'fa-oil-can',
            'color' => 'amber', // Kuning Oli
            'products' => [
                ['name' => 'AHM Oil MPX 2 (0.8L)', 'brand' => 'Honda Genuine', 'type' => 'Original', 'price' => 'Rp 55.000', 'desc' => 'Oli mesin matic original Honda. Perlindungan maksimal irit bahan bakar.'],
                ['name' => 'Motul Scooter LE 10W30', 'brand' => 'Motul', 'type' => 'Aftermarket', 'price' => 'Rp 85.000', 'desc' => 'Oli premium teknologi technosynthese untuk performa tinggi.'],
                ['name' => 'Yamalube Super Sport', 'brand' => 'Yamaha Genuine', 'type' => 'Original', 'price' => 'Rp 70.000', 'desc' => 'Full Synthetic untuk motor sport Yamaha series.']
            ]
        ],
        [
            'id' => 'mesin',
            'name' => 'Komponen Mesin',
            'icon' => 'fa-gears',
            'color' => 'red', // Merah Honda
            'products' => [
                ['name' => 'Piston Kit Vario 125', 'brand' => 'Honda Genuine', 'type' => 'Original', 'price' => 'Rp 185.000', 'desc' => 'Set piston, ring, dan pin original presisi tinggi.'],
                ['name' => 'Ring Piston RIK (Riken)', 'brand' => 'RIK', 'type' => 'Aftermarket', 'price' => 'Rp 120.000', 'desc' => 'Ring seher kualitas Jepang, tahan panas dan gesekan ekstrem.'],
                ['name' => 'Blok Seher Ceramic', 'brand' => 'BRT', 'type' => 'Racing/Aftermarket', 'price' => 'Rp 850.000', 'desc' => 'Blok seher bahan ceramic, dingin dan awet untuk bore up.']
            ]
        ],
        [
            'id' => 'rem',
            'name' => 'Pengereman & Kaki-kaki',
            'icon' => 'fa-motorcycle', // Ikon roda/motor
            'color' => 'slate', // Abu-abu metal
            'products' => [
                ['name' => 'Kampas Rem Depan (Discpad)', 'brand' => 'Suzuki Genuine', 'type' => 'Original', 'price' => 'Rp 45.000', 'desc' => 'Kampas rem original Satria FU/GSX. Pakem dan tidak merusak piringan.'],
                ['name' => 'Kampas Rem Bendix', 'brand' => 'Bendix', 'type' => 'Aftermarket', 'price' => 'Rp 65.000', 'desc' => 'Teknologi Hybrid Fusion, pengereman lebih senyap dan bersih.'],
                ['name' => 'Seal Shock Depan', 'brand' => 'NOK', 'type' => 'OEM', 'price' => 'Rp 35.000', 'desc' => 'Seal shock kualitas OEM anti bocor minyak.']
            ]
        ],
        [
            'id' => 'listrik',
            'name' => 'Kelistrikan',
            'icon' => 'fa-bolt',
            'color' => 'blue', // Biru Listrik
            'products' => [
                ['name' => 'Busi NGK Iridium', 'brand' => 'NGK', 'type' => 'Aftermarket', 'price' => 'Rp 95.000', 'desc' => 'Api lebih fokus, pembakaran sempurna, tarikan enteng.'],
                ['name' => 'Aki GS Astra GTZ5S', 'brand' => 'GS Astra', 'type' => 'Original', 'price' => 'Rp 230.000', 'desc' => 'Aki kering bebas perawatan, standar pabrikan motor Indonesia.']
            ]
        ]
    ];
@endphp


<div x-data="{ 
    mobileFilterOpen: false, 
    modalOpen: false,
    selectedProduct: { name: '', price: '', desc: '', type: '', brand: '' }
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
                Sedia suku cadang <span class="text-white font-bold">Genuine (Original)</span>, OEM, hingga Aftermarket pilihan. Jaminan presisi untuk motormu.
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

                <div :class="mobileFilterOpen ? 'block' : 'hidden lg:block'" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-24">
                    <div class="mb-6">
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Cari Part / Kode</label>
                        <div class="relative">
                            <input type="text" placeholder="Misal: Kampas Rem Vario..." class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 pl-9 pr-3 text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-xs"></i>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-bold text-slate-400 uppercase mb-2 block">Kategori Part</label>
                        <div class="space-y-1">
                            @foreach($categories as $cat)
                            <a href="#{{ $cat['id'] }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 text-slate-600 hover:text-red-600 transition-colors group">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-red-100 group-hover:text-red-600 transition-colors">
                                    <i class="fa-solid {{ $cat['icon'] }} text-xs"></i>
                                </div>
                                <span class="text-sm font-medium">{{ $cat['name'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <label class="text-xs font-bold text-slate-400 uppercase mb-3 block">Kualitas / Tipe</label>
                        <label class="flex items-center gap-2 mb-2 cursor-pointer">
                            <input type="checkbox" class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                            <span class="text-sm text-slate-600">Genuine (Original Pabrik)</span>
                        </label>
                         <label class="flex items-center gap-2 mb-2 cursor-pointer">
                            <input type="checkbox" class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                            <span class="text-sm text-slate-600">OEM / Import</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded text-red-600 focus:ring-red-500 border-slate-300">
                            <span class="text-sm text-slate-600">Aftermarket / Racing</span>
                        </label>
                    </div>
                </div>
            </aside>

            <main class="w-full lg:w-3/4 space-y-10">
                
                @foreach($categories as $cat)
                <div id="{{ $cat['id'] }}" class="scroll-mt-28">
                    <div class="flex items-center gap-3 mb-6 bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-{{ $cat['color'] }}-100 flex items-center justify-center text-{{ $cat['color'] }}-600">
                            <i class="fa-solid {{ $cat['icon'] }} text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-black text-slate-800 uppercase italic">{{ $cat['name'] }}</h2>
                            <p class="text-xs text-slate-400">Menampilkan stok tersedia</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                        @foreach($cat['products'] as $item)
                        <div class="bg-white border border-slate-200 rounded-xl p-4 hover:shadow-xl hover:border-red-400 transition-all duration-300 group relative">
                            
                            <div class="absolute top-0 right-0">
                                <span class="text-[10px] font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg text-white
                                    {{ $item['type'] == 'Original' ? 'bg-blue-600' : ($item['type'] == 'Aftermarket' ? 'bg-orange-500' : 'bg-slate-500') }}">
                                    {{ $item['type'] }}
                                </span>
                            </div>

                            <div class="h-40 bg-slate-50 rounded-lg mb-3 flex items-center justify-center overflow-hidden relative">
                                <img src="" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform mix-blend-multiply">
                                <div class="absolute text-slate-300 flex flex-col items-center">
                                    <i class="fa-solid fa-box-open text-3xl mb-1"></i>
                                    <span class="text-[10px]">Foto Part</span>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-slate-400 mb-1 font-semibold uppercase">{{ $item['brand'] }}</p>
                                <h3 class="font-bold text-slate-800 leading-tight mb-2 h-10 line-clamp-2">{{ $item['name'] }}</h3>
                                
                                <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100">
                                    <span class="font-black text-slate-900">{{ $item['price'] }}</span>
                                    <button 
                                        @click="modalOpen = true; selectedProduct = {
                                            name: '{{ $item['name'] }}',
                                            brand: '{{ $item['brand'] }}',
                                            type: '{{ $item['type'] }}',
                                            price: '{{ $item['price'] }}',
                                            desc: '{{ $item['desc'] }}'
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
                @endforeach

            </main>
        </div>
    </div>

    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4" x-cloak>
        <div @click="modalOpen = false" class="absolute inset-0 bg-slate-900/70 backdrop-blur-sm"></div>
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl relative overflow-hidden flex flex-col md:flex-row animate-fade-in-up">
            <button @click="modalOpen = false" class="absolute top-3 right-3 z-20 w-8 h-8 bg-slate-100 hover:bg-red-100 text-slate-500 hover:text-red-500 rounded-full flex items-center justify-center transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="w-full md:w-2/5 bg-slate-100 flex items-center justify-center p-6">
                <i class="fa-solid fa-box text-6xl text-slate-300"></i>
            </div>

            <div class="w-full md:w-3/5 p-6">
                <div class="flex items-center gap-2 mb-1">
                    <span x-text="selectedProduct.type" class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-800 text-white uppercase"></span>
                    <span x-text="selectedProduct.brand" class="text-xs font-bold text-slate-500 uppercase"></span>
                </div>
                
                <h2 x-text="selectedProduct.name" class="text-2xl font-black text-slate-800 italic mb-2 leading-tight"></h2>
                <div x-text="selectedProduct.price" class="text-xl font-bold text-red-600 mb-4"></div>
                
                <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 mb-4">
                    <p class="text-xs font-bold text-slate-400 mb-1">Deskripsi & Spesifikasi:</p>
                    <p x-text="selectedProduct.desc" class="text-sm text-slate-600 leading-relaxed"></p>
                </div>

                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-red-600/20">
                    <i class="fa-solid fa-cart-shopping mr-2"></i> Tambah ke Keranjang
                </button>
            </div>
        </div>
    </div>

</div>
@endsection