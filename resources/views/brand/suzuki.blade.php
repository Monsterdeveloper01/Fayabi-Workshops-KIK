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
        <img src="{{ asset('storage/brands/suzuki.svg') }}" class="h-16" alt="Suzuki">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                Suzuki Motorcycles
            </h1>
            <p class="text-slate-500 mt-1">
                Motor Suzuki terbaik di setiap kategori
            </p>
        </div>
    </section>

    {{-- DATA KATEGORI --}}
    @php
        $categories = [
            'Sport' => [
                'best' => 'GSX-R1000R',
                'others' => ['GSX-R750', 'GSX-R600', 'GSX-R150'],
            ],
            'Naked' => [
                'best' => 'GSX-S1000',
                'others' => ['GSX-S750', 'SV650'],
            ],
            'Adventure' => [
                'best' => 'V-Strom 800DE',
                'others' => ['V-Strom 650XT', 'V-Strom 1050'],
            ],
            'Cruiser' => [
                'best' => 'Boulevard M109R',
                'others' => ['Boulevard C50', 'Boulevard C90'],
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
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">
                    ⭐ Best Choice
                </span>

                <img
                    src="https://placehold.co/600x400?text={{ urlencode($category['best']) }}"
                    class="rounded-2xl mt-4"
                >

                <h3 class="mt-4 text-xl font-black text-slate-900">
                    Suzuki {{ $category['best'] }}
                </h3>

                {{-- MODAL TRIGGER --}}
                <button
                    @click="
                        motor.name = 'Suzuki {{ $category['best'] }}';
                        motor.image = 'https://placehold.co/900x500?text=Suzuki+{{ urlencode($category['best']) }}';

                        motor.specs = (
                            '{{ $category['best'] }}' === 'GSX-R1000R' ? [
                                'Mesin: 999 cc, 4 Silinder',
                                'Tenaga Maksimum: 202 PS',
                                'Torsi Maksimum: 117.6 Nm',
                                'Transmisi: 6-percepatan + Quick Shifter',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Launch Control, Motion Track ABS'
                            ] :
                            '{{ $category['best'] }}' === 'GSX-S1000' ? [
                                'Mesin: 999 cc, 4 Silinder',
                                'Tenaga Maksimum: 152 PS',
                                'Torsi Maksimum: 106 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Traction Control, Ride Mode'
                            ] :
                            '{{ $category['best'] }}' === 'V-Strom 800DE' ? [
                                'Mesin: 776 cc, Parallel Twin',
                                'Tenaga Maksimum: 84 PS',
                                'Torsi Maksimum: 78 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Off-road ABS, Traction Control'
                            ] : [
                                'Mesin: 1783 cc, V-Twin',
                                'Tenaga Maksimum: ±125 PS',
                                'Torsi Maksimum: 160 Nm',
                                'Transmisi: 5-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Cruiser Torque Monster'
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
                                Suzuki {{ $motor }}
                            </span>
                            <button class="text-sm text-blue-600 font-bold hover:underline">
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
