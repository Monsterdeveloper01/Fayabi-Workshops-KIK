@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 space-y-20 py-10"
        x-data="{
            open: false,
            motor: { name: '', image: '', specs: [] },

            // FUNGSI UNTUK MEMBUKA MODAL SECARA DINAMIS
            showDetail(name, slug, specs = null) {
                this.motor.name = 'Honda ' + name;
                this.motor.image = '{{ asset('storage/brands/') }}/' + slug + '.png';

                // Jika spesifikasi tidak dikirim manual, gunakan default atau logika pencarian
                if(specs) {
                    this.motor.specs = specs;
                } else {
                    // Logika spesifikasi otomatis berdasarkan nama
                    if(name.includes('BeAT')) this.motor.specs = ['Mesin: 110cc eSP', 'Tenaga: 9 PS', 'Konsumsi BBM: 60.6 km/liter', 'Fitur: ISS, CBS'];
                    else if(name.includes('Scoopy')) this.motor.specs = ['Mesin: 110cc eSP', 'Velg: 12 inch', 'Fitur: Smart Key, USB Charger'];
                    else if(name.includes('PCX 160')) this.motor.specs = ['Mesin: 160cc eSP+', 'Tenaga: 16 PS', 'Fitur: HSTC, ABS, Full Digital Panel'];
                    else if(name.includes('ADV 160')) this.motor.specs = ['Mesin: 160cc eSP+', 'Suspensi: Sub-tank Rear Spec', 'Fitur: Adjustable Windscreen'];
                    else if(name.includes('CBR 150R')) this.motor.specs = ['Mesin: 150cc DOHC', 'Fitur: Inverted Front Suspension', 'Assist/Slipper Clutch'];
                    else this.motor.specs = ['Detail spesifikasi untuk ' + name + ' akan segera diperbarui.'];
                }

                this.open = true;
            }
        }">

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
                    'best' => 'Vario 160',
                    'slug' => 'vario-160',
                    'others' => [
                        ['name' => 'BeAT', 'slug' => 'beat'],
                        ['name' => 'Scoopy', 'slug' => 'scoopy'],
                        ['name' => 'PCX 160', 'slug' => 'pcx-160'],
                        ['name' => 'ADV 160', 'slug' => 'adv-160'],
                    ],
                ],
                'Sport' => [
                    'best' => 'CBR 250RR',
                    'slug' => 'cbr-250rr',
                    'others' => [
                        ['name' => 'CBR 150R', 'slug' => 'cbr-150r'],
                        ['name' => 'CB150R', 'slug' => 'cb150r'],
                    ],
                ],
                 'Big Bike' => [
                    'best' => 'CB650R',
                    'slug' => 'cb-650r',
                    'others' => [
                        ['name' => 'CBR650R', 'slug' => 'cbr650r'],
                        ['name' => 'Africa Twin', 'slug' => 'africa-twin'],
                        ['name' => 'Rebel 1100', 'slug' => 'rebel-1100'],
                    ],
                ],
                'Electric' => [
                    'best' => 'EM1 e:',
                    'slug' => 'em1-e',
                    'others' => [
                        ['name' => 'Honda Benly e:', 'slug' => 'benly-e'],
                        ['name' => 'Honda Gyro e:', 'slug' => 'gyro-e'],
                    ],
                ],
            ];
        @endphp

        @foreach ($categories as $type => $category)
            <section class="space-y-8">
                <h2 class="text-2xl font-black italic uppercase border-l-8 border-red-600 pl-4">{{ $type }}</h2>

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- BEST CHOICE --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">⭐ Best Choice</span>
                        <div class="mt-4 aspect-video flex items-center justify-center bg-slate-50 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/brands/' . $category['slug'] . '.png') }}" class="max-h-full object-contain p-4 transition hover:scale-105 duration-500">
                        </div>
                        <h3 class="mt-4 text-xl font-black text-slate-900">Honda {{ $category['best'] }}</h3>

                        {{-- Tombol Detail Menggunakan Fungsi showDetail --}}
                        <button @click="showDetail('{{ $category['best'] }}', '{{ $category['slug'] }}')"
                                class="mt-4 bg-slate-900 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-600 transition">
                            Lihat Detail
                        </button>
                    </div>

                    {{-- MOTOR LAINNYA --}}
                    <div class="bg-white border rounded-3xl p-6 shadow-sm">
                        <h4 class="text-lg font-black text-slate-800 mb-4 italic">DAFTAR {{ strtoupper($type) }} LAINNYA</h4>
                        <ul class="space-y-3">
                            @foreach ($category['others'] as $other)
                                <li class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:bg-slate-50 transition group">
                                    <span class="font-semibold text-slate-700">Honda {{ $other['name'] }}</span>

                                    {{-- Tombol Detail untuk Motor Lainnya --}}
                                    <button @click="showDetail('{{ $other['name'] }}', '{{ $other['slug'] }}')"
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

        {{-- MODAL (Tetap Sama) --}}
        <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" @click.self="open = false" style="display: none;">
            <div class="bg-white rounded-[2.5rem] max-w-2xl w-full max-h-[90vh] flex flex-col relative shadow-2xl overflow-hidden">
                <button @click="open = false" class="absolute top-6 right-6 bg-slate-100 w-10 h-10 rounded-full flex items-center justify-center font-bold">✕</button>
                <div class="p-8 overflow-y-auto">
                    <h2 class="text-3xl font-black mb-6 italic uppercase" x-text="motor.name"></h2>
                    <div class="bg-slate-50 rounded-3xl p-6 mb-8 flex items-center justify-center">
                        <img :src="motor.image" class="max-h-64 object-contain" onerror="this.src='https://placehold.co/600x400?text=Gambar+Menyusul'">
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
