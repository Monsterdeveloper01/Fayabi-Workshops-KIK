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
        <img src="{{ asset('storage/brands/kawasaki.svg') }}" class="h-16" alt="Kawasaki">
        <div>
            <h1 class="text-4xl font-black italic uppercase text-slate-900">
                Kawasaki Motorcycles
            </h1>
            <p class="text-slate-500 mt-1">
                Motor Kawasaki terbaik di setiap kategori
            </p>
        </div>
    </section>

    {{-- DATA KATEGORI --}}
    @php
        $categories = [
            'Sport' => [
                'best' => 'Ninja ZX-25R',
                'others' => ['Ninja 250', 'Ninja ZX-25RR', 'Ninja ZX-4RR', 'Ninja 650', 'Ninja ZX-6R', 'Ninja ZX-10R', 'Ninja H2', 'Ninja H2R'],
            ],
            'Naked' => [
                'best' => 'Z900',
                'others' => ['Z650', 'Z400', 'Z250', 'Z800', 'Z1000'],
            ],
            'Adventure' => [
                'best' => 'Versys 650',
                'others' => ['Versys 1000', 'Versys-X 250'],
            ],
            'Classic' => [
                'best' => 'W800',
                'others' => ['W175', 'W175 SE'],
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
            <div class="h-1 w-12 bg-green-600 mt-1"></div>
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
                    Kawasaki {{ $category['best'] }}
                </h3>

                {{-- MODAL TRIGGER --}}
                <button
                    @click="
                        motor.name = 'Kawasaki {{ $category['best'] }}';
                        motor.image = 'https://placehold.co/900x500?text=Kawasaki+{{ urlencode($category['best']) }}';

                        motor.specs = (
                            '{{ $category['best'] }}' === 'Ninja ZX-25R' ? [
                                'Mesin: 250 cc, 4 Silinder',
                                'Tenaga Maksimum: 51 PS',
                                'Torsi Maksimum: 22.9 Nm',
                                'Transmisi: 6-percepatan + Quick Shifter',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Traction Control, Power Mode'
                            ] :
                            '{{ $category['best'] }}' === 'Z900' ? [
                                'Mesin: 948 cc, 4 Silinder',
                                'Tenaga Maksimum: 125 PS',
                                'Torsi Maksimum: 98.6 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Riding Mode, KTRC'
                            ] :
                            '{{ $category['best'] }}' === 'Versys 650' ? [
                                'Mesin: 649 cc, Parallel Twin',
                                'Tenaga Maksimum: 67 PS',
                                'Torsi Maksimum: 61 Nm',
                                'Transmisi: 6-percepatan',
                                'Pendingin: Liquid-cooled',
                                'Fitur: Long Travel Suspension, ABS'
                            ] : [
                                'Mesin: 773 cc, Parallel Twin',
                                'Tenaga Maksimum: 48 PS',
                                'Torsi Maksimum: 62 Nm',
                                'Transmisi: 5-percepatan',
                                'Pendingin: Air-cooled',
                                'Fitur: Retro Styling, Assist & Slipper Clutch'
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
                                Kawasaki {{ $motor }}
                            </span>
                            <button class="text-sm text-green-600 font-bold hover:underline">
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
