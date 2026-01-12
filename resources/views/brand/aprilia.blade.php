@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
    <div x-data="{
        open: false,
        motor: {
            name: '',
            image: '',
            specs: []
        }
    }" class="max-w-7xl mx-auto px-4 space-y-20">

        {{-- HEADER BRAND --}}
        <section class="flex items-center gap-6">
            <img src="{{ asset('storage/brands/aprilia.svg') }}" class="h-16" alt="Aprilia">
            <div>
                <h1 class="text-4xl font-black italic uppercase text-slate-900">
                    Aprilia Motorcycles
                </h1>
                <p class="text-slate-500 mt-1">
                    Pilihan motor Aprilia terbaik di setiap kategori
                </p>
            </div>
        </section>

        {{-- DATA --}}
        @php
            $categories = [
                'Sport' => [
                    'best' => 'RSV4 Factory',
                    'others' => ['RS 660', 'RS 660 Extrema', 'RSV4'],
                    'specs' => [
                        'Mesin: 1100cc V4',
                        'Tenaga: ±217 HP',
                        'Transmisi: 6-speed',
                        'Fitur: APRC, Launch Control',
                    ],
                ],
                'Naked' => [
                    'best' => 'Tuono V4 Factory',
                    'others' => ['Tuono V4', 'Tuono 660', 'Tuono 660 Factory'],
                    'specs' => [
                        'Mesin: 1100cc V4',
                        'Tenaga: ±175 HP',
                        'Transmisi: 6-speed',
                        'Fitur: Riding Mode, Quickshifter',
                    ],
                ],
                'Adventure' => [
                    'best' => 'Tuareg 660',
                    'others' => ['Tuareg 660 Rally'],
                    'specs' => ['Mesin: 660cc Parallel Twin', 'Suspensi: Kayaba', 'Fitur: Off-road Mode'],
                ],
                'Urban' => [
                    'best' => 'SR GT 200',
                    'others' => ['SR GT 125', 'SR 160'],
                    'specs' => ['Mesin: 174cc', 'Transmisi: CVT', 'Fitur: ABS, USB Charger'],
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
                    <div class="h-1 w-12 bg-red-600 mt-1"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">

                    {{-- BEST CHOICE --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                            ⭐ Best Choice
                        </span>

                        <img src="https://placehold.co/600x400?text={{ urlencode($category['best']) }}"
                            class="rounded-2xl mt-4">

                        <h3 class="mt-4 text-xl font-black text-slate-900">
                            {{ $category['best'] }}
                        </h3>

                        <button
                            @click="
                            motor.name = '{{ $category['best'] }}';
                            motor.image = 'https://placehold.co/800x500?text={{ urlencode($category['best']) }}';
                            motor.specs = @js($category['specs']);
                            open = true;
                        "
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- MOTOR LAIN --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <h4 class="text-lg font-black mb-4">
                            Cari motor {{ strtolower($type) }} lainnya
                        </h4>

                        <ul class="space-y-3">
                            @foreach ($category['others'] as $motor)
                                <li class="flex justify-between items-center p-3 border rounded-xl">
                                    <span class="font-semibold">{{ $motor }}</span>
                                    <button class="text-sm text-red-600 font-bold">
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
        <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
            @click.self="open = false">

            <div class="bg-white rounded-3xl max-w-3xl w-full max-h-[85vh] flex flex-col relative">
                <button @click="open = false" class="absolute top-4 right-4 text-xl font-black z-10">
                    ✕
                </button>

                <div class="p-8 overflow-y-auto">
                    <h2 class="text-3xl font-black mb-4" x-text="motor.name"></h2>

                    <img :src="motor.image" class="rounded-2xl mb-6 max-h-64 w-full object-cover">

                    <h3 class="font-black text-xl mb-2">Spesifikasi</h3>

                    <ul class="list-disc pl-6 space-y-1 text-slate-600">
                        <template x-for="spec in motor.specs">
                            <li x-text="spec"></li>
                        </template>
                    </ul>
                </div>
            </div>

        </div>
    @endsection
