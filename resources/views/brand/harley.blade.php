@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 space-y-20">

        {{-- HEADER BRAND --}}
        <section class="flex items-center gap-6">
            <img src="{{ asset('storage/brands/harley-davidson.svg') }}" class="h-16" alt="Harley">
            <div>
                <h1 class="text-4xl font-black italic uppercase text-slate-900">Harley Motorcycles</h1>
                <p class="text-slate-500 mt-1">Pilihan motor Harley terbaik di setiap kategori</p>
            </div>
        </section>

        {{-- DATA KATEGORI --}}
        @php
            $categories = [
                'Cruiser' => [
                    'best' => 'Street Bob 114',
                    'others' => ['Iron 883', 'Forty-Eight', 'Low Rider S', 'Fat Bob 114'],
                ],
                'Touring' => [
                    'best' => 'Road Glide Special',
                    'others' => ['Street Glide', 'Electra Glide', 'Road King'],
                ],
                'Sport' => [
                    'best' => 'Sportster S',
                    'others' => ['Nightster', 'Nightster Special'],
                ],
                'Adventure' => [
                    'best' => 'Pan America 1250',
                    'others' => ['Pan America 1250 Special'],
                ],
                'Trike' => [
                    'best' => 'Tri Glide Ultra',
                    'others' => ['Freewheeler'],
                ],
            ];
        @endphp


        {{-- LOOP --}}
        @foreach ($categories as $type => $category)
            <section class="space-y-8">

                {{-- TITLE --}}
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

                        <button class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- CARI MOTOR LAINNYA (KHUSUS TIPE INI) --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <h4 class="text-lg font-black text-slate-800 mb-4">
                            Cari motor {{ strtolower($type) }} lainnya
                        </h4>

                        <ul class="space-y-3">
                            @foreach ($category['others'] as $motor)
                                <li
                                    class="flex items-center justify-between p-3 rounded-xl border hover:bg-slate-50 transition">
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


    </div>
@endsection
