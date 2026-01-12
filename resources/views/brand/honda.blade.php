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
        <img src="{{ asset('storage/brands/honda.svg') }}" class="h-16" alt="Honda">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                Honda Motorcycles
            </h1>
            <p class="text-slate-500 mt-1">
                Motor Honda terbaik & terlaris di setiap kategori
            </p>
        </div>
    </section>

    {{-- DATA KATEGORI --}}
    @php
        $categories = [
            'Matic' => [
                'best' => 'Vario 160',
                'others' => ['BeAT', 'Scoopy', 'PCX 160', 'ADV 160'],
            ],
            'Sport' => [
                'best' => 'CBR 250RR',
                'others' => ['CBR 150R', 'CBR 250R', 'CB150R'],
            ],
            'Big Bike' => [
                'best' => 'CB650R',
                'others' => ['CBR650R', 'Africa Twin', 'Rebel 1100', 'CBR1000RR-R Fireblade'],
            ],
            'Electric' => [
                'best' => 'EM1 e:',
                'others' => ['CUV e:', 'ICON e:'],
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

                <img
                    src="https://placehold.co/600x400?text={{ urlencode($category['best']) }}"
                    class="rounded-2xl mt-4"
                >

                <h3 class="mt-4 text-xl font-black text-slate-900">
                    Honda {{ $category['best'] }}
                </h3>

                {{-- MODAL TRIGGER --}}
                <button
                    @click="
                        motor.name = 'Honda {{ $category['best'] }}';
                        motor.image = 'https://placehold.co/900x500?text=Honda+{{ urlencode($category['best']) }}';

                        motor.specs = (
                            '{{ $category['best'] }}' === 'Vario 160' ? [
                                'Mesin: 160 cc, eSP+',
                                'Tenaga Maksimum: 15,4 PS',
                                'Torsi Maksimum: 13,8 Nm',
                                'Transmisi: CVT',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Smart Key, ABS, USB Charger'
                            ] :
                            '{{ $category['best'] }}' === 'CBR 250RR' ? [
                                'Mesin: 250 cc, 2 Silinder',
                                'Tenaga Maksimum: 41 PS',
                                'Torsi Maksimum: 25 Nm',
                                'Transmisi: 6-percepatan + Quick Shifter',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Riding Mode, Assist & Slipper Clutch'
                            ] :
                            '{{ $category['best'] }}' === 'CB650R' ? [
                                'Mesin: 649 cc, 4 Silinder',
                                'Tenaga Maksimum: 95 PS',
                                'Torsi Maksimum: 63 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Honda Selectable Torque Control'
                            ] : [
                                'Tipe Motor: Electric Vehicle',
                                'Motor Listrik: In-wheel motor',
                                'Baterai: Lithium-ion',
                                'Jarak Tempuh: ±40 km',
                                'Kecepatan Maksimum: ±45 km/jam',
                                'Fitur: Smart Key, Regenerative Brake'
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
                                Honda {{ $motor }}
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
