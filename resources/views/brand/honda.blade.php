@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 space-y-20 py-10" x-data="{
        open: false,
        motor: {
            name: '',
            image: '',
            specs: []
        }
    }">

        {{-- HEADER BRAND --}}
        <section class="flex items-center gap-6">
            {{-- Mengambil logo brand .svg --}}
            <img src="{{ asset('storage/brands/honda.svg') }}"
                 class="h-16 w-auto object-contain"
                 alt="Honda Logo"
                 onerror="this.src='https://placehold.co/200x100?text=Honda'">
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
                    'slug' => 'vario-160', // Sesuai nama file di folder brands kamu
                    'others' => ['BeAT', 'Scoopy', 'PCX 160', 'ADV 160'],
                ],
                'Sport' => [
                    'best' => 'CBR 250RR',
                    'slug' => 'cbr-250rr',
                    'others' => ['CBR 150R', 'CBR 250R', 'CB150R'],
                ],
                'Big Bike' => [
                    'best' => 'CB650R',
                    'slug' => 'cb-650r',
                    'others' => ['CBR650R', 'Africa Twin', 'Rebel 1100'],
                ],
                'Electric' => [
                    'best' => 'EM1 e:',
                    'slug' => 'em1-e',
                    'others' => ['CUV e:', 'ICON e:'],
                ],
            ];
        @endphp

        {{-- LOOP KATEGORI --}}
        @foreach ($categories as $type => $category)
            <section class="space-y-8">
                <div>
                    <h2 class="text-2xl font-black italic uppercase text-slate-800">
                        {{ $type }}
                    </h2>
                    <div class="h-1 w-12 bg-red-600 mt-1"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- BEST CHOICE CARD --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm hover:shadow-md transition-shadow">
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                            ⭐ Best Choice
                        </span>

                        {{-- Mengambil gambar dari folder brands sesuai screenshot kamu --}}
                        <div class="mt-4 aspect-video flex items-center justify-center bg-slate-50 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/brands/' . $category['slug'] . '.png') }}"
                                 class="max-h-full w-auto object-contain p-4 transition-transform hover:scale-105 duration-500"
                                 alt="Honda {{ $category['best'] }}"
                                 onerror="this.src='https://placehold.co/600x400?text=Gambar+Belum+Ada'">
                        </div>

                        <h3 class="mt-4 text-xl font-black text-slate-900">
                            Honda {{ $category['best'] }}
                        </h3>

                        {{-- MODAL TRIGGER --}}
                        <button
                            @click="
                                motor.name = 'Honda {{ $category['best'] }}';
                                motor.image = '{{ asset('storage/brands/' . $category['slug'] . '.png') }}';
                                motor.specs = (
                                    '{{ $category['best'] }}' === 'Vario 160' ? [
                                        'Mesin: 160 cc, eSP+',
                                        'Tenaga Maksimum: 15,4 PS',
                                        'Torsi Maksimum: 13,8 Nm',
                                        'Fitur: Smart Key, ABS, USB Charger'
                                    ] :
                                    '{{ $category['best'] }}' === 'CBR 250RR' ? [
                                        'Mesin: 250 cc, 2 Silinder',
                                        'Tenaga Maksimum: 41 PS',
                                        'Fitur: Riding Mode, Quick Shifter'
                                    ] : [
                                        'Tipe: Performa Tinggi Honda',
                                        'Detail spesifikasi menyusul'
                                    ]
                                );
                                open = true;
                            "
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-600 transition-colors">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- DAFTAR LAINNYA --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <h4 class="text-lg font-black text-slate-800 mb-4 uppercase italic">
                            Daftar {{ $type }} Lainnya
                        </h4>
                        <ul class="space-y-3">
                            @foreach ($category['others'] as $otherMotor)
                                <li class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-red-200 hover:bg-red-50/30 transition group">
                                    <span class="font-semibold text-slate-700 group-hover:text-slate-900">
                                        Honda {{ $otherMotor }}
                                    </span>
                                    <button class="text-sm text-red-600 font-bold hover:underline">
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
        <div x-show="open"
             x-transition
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
             @click.self="open = false"
             style="display: none;">

            <div class="bg-white rounded-[2rem] max-w-2xl w-full max-h-[90vh] flex flex-col relative overflow-hidden">
                <button @click="open = false"
                        class="absolute top-6 right-6 text-slate-400 hover:text-slate-900 transition-colors z-10 bg-slate-100 w-10 h-10 rounded-full flex items-center justify-center font-bold">
                    ✕
                </button>

                <div class="p-8 overflow-y-auto">
                    <h2 class="text-3xl font-black mb-6 uppercase italic" x-text="motor.name"></h2>
                    <div class="bg-slate-50 rounded-3xl p-6 mb-8 flex items-center justify-center">
                        <img :src="motor.image" class="max-h-64 w-auto object-contain">
                    </div>
                    <h3 class="font-black text-xl mb-4 border-l-4 border-red-600 pl-3 uppercase">Spesifikasi</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <template x-for="spec in motor.specs">
                            <li class="flex items-start gap-2 text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100 text-sm font-medium">
                                <span class="text-red-600">✔</span> <span x-text="spec"></span>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
