@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<div
    x-data="{
        open: false,
        motor: {
            name: '',
            image: '',
            specs: []
        }
    }"
    class="max-w-7xl mx-auto px-4 space-y-20"
>

    {{-- HEADER BRAND --}}
    <section class="flex items-center gap-6">
        <img src="{{ asset('storage/brands/bmw.svg') }}" class="h-16" alt="BMW">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                BMW Motorrad
            </h1>
            <p class="text-slate-500 mt-1">
                Pilihan motor BMW terbaik di setiap kategori
            </p>
        </div>
    </section>

    {{-- DATA --}}
    @php
        $categories = [
            'Sport' => [
                'best' => 'BMW S 1000 RR',
                'others' => ['BMW M 1000 RR'],
                'specs' => [
                    'Mesin: 999 cc, 4 Silinder',
                    'Tenaga: ±210 HP',
                    'Transmisi: 6-speed Quickshifter',
                    'Top Speed: ±303 km/jam',
                    'Fitur: Riding Mode Pro, Launch Control',
                ],
            ],
            'Naked' => [
                'best' => 'BMW S 1000 R',
                'others' => ['BMW M 1000 R', 'BMW R 1250 R'],
                'specs' => [
                    'Mesin: 999 cc',
                    'Tenaga: ±165 HP',
                    'Transmisi: 6-speed',
                    'Fitur: Dynamic Traction Control',
                ],
            ],
            'Adventure' => [
                'best' => 'BMW R 1300 GS',
                'others' => ['BMW F 850 GS', 'BMW F 750 GS'],
                'specs' => [
                    'Mesin: 1300 cc Boxer Twin',
                    'Tenaga: ±145 HP',
                    'Suspensi: Telelever EVO',
                    'Fitur: Riding Mode Pro, Hill Start Control',
                ],
            ],
            'Touring' => [
                'best' => 'BMW K 1600 GTL',
                'others' => ['BMW R 1250 RT'],
                'specs' => [
                    'Mesin: 1649 cc Inline-6',
                    'Tenaga: ±160 HP',
                    'Transmisi: 6-speed',
                    'Fitur: Cruise Control, Heated Grip',
                ],
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
                <div class="h-1 w-12 bg-blue-600 mt-1"></div>
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

                    <button
                        @click="
                            motor.name = '{{ $category['best'] }}';
                            motor.image = 'https://placehold.co/800x500?text={{ urlencode($category['best']) }}';
                            motor.specs = @js($category['specs']);
                            open = true;
                        "
                        class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold"
                    >
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
                                <span class="font-semibold">
                                    {{ $motor }}
                                </span>
                                <span class="text-sm text-slate-400">
                                    Preview
                                </span>
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

                <h3 class="font-black text-xl mb-2">
                    Spesifikasi
                </h3>

                <ul class="list-disc pl-6 space-y-1 text-slate-600">
                    <template x-for="spec in motor.specs" :key="spec">
                        <li x-text="spec"></li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
