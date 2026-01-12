@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
<div
    class="max-w-7xl mx-auto px-4 space-y-20"
    x-data="{
        open: false,
        motor: {
            name: '',
            image: '',
            specs: []
        }
    }"
>

    {{-- HEADER BRAND --}}
    <section class="flex items-center gap-6">
        <img src="{{ asset('storage/brands/ducati.svg') }}" class="h-16" alt="Ducati">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                Ducati Motorcycles
            </h1>
            <p class="text-slate-500 mt-1">
                Performa tinggi & desain khas Italia
            </p>
        </div>
    </section>

    {{-- DATA KATEGORI --}}
    @php
        $categories = [
            'Sport' => [
                'best' => 'Panigale V4',
                'others' => ['Panigale V2', 'SuperSport 950', 'SuperSport 950 S'],
            ],
            'Naked' => [
                'best' => 'Streetfighter V4',
                'others' => ['Monster', 'Monster Plus', 'Monster SP'],
            ],
            'Adventure' => [
                'best' => 'Multistrada V4',
                'others' => ['Multistrada V2', 'Multistrada V2 S'],
            ],
            'Scrambler' => [
                'best' => 'Scrambler Icon',
                'others' => ['Scrambler Full Throttle', 'Scrambler Nightshift'],
            ],
        ];
    @endphp

    {{-- LOOP (SAMA PERSIS DENGAN APRILIA) --}}
    @foreach ($categories as $type => $category)
    <section class="space-y-8">

        <div>
            <h2 class="text-2xl font-black italic uppercase text-slate-800">
                {{ $type }}
            </h2>
            <div class="h-1 w-12 bg-red-600 mt-1"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            {{-- BEST CHOICE --}}
            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                    ⭐ Best Choice
                </span>

                <img
                    src="https://placehold.co/600x400?text={{ urlencode($category['best']) }}"
                    class="rounded-2xl mt-4"
                >

                <h3 class="mt-4 text-xl font-black text-slate-900">
                    {{ $category['best'] }}
                </h3>

                {{-- DETAIL POPUP --}}
                <button
                    @click="
                        motor.name = '{{ $category['best'] }}';
                        motor.image = 'https://placehold.co/900x500?text={{ urlencode($category['best']) }}';

                        motor.specs = (
                            '{{ $category['best'] }}' === 'Panigale V4' ? [
                                'Mesin: Desmosedici Stradale V4, 1.103 cc',
                                'Tenaga Maksimum: ±215 hp',
                                'Transmisi: 6-percepatan + Ducati Quick Shift',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Riding Mode, Traction Control, ABS Cornering, IMU',
                                'Bobot: ±198 kg (wet)'
                            ] :
                            '{{ $category['best'] }}' === 'Streetfighter V4' ? [
                                'Mesin: V4 Desmosedici Stradale, 1.103 cc',
                                'Tenaga Maksimum: ±208 hp',
                                'Transmisi: 6-percepatan + Quick Shift',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Winglet Aero, Wheelie Control, Riding Mode',
                                'Bobot: ±201 kg'
                            ] :
                            '{{ $category['best'] }}' === 'Multistrada V4' ? [
                                'Mesin: V4 Granturismo, 1.158 cc',
                                'Tenaga Maksimum: ±170 hp',
                                'Transmisi: 6-percepatan + Quick Shift',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Adaptive Cruise Control, Radar, Riding Mode',
                                'Bobot: ±225 kg'
                            ] : [
                                'Mesin: L-Twin Desmodromic, 803 cc',
                                'Tenaga Maksimum: ±73 hp',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Air & Oil cooled',
                                'Fitur: Cornering ABS, Traction Control, TFT Display',
                                'Bobot: ±189 kg'
                            ]
                        );

                        open = true;
                    "
                    class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold"
                >
                    Lihat Detail
                </button>
            </div>

            {{-- CARI MOTOR LAINNYA (TETAP SAMA) --}}
            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <h4 class="text-lg font-black text-slate-800 mb-4">
                    Cari motor {{ strtolower($type) }} lainnya
                </h4>

                <ul class="space-y-3">
                    @foreach ($category['others'] as $motor)
                        <li class="flex items-center justify-between p-3 rounded-xl border hover:bg-slate-50 transition">
                            <span class="font-semibold text-slate-700">
                                {{ $motor }}
                            </span>
                            <button class="text-sm text-red-600 font-bold hover:underline">
                                Lihat
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    @endforeach

    {{-- MODAL (IDENTIK DENGAN APRILIA) --}}
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
        @click.self="open = false"
    >
        <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[85vh] flex flex-col relative">
            <button
                @click="open = false"
                class="absolute top-4 right-4 text-xl font-black z-10"
            >
                ✕
            </button>

            <div class="p-8 overflow-y-auto">
                <h2 class="text-3xl font-black mb-4" x-text="motor.name"></h2>

                <img
                    :src="motor.image"
                    class="rounded-2xl mb-6 max-h-64 w-full object-cover"
                >

                <h3 class="font-black text-xl mb-2">Spesifikasi</h3>

                <ul class="list-disc pl-6 space-y-1 text-slate-600">
                    <template x-for="spec in motor.specs">
                        <li x-text="spec"></li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
