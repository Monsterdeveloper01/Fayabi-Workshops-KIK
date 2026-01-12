@extends('layouts.app')

@section('content')
    <div class="space-y-16">
        <section class="relative bg-slate-900 rounded-[40px] overflow-hidden min-h-[500px] flex items-center">
            <div class="absolute inset-0 opacity-40">
                <img src="https://images.unsplash.com/photo-1558981403-c5f91dbbe980?auto=format&fit=crop&q=80&w=2070" class="w-full h-full object-cover" alt="Motor Banner">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/60 to-transparent"></div>
            </div>

            <div class="relative z-10 px-8 md:px-16 w-full md:w-2/3">
                <span class="text-red-500 font-black tracking-widest uppercase text-sm">FAYABI WORKSHOP PRESENT</span>
                <h1 class="text-5xl md:text-7xl font-black text-white italic uppercase leading-none mt-4">
                    LEVEL UP <br> <span class="text-transparent" style="-webkit-text-stroke: 1px white;">YOUR RIDE</span>
                </h1>
                <p class="text-slate-300 mt-6 text-lg max-w-md">Solusi perawatan, modifikasi, dan sparepart motor premium dengan standar workshop profesional.</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-red-600/30">Mulai Belanja</button>
                    <button class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/20 px-8 py-4 rounded-xl font-bold transition-all">Lihat Jasa</button>
                </div>
            </div>
        </section>

        <section class="py-10 overflow-hidden"
            x-data="{
                active: 0,
                brands: [
                    { name: 'Honda', logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Honda_Logo.svg' },
                    { name: 'Yamaha', logo: 'https://upload.wikimedia.org/wikipedia/commons/8/8b/Yamaha_Motor_Logo.svg' },
                    { name: 'Suzuki', logo: 'https://upload.wikimedia.org/wikipedia/commons/1/12/Suzuki_logo_2.svg' },
                    { name: 'Kawasaki', logo: 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Kawasaki-logo.svg' },
                    { name: 'Aprilia', logo: 'https://upload.wikimedia.org/wikipedia/commons/e/e0/Aprilia-logo.svg' },
                    { name: 'Ducati', logo: 'https://upload.wikimedia.org/wikipedia/commons/d/d3/Ducati_red_logo.svg' },
                    { name: 'Harley', logo: 'https://upload.wikimedia.org/wikipedia/commons/4/44/Harley-Davidson_logo.svg' },
                    { name: 'KTM', logo: 'https://upload.wikimedia.org/wikipedia/commons/e/ed/KTM-Logo.svg' }
                ],
                init() {
                    setInterval(() => {
                        this.active = (this.active + 1) % (this.brands.length - 3);
                    }, 2000);
                }
            }">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 italic uppercase">OFFICIAL BRANDS</h2>
                    <div class="h-1 w-20 bg-red-500 mt-1"></div>
                </div>
            </div>

            <div class="relative px-4">
                <div class="flex transition-transform duration-700 ease-in-out gap-6"
                    :style="`transform: translateX(-${active * 25}%)`" >

                    <template x-for="brand in brands" :key="brand.name">
                        <div class="min-w-[calc(25%-1.5rem)] flex-shrink-0">
                            <div class="bg-white border border-slate-200 rounded-3xl p-6 h-40 flex flex-col items-center justify-center grayscale hover:grayscale-0 transition-all group shadow-sm hover:shadow-xl hover:-translate-y-2 cursor-pointer">

                                <div class="w-full h-20 flex items-center justify-center mb-3">
                                    <img :src="brand.logo" :alt="brand.name" class="max-h-full max-w-[80%] object-contain group-hover:scale-110 transition-transform duration-300">
                                </div>

                                <span class="text-slate-400 group-hover:text-slate-900 font-extrabold text-[10px] tracking-[0.2em] uppercase transition-colors" x-text="brand.name"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <div class="bg-white rounded-3xl p-10 shadow-sm border border-slate-200 text-center">
            <h2 class="text-3xl font-black text-slate-800 italic uppercase">Selamat Datang di Toko Kami!</h2>
            <p class="text-slate-500 mt-2">Coba cek navigasi di atas untuk melihat layanan kami.</p>
        </div>
    </div>
@endsection
