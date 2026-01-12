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
        <img src="{{ asset('storage/brands/harley-davidson.svg') }}" class="h-16" alt="Harley-Davidson">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                Harley-Davidson Motorcycles
            </h1>
            <p class="text-slate-500 mt-1">
                Ikon motor cruiser Amerika dengan karakter kuat
            </p>
        </div>
    </section>

    {{-- DATA KATEGORI --}}
    @php
        $categories = [
            'Cruiser' => [
                'best' => 'Fat Bob 114',
                'others' => ['Low Rider S', 'Low Rider ST', 'Breakout'],
            ],
            'Touring' => [
                'best' => 'Street Glide',
                'others' => ['Road Glide', 'Road King Special'],
            ],
            'Adventure' => [
                'best' => 'Pan America 1250',
                'others' => ['Pan America 1250 Special'],
            ],
            'Sport' => [
                'best' => 'Sportster S',
                'others' => ['Nightster', 'Nightster Special'],
            ],
        ];
    @endphp

    {{-- LOOP --}}
    @foreach ($categories as $type => $category)
    <section class="space-y-8">

        <div>
            <h2 class="text-2xl font-black italic uppercase text-slate-800">
                {{ $type }}
            </h2>
            <div class="h-1 w-12 bg-orange-600 mt-1"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            {{-- BEST CHOICE --}}
            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                    ⭐ Best Choice
                </span>

                <img
                    src="https://placehold.co/600x400?text={{ urlencode($category['best']) }}"
                    class="rounded-2xl mt-4"
                >

                <h3 class="mt-4 text-xl font-black text-slate-900">
                    {{ $category['best'] }}
                </h3>

                {{-- DETAIL MODAL --}}
                <button
                    @click="
                        motor.name = '{{ $category['best'] }}';
                        motor.image = 'https://placehold.co/900x500?text={{ urlencode($category['best']) }}';

                        motor.specs = (
                            '{{ $category['best'] }}' === 'Fat Bob 114' ? [
                                'Mesin: Milwaukee-Eight 114, 1.868 cc',
                                'Tenaga Maksimum: ±94 hp',
                                'Torsi Maksimum: ±155 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Air & Oil cooled',
                                'Bobot: ±306 kg'
                            ] :
                            '{{ $category['best'] }}' === 'Street Glide' ? [
                                'Mesin: Milwaukee-Eight 107, 1.746 cc',
                                'Tenaga Maksimum: ±90 hp',
                                'Torsi Maksimum: ±150 Nm',
                                'Transmisi: 6-percepatan',
                                'Fitur: Infotainment Boom! Box, Cruise Control',
                                'Bobot: ±368 kg'
                            ] :
                            '{{ $category['best'] }}' === 'Pan America 1250' ? [
                                'Mesin: Revolution Max 1250, 1.252 cc',
                                'Tenaga Maksimum: ±150 hp',
                                'Torsi Maksimum: ±127 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Riding Mode, Cornering ABS, Traction Control',
                                'Bobot: ±258 kg'
                            ] : [
                                'Mesin: Revolution Max 1250T, 1.252 cc',
                                'Tenaga Maksimum: ±121 hp',
                                'Torsi Maksimum: ±127 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: TFT Display, Riding Mode, ABS',
                                'Bobot: ±228 kg'
                            ]
                        );

                        open = true;
                    "
                    class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold"
                >
                    Lihat Detail
                </button>
            </div>

            {{-- CARI MOTOR LAINNYA --}}
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
                            <button class="text-sm text-orange-600 font-bold hover:underline">
                                Lihat
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    @endforeach

    {{-- MODAL --}}
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
