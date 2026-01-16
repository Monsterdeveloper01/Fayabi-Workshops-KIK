@extends('layouts.app')

@section('content')
<style>
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .animate-infinite-scroll {
        display: flex;
        width: max-content;
        animation: scroll 40s linear infinite;
    }

    .group-scroll:hover .animate-infinite-scroll {
        animation-play-state: paused;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="space-y-6">
{{-- HERO SECTION LURUS - UKURAN PROPORSIONAL --}}
<div class="relative w-full h-[400px] md:h-[500px] overflow-hidden mb-0 group">
    {{-- Background Gambar Motor --}}
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?q=80&w=2000&auto=format&fit=crop" 
             class="w-full h-full object-cover transition-transform duration-[3000ms] group-hover:scale-110"
             alt="Fayabi Workshop Hero">
        
        {{-- Overlay Gradasi --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-transparent to-transparent"></div>
    </div>

    {{-- Konten Teks --}}
    <div class="relative z-10 h-full flex flex-col justify-center px-6 md:px-16">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-[2px] w-8 bg-red-600"></div>
                <span class="text-white font-black uppercase tracking-[0.4em] text-[9px]">Premium Garage</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-black text-white italic uppercase leading-none tracking-tighter mb-4">
                FAYABI <br><span class="text-red-600">WORKSHOP'S</span>
            </h1>
            
            <p class="text-slate-200 text-xs md:text-sm max-w-lg font-bold italic leading-relaxed mb-8 opacity-90">
                Layanan otomotif profesional dengan standar workshop internasional. Fokus pada presisi, performa, dan estetika motor Anda.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="/service_motor" class="bg-red-600 hover:bg-white text-white hover:text-slate-900 px-7 py-3 font-black uppercase tracking-widest text-[10px] transition-all duration-300">
                    Booking Service
                </a>
                <a href="/sparepart" class="bg-transparent border-2 border-white text-white px-7 py-3 font-black uppercase tracking-widest text-[10px] hover:bg-white hover:text-slate-900 transition-all duration-300">
                    Katalog Part
                </a>
            </div>
        </div>
    </div>

    {{-- Garis Merah Pembatas Bawah --}}
    <div class="absolute bottom-0 left-0 w-full h-1 bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.4)]"></div>
</div>

{{-- STATS SECTION: FAYABI WORKSHOP DALAM ANGKA --}}
    <section class="py-20 bg-white rounded-[3rem] my-8 shadow-sm border border-slate-100 overflow-hidden relative"
        x-data="{ 
            counters: { motor: 0, mekanik: 0, sparepart: 0, pelanggan: 0 },
            hasStarted: false,
            startCounter() {
                if (this.hasStarted) return;
                this.hasStarted = true;

                const animate = (key, target, duration) => {
                    let start = 0;
                    const startTime = performance.now();
                    
                    const update = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        
                        this.counters[key] = Math.floor(progress * target);
                        
                        if (progress < 1) {
                            requestAnimationFrame(update);
                        } else {
                            this.counters[key] = target;
                        }
                    };
                    requestAnimationFrame(update);
                };

                animate('motor', 900, 2000);
                animate('mekanik', 37, 2000);
                animate('sparepart', 1000, 2000);
                animate('pelanggan', 5000, 2000);
            }
        }"
        {{-- Memicu animasi saat elemen terlihat di layar --}}
        @scroll.window.passive="if (window.pageYOffset > ($el.offsetTop - window.innerHeight)) startCounter()"
        x-init="setTimeout(() => { if (window.pageYOffset > ($el.offsetTop - window.innerHeight)) startCounter() }, 500)">
        
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
             style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <div class="text-5xl md:text-6xl font-black text-red-600 flex items-center justify-center">
                        <span x-text="counters.motor">0</span>+
                    </div>
                    <p class="text-slate-900 font-extrabold uppercase tracking-widest text-[10px]">Motor Terjual</p>
                </div>

                <div class="space-y-2">
                    <div class="text-5xl md:text-6xl font-black text-red-600 flex items-center justify-center">
                        <span x-text="counters.mekanik">0</span>+
                    </div>
                    <p class="text-slate-900 font-extrabold uppercase tracking-widest text-[10px]">Mekanik Ahli</p>
                </div>

                <div class="space-y-2">
                    <div class="text-5xl md:text-6xl font-black text-red-600 flex items-center justify-center">
                        <span x-text="counters.sparepart">0</span>+
                    </div>
                    <p class="text-slate-900 font-extrabold uppercase tracking-widest text-[10px]">Item Sparepart</p>
                </div>

                <div class="space-y-2">
                    <div class="text-5xl md:text-6xl font-black text-red-600 flex items-center justify-center">
                        <span x-text="counters.pelanggan">0</span>+
                    </div>
                    <p class="text-slate-900 font-extrabold uppercase tracking-widest text-[10px]">Pelanggan Puas</p>
                </div>
            </div>
        </div>
    </section>

    {{-- BRAND SLIDER --}}
    <section class="py-6 overflow-hidden"
        x-data="{
            moveNext() {
                let el = this.$refs.sliderContainer;
                el.scrollBy({ left: 300, behavior: 'smooth' });
                if (el.scrollLeft >= el.scrollWidth / 2) {
                    setTimeout(() => el.scrollLeft = 0, 400);
                }
            },
            movePrev() {
                let el = this.$refs.sliderContainer;
                if (el.scrollLeft <= 5) el.scrollLeft = el.scrollWidth / 2;
                el.scrollBy({ left: -300, behavior: 'smooth' });
            }
        }">

        <div class="flex items-center justify-between mb-8 px-4">
            <div>
                <h2 class="text-2xl font-black italic uppercase">Official Brands</h2>
                <div class="h-1.5 w-12 bg-red-600 mt-1"></div>
            </div>

            <div class="flex gap-3">
                <button @click="movePrev()" class="w-10 h-10 rounded-full border hover:bg-slate-900 hover:text-white">
                    ‹
                </button>
                <button @click="moveNext()" class="w-10 h-10 rounded-full border hover:bg-slate-900 hover:text-white">
                    ›
                </button>
            </div>
        </div>

        <div class="relative group-scroll">
            <div x-ref="sliderContainer" class="flex overflow-x-auto no-scrollbar">
                <div class="animate-infinite-scroll flex gap-6 px-4">

                    @php
                        $brands = [
                            ['name' => 'Honda', 'slug' => 'honda', 'img' => 'honda.svg'],
                            ['name' => 'Yamaha', 'slug' => 'yamaha', 'img' => 'yamaha.svg'],
                            ['name' => 'Suzuki', 'slug' => 'suzuki', 'img' => 'suzuki.svg'],
                            ['name' => 'Kawasaki', 'slug' => 'kawasaki', 'img' => 'kawasaki.svg'],
                            ['name' => 'Aprilia', 'slug' => 'aprilia', 'img' => 'aprilia.svg'],
                            ['name' => 'Ducati', 'slug' => 'ducati', 'img' => 'ducati.svg'],
                            ['name' => 'Harley', 'slug' => 'harley', 'img' => 'harley-davidson.svg'],
                            ['name' => 'KTM', 'slug' => 'ktm', 'img' => 'ktm.svg'],
                            ['name' => 'BMW', 'slug' => 'bmw', 'img' => 'bmw.svg'],
                        ];

                        $tripleBrands = array_merge($brands, $brands, $brands);
                    @endphp

                    @foreach($tripleBrands as $brand)
                    <div class="w-[280px] flex-shrink-0">
                        <a href="{{ url('/brand/' . $brand['slug']) }}"
                           class="block bg-white border border-slate-200 rounded-[2rem] p-6 h-44 flex flex-col items-center justify-center
                           transition-all shadow-sm hover:shadow-xl hover:-translate-y-2 group">

                            <div class="w-full h-24 flex items-center justify-center p-2">
                                <img src="{{ asset('storage/brands/' . $brand['img']) }}"
                                     class="object-contain max-h-full grayscale group-hover:grayscale-0 transition duration-500">
                            </div>

                            <span class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                                {{ $brand['name'] }}
                            </span>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

{{-- SECTION: UNIT & PART PILIHAN --}}
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex items-end justify-between mb-10">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="h-1 w-8 bg-red-600"></div>
                    <span class="text-red-600 font-black uppercase tracking-widest text-[10px]">Marketplace</span>
                </div>
                <h2 class="text-3xl font-black text-slate-900 uppercase italic">Unit & <span class="text-red-600">Part Pilihan</span></h2>
            </div>
            {{-- <a href="/all-products" class="text-slate-500 hover:text-red-600 font-bold text-xs uppercase tracking-widest transition-colors">
                Lihat Semua <i class="fa-solid fa-arrow-right ml-2"></i>
            </a> --}}
        </div>

        {{-- Grid Produk --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            {{-- Item 1: Unit Motor --}}
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl transition-all duration-300">
                <div class="relative aspect-square overflow-hidden bg-slate-100">
                    <img src="http://127.0.0.1:8000/storage/brands/vario-160.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-2 py-1 uppercase rounded">Motor</div>
                    <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-black text-slate-900 mb-1">Rp 26.000.000</h3>
                    <p class="text-slate-600 text-sm leading-tight line-clamp-2 mb-4">Honda Vario 160 CBS Type</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                        <span><i class="fa-solid fa-location-dot mr-1"></i> Jakarta Pusat</span>
                        <span>Hari Ini</span>
                    </div>
                </div>
            </div>

            {{-- Item 2: Sparepart --}}
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl transition-all duration-300">
                <div class="relative aspect-square overflow-hidden bg-slate-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAktiGFEme4cY5BsW478ciwpH3UEUUrTPg-w&s" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-blue-600 text-white text-[9px] font-black px-2 py-1 uppercase rounded">Sparepart</div>
                    <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-black text-slate-900 mb-1">Rp 185.000</h3>
                    <p class="text-slate-600 text-sm leading-tight line-clamp-2 mb-4">Piston Kit Honda Vario 125</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                        <span><i class="fa-solid fa-location-dot mr-1"></i> Jakarta Pusat</span>
                        <span>2 Jam Lalu</span>
                    </div>
                </div>
            </div>

            {{-- Item 3: Aksesoris --}}
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl transition-all duration-300">
                <div class="relative aspect-square overflow-hidden bg-slate-100">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//93/MTA-53931602/michelin_velg-rcb-racing-boy-yamaha-jupiter-z-palang-5-type-sp-522-gold-1-set_full01.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-orange-500 text-white text-[9px] font-black px-2 py-1 uppercase rounded">Aksesoris</div>
                    <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-black text-slate-900 mb-1">Rp 2.100.000</h3>
                    <p class="text-slate-600 text-sm leading-tight line-clamp-2 mb-4">Velg RCB SP522 Gold</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                        <span><i class="fa-solid fa-location-dot mr-1"></i> Jakarta Pusat</span>
                        <span>Kemarin</span>
                    </div>
                </div>
            </div>

            {{-- Item 4: Unit Motor --}}
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200 hover:shadow-xl transition-all duration-300">
                <div class="relative aspect-square overflow-hidden bg-slate-100">
                    <img src="http://127.0.0.1:8000/storage/brands/cbr-250rr.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-2 py-1 uppercase rounded">Motor</div>
                    <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-black text-slate-900 mb-1">Rp 83.760.000</h3>
                    <p class="text-slate-600 text-sm leading-tight line-clamp-2 mb-4">Honda CBR 250RR - SP QS Type</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                        <span><i class="fa-solid fa-location-dot mr-1"></i> Jakarta Pusat</span>
                        <span>1 Jam Lalu</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    {{-- NEWS SECTION: BERITA OTOMOTIF TERUPDATE --}}
    <section class="py-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-slate-900 uppercase italic">Update <span class="text-red-600">Workshop</span></h2>
            <p class="text-slate-500 mt-4 max-w-2xl mx-auto text-sm font-medium">
                Dapatkan informasi terbaru mengenai promo service, event komunitas, dan tips perawatan motor dari tim ahli Fayabi Workshop.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
            {{-- Berita 1 --}}
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://i.pinimg.com/736x/5f/25/d2/5f25d2d67ca43e707c2f0629ed439417.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Jan 15, 2026</p>
                    <h3 class="text-lg font-black text-slate-900 leading-tight mb-4 group-hover:text-red-600 transition-colors">
                        Gelar Workshop Modifikasi Honda Seri Matic
                    </h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6 line-clamp-3">
                        Fayabi Workshop baru saja menyelesaikan sesi edukasi modifikasi bagi pecinta motor Matic di Jakarta Pusat...
                    </p>
                    <a href="/news/1" class="inline-block bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-widest px-6 py-3 rounded-lg transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>

            {{-- Berita 2 --}}
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1615172282427-9a57ef2d142e?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Jan 10, 2026</p>
                    <h3 class="text-lg font-black text-slate-900 leading-tight mb-4 group-hover:text-red-600 transition-colors">
                        Layanan Detailing Keramik Pro Kini Tersedia
                    </h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6 line-clamp-3">
                        Lindungi cat motor Anda dari goresan dan kusam dengan teknologi Nano Ceramic Coating terbaru dari kami...
                    </p>
                    <a href="/news/2" class="inline-block bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-widest px-6 py-3 rounded-lg transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>

            {{-- Berita 3 --}}
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-2xl transition-all duration-500">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="p-8">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Jan 02, 2026</p>
                    <h3 class="text-lg font-black text-slate-900 leading-tight mb-4 group-hover:text-red-600 transition-colors">
                        Tips Merawat Mesin Motor di Musim Hujan
                    </h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6 line-clamp-3">
                        Jangan biarkan air hujan merusak performa mesin motor Anda. Simak tips perawatan harian dari mekanik kami...
                    </p>
                    <a href="/news/3" class="inline-block bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-widest px-6 py-3 rounded-lg transition-colors">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
