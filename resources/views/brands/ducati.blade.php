@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 space-y-20">

        {{-- HEADER BRAND --}}
        <section class="flex items-center gap-6">
            <img src="{{ asset('storage/brands/ducati.svg') }}" class="h-16" alt="Ducati">
            <div>
                <h1 class="text-4xl font-black italic uppercase text-slate-900">Ducati Motorcycles</h1>
                <p class="text-slate-500 mt-1">Pilihan motor Ducati terbaik di setiap kategori</p>
            </div>
        </section>

        {{-- DATA KATEGORI --}}
        @php
            $categories = [
                'Matic' => 'Ducati Vario 160',
                'Sport' => 'Ducati CBR 250RR',
                'EV' => 'Ducati EM1 e:',
                'Big Bike' => 'Ducati CB650R',
            ];
        @endphp

        {{-- LOOP --}}
        @foreach ($categories as $type => $motor)
            <section class="space-y-8">

                {{-- TITLE --}}
                <div>
                    <h2 class="text-2xl font-black italic uppercase text-slate-800">{{ $type }}</h2>
                    <div class="h-1 w-12 bg-red-600 mt-1"></div>
                </div>

                {{-- CARD --}}
                <div class="grid md:grid-cols-2 gap-8">

                    {{-- BEST CHOICE --}}
                    <div x-data="{ open: false }"
                        class="group bg-white border border-slate-200 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all">
                        <span class="inline-block bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">
                            ⭐ Best Choice
                        </span>

                        <img src="https://placehold.co/600x400?text={{ urlencode($motor) }}"
                            class="rounded-2xl mt-4 group-hover:scale-105 transition-transform duration-500"
                            alt="{{ $motor }}">

                        <h3 class="mt-4 text-xl font-black text-slate-900">
                            {{ $motor }}
                        </h3>

                        <p class="text-slate-500 text-sm mt-1">
                            Motor terbaik di kelas {{ strtolower($type) }} dengan performa & fitur unggulan.
                        </p>

                        <button @click="open = true"
                            class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-slate-800">
                            Lihat Detail
                        </button>

                        {{-- MODAL --}}
                        <div x-show="open" x-transition @click.self="open = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">
                            <div class="bg-white rounded-3xl p-8 max-w-lg w-full relative">
                                <button @click="open = false"
                                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700">
                                    ✕
                                </button>

                                <h3 class="text-2xl font-black text-slate-900">
                                    {{ $motor }}
                                </h3>

                                <ul class="mt-4 space-y-2 text-sm text-slate-600">
                                    <li>• Mesin: (isi manual)</li>
                                    <li>• Kapasitas: (isi manual)</li>
                                    <li>• Tenaga: (isi manual)</li>
                                    <li>• Transmisi: (isi manual)</li>
                                    <li>• Fitur unggulan: (isi manual)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- CARI MOTOR LAINNYA --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 space-y-5">

                        <div>
                            <h3 class="text-lg font-black italic uppercase text-slate-800">
                                Cari Motor Lainnya
                            </h3>
                            <p class="text-sm text-slate-500">
                                Alternatif lain di kategori {{ strtolower($type) }}
                            </p>
                        </div>

                        {{-- LIST MOTOR --}}
                        <div class="space-y-3">

                            {{-- ITEM --}}
                            <div
                                class="flex items-center gap-4 bg-white p-4 rounded-2xl border hover:shadow-md transition cursor-pointer">
                                <img src="https://placehold.co/100x70?text=Beat" class="rounded-lg" alt="">
                                <div>
                                    <p class="font-bold text-slate-800">Ducati Beat</p>
                                    <p class="text-xs text-slate-500">Irit & ringan</p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-4 bg-white p-4 rounded-2xl border hover:shadow-md transition cursor-pointer">
                                <img src="https://placehold.co/100x70?text=Scoopy" class="rounded-lg" alt="">
                                <div>
                                    <p class="font-bold text-slate-800">Ducati Scoopy</p>
                                    <p class="text-xs text-slate-500">Stylish & modern</p>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-4 bg-white p-4 rounded-2xl border hover:shadow-md transition cursor-pointer">
                                <img src="https://placehold.co/100x70?text=Genio" class="rounded-lg" alt="">
                                <div>
                                    <p class="font-bold text-slate-800">Ducati Genio</p>
                                    <p class="text-xs text-slate-500">Ringkas & elegan</p>
                                </div>
                            </div>

                            {{-- TOMBOL LIHAT SEMUA --}}
                            <button
                                class="w-full mt-2 border border-dashed border-slate-300 text-slate-600 py-3 rounded-xl text-sm font-bold hover:bg-slate-100 transition">
                                Lihat Semua Motor {{ $type }}
                            </button>

                        </div>
                    </div>

                </div>


            </section>
        @endforeach

    </div>
@endsection
