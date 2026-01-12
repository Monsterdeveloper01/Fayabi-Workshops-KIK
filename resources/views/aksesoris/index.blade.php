@extends('layouts.app')

@section('content')
<style>
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-scroll {
        animation: scroll 30s linear infinite;
    }
    .animate-scroll:hover {
        animation-play-state: paused;
    }
    /* Masking gradasi agar slider terlihat pudar di pinggir */
    .slider-mask {
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }
</style>

<div class="container mx-auto px-4 min-h-screen">
    
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-slate-800 italic uppercase tracking-tighter">
            Marketplace <span class="text-red-600">Aksesoris</span>
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Temukan part racing original untuk performa maksimal.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 mb-12">
        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] text-center mb-6">
            Official Brands Partner
        </h2>

        <div class="slider-mask overflow-hidden w-full relative">
            <div class="flex animate-scroll w-max gap-8">
                
                {{-- Kita loop 2x agar animasinya nyambung terus (infinite) --}}
                @for ($i = 0; $i < 2; $i++) 
                    
                    {{-- Item 1: RCB --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-red-500 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">RCB</span>
                            <span class="block text-[10px] text-slate-400">Racing Boy</span>
                        </div>
                    </div>

                    {{-- Item 2: BRT --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-orange-500 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">BRT</span>
                            <span class="block text-[10px] text-slate-400">Bintang Racing</span>
                        </div>
                    </div>

                    {{-- Item 3: DAYTONA --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-green-600 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">DAYTONA</span>
                            <span class="block text-[10px] text-slate-400">Japan Tech</span>
                        </div>
                    </div>

                    {{-- Item 4: YSS --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-blue-600 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">YSS</span>
                            <span class="block text-[10px] text-slate-400">Suspension</span>
                        </div>
                    </div>

                    {{-- Item 5: TDR --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-yellow-500 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">TDR</span>
                            <span class="block text-[10px] text-slate-400">High Perf</span>
                        </div>
                    </div>

                    {{-- Item 6: MOTO1 --}}
                    <div class="group relative w-[160px] h-[90px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center cursor-pointer hover:border-purple-500 transition-colors">
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-2xl font-black text-slate-700 italic">MOTO 1</span>
                            <span class="block text-[10px] text-slate-400">Racing</span>
                        </div>
                    </div>

                @endfor
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        </div>

</div>
@endsection