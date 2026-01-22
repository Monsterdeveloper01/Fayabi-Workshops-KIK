@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
<div
    class="max-w-7xl mx-auto px-4 space-y-20 py-10"
    x-data="{
        open: false,
        motor: { name: '', image: '', specs: [] },

        showDetail(name, image, specs) {
            this.motor.name  = 'Honda ' + name;
            this.motor.image = image;
            this.motor.specs = specs;
            this.open = true;
        }
    }"
>

    {{-- HEADER BRAND --}}
    <section class="flex items-center gap-6">
        <img src="{{ asset('storage/brands/honda.svg') }}" class="h-16 w-auto object-contain">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">Honda Motorcycles</h1>
            <p class="text-slate-500 mt-1">Unit terbaik untuk setiap perjalanan Anda.</p>
        </div>
    </section>

    @php
    $categories = [
        'Matic' => [
            'best' => [
                'name' => 'Vario 160',
                'image' => asset('storage/brands/vario-160.png'),
                'specs' => [
                    'Mesin: 160cc eSP+',
                    'Tenaga: 15,1 PS',
                    'Transmisi: CVT',
                    'Fitur: ABS, Smart Key, USB Charger',
                ],
            ],
            'others' => [
                [
                    'name' => 'BeAT',
                    'image' => asset('storage/brands/honda-beat.png'),
                    'specs' => [
                        'Mesin: 110cc eSP',
                        'Tenaga: 9 PS',
                        'Konsumsi BBM: 60,6 km/l',
                        'Fitur: ISS, CBS',
                    ],
                ],
                [
                    'name' => 'Scoopy',
                    'image' => asset('storage/brands/honda-scoopy.png'),
                    'specs' => [
                        'Mesin: 110cc eSP',
                        'Velg: 12 inch',
                        'Fitur: Smart Key, USB Charger',
                    ],
                ],
                [
                    'name' => 'PCX 160',
                    'image' => asset('storage/brands/honda-pcx.png'),
                    'specs' => [
                        'Mesin: 160cc eSP+',
                        'Tenaga: 16 PS',
                        'Fitur: ABS, HSTC',
                    ],
                ],
                [
                    'name' => 'ADV 160',
                    'image' => asset('storage/brands/honda-adv.png'),
                    'specs' => [
                        'Mesin: 160cc eSP+',
                        'Suspensi: Sub-tank',
                        'Fitur: Adjustable Windscreen',
                    ],
                ],
            ],
        ],

        'Sport' => [
            'best' => [
                'name' => 'CBR 250RR',
                'image' => asset('storage/brands/cbr-250rr.png'),
                'specs' => [
                    'Mesin: 250cc DOHC 2 Silinder',
                    'Tenaga: ±42 PS',
                    'Transmisi: 6-speed',
                    'Fitur: Riding Mode, Assist Slipper Clutch',
                ],
            ],
            'others' => [
                [
                    'name' => 'CBR 150R',
                    'image' => asset('storage/brands/cbr-150r.png'),
                    'specs' => [
                        'Mesin: 150cc DOHC',
                        'Suspensi: Upside Down',
                        'Fitur: Assist Slipper Clutch',
                    ],
                ],
                [
                    'name' => 'CB150R',
                    'image' => asset('storage/brands/cb-150r.png'),
                    'specs' => [
                        'Mesin: 150cc DOHC',
                        'Desain: Neo Sport Cafe',
                    ],
                ],
            ],
        ],

        'Big Bike' => [
            'best' => [
                'name' => 'CB650R',
                'image' => asset('storage/brands/cb-650r.png'),
                'specs' => [
                    'Mesin: 649cc 4 Silinder',
                    'Tenaga: ±95 PS',
                    'Fitur: HSTC, Slipper Clutch',
                ],
            ],
            'others' => [
                [
                    'name' => 'CBR650R',
                    'image' => asset('storage/brands/cbr-650r.png'),
                    'specs' => [
                        'Mesin: 649cc 4 Silinder',
                        'Desain: Full Fairing',
                    ],
                ],
                [
                    'name' => 'Africa Twin',
                    'image' => asset('storage/brands/africa-twin.png'),
                    'specs' => [
                        'Mesin: 1100cc',
                        'Fitur: DCT, Riding Mode',
                    ],
                ],
                [
                    'name' => 'Rebel 1100',
                    'image' => asset('storage/brands/rebel-1100.png'),
                    'specs' => [
                        'Mesin: 1084cc',
                        'Gaya: Cruiser',
                    ],
                ],
            ],
        ],

        'Electric' => [
            'best' => [
                'name' => 'EM1 e:',
                'image' => asset('storage/brands/em1-e.png'),
                'specs' => [
                    'Motor: Electric',
                    'Jarak Tempuh: ±41 km',
                    'Baterai: Honda Mobile Power Pack',
                ],
            ],
            'others' => [
                [
                    'name' => 'Benly e:',
                    'image' => asset('storage/brands/benly-e.png'),
                    'specs' => [
                        'Motor: Electric',
                        'Fokus: Kendaraan niaga',
                    ],
                ],
                [
                    'name' => 'Gyro e:',
                    'image' => asset('storage/brands/gyro-e.png'),
                    'specs' => [
                        'Motor: Electric',
                        'Stabilitas: 3 roda',
                    ],
                ],
            ],
        ],
    ];
    @endphp

    {{-- LOOP --}}
    @foreach ($categories as $type => $category)
    <section class="space-y-8">
        <h2 class="text-2xl font-black italic uppercase border-l-8 border-red-600 pl-4">{{ $type }}</h2>

        <div class="grid md:grid-cols-2 gap-8">

            {{-- BEST --}}
            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">⭐ Best Choice</span>

                <div class="mt-4 aspect-video flex items-center justify-center bg-slate-50 rounded-2xl overflow-hidden">
                    <img src="{{ $category['best']['image'] }}" class="max-h-full object-contain p-4">
                </div>

                <h3 class="mt-4 text-xl font-black">Honda {{ $category['best']['name'] }}</h3>

                <button
                    @click="showDetail(
                        '{{ $category['best']['name'] }}',
                        '{{ $category['best']['image'] }}',
                        @js($category['best']['specs'])
                    )"
                    class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-600">
                    Lihat Detail
                </button>
            </div>

            {{-- OTHERS --}}
            <div class="bg-white border rounded-3xl p-6 shadow-sm">
                <h4 class="text-lg font-black mb-4 italic">DAFTAR {{ strtoupper($type) }} LAINNYA</h4>

                <ul class="space-y-3">
                    @foreach ($category['others'] as $other)
                    <li class="flex justify-between items-center p-3 border rounded-xl">
                        <span class="font-semibold">Honda {{ $other['name'] }}</span>
                        <button
                            @click="showDetail(
                                '{{ $other['name'] }}',
                                '{{ $other['image'] }}',
                                @js($other['specs'])
                            )"
                            class="text-sm text-red-600 font-bold hover:underline">
                            Detail
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    @endforeach

    {{-- MODAL --}}
    <div x-show="open" x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
        @click.self="open = false" style="display:none;">
        <div class="bg-white rounded-[2.5rem] max-w-2xl w-full max-h-[90vh] overflow-hidden relative">
            <button @click="open=false" class="absolute top-6 right-6 w-10 h-10 bg-slate-100 rounded-full">✕</button>

            <div class="p-8 overflow-y-auto">
                <h2 class="text-3xl font-black mb-6 italic uppercase" x-text="motor.name"></h2>
                <div class="bg-slate-50 rounded-3xl p-6 mb-8 flex justify-center">
                    <img :src="motor.image" class="max-h-64 object-contain">
                </div>

                <ul class="grid md:grid-cols-2 gap-4">
                    <template x-for="spec in motor.specs">
                        <li class="bg-slate-50 p-3 rounded-xl text-sm font-medium">
                            ✔ <span x-text="spec"></span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
