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

<div class="space-y-16">

    <div class="bg-white rounded-[2rem] p-12 shadow-sm border border-slate-200 text-center relative overflow-hidden group">
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-64 h-64 bg-slate-50 rounded-full group-hover:bg-red-50 transition-colors duration-500"></div>
        <div class="relative z-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 italic uppercase leading-tight">Selamat Datang di <br><span class="text-red-600">FAYABI WORKSHOP'S</span></h2>
            <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Kami menyediakan berbagai kebutuhan otomotif mulai dari unit motor terbaru hingga layanan servis profesional.</p>
        </div>
    </div>

    {{-- BRAND SLIDER --}}
    <section class="py-10 overflow-hidden"
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

</div>
@endsection
