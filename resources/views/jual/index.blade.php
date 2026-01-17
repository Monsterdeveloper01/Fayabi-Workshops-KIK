@extends('layouts.app')
@section('content')
{{-- Alpine.js untuk Image Preview & UI Logic --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<main class="min-h-screen bg-slate-950 py-12 relative overflow-hidden">
    
    {{-- Elemen Dekoratif Background --}}
    <div class="absolute top-0 -left-20 w-96 h-96 bg-amber-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 -right-20 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    
    {{-- Background Grid Pattern --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
         style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        {{-- Header Section --}}
        <div class="max-w-4xl mx-auto text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-amber-500/10 border border-amber-500/20 px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-amber-500 text-[10px] font-black uppercase tracking-[0.2em]">Fayabi Marketplace</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white italic uppercase tracking-tighter mb-4">
                Jual Motormu <span class="text-amber-500">Sekarang.</span>
            </h1>
            <p class="text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed font-medium">
                Dapatkan penawaran harga terbaik. Kami membantu Anda memasarkan unit ke jaringan kolektor dan pembeli potensial kami.
            </p>
        </div>

        <div class="max-w-5xl mx-auto">
            {{-- DAFTAR UNIT DIJUAL SAYA (Hanya muncul jika user sudah punya data) --}}
            {{-- Pastikan nama variabelnya $mySales (sama dengan yang di compact) --}}
@if(isset($mySales) && $mySales->count() > 0)
    <div class="mt-20 border-t border-white/10 pt-16 py-20">
        <h3 class="text-2xl font-black text-white uppercase italic mb-8">
            Unit <span class="text-amber-500">Dijual Saya</span>
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($mySales as $sale)
                {{-- Isi card motor kamu di sini --}}
                <div class="bg-slate-900/40 border border-white/10 rounded-[2rem] p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="{{ Storage::url($sale->image) }}" class="w-16 h-16 rounded-2xl object-cover">
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase">{{ $sale->model }}</h4>
                            <p class="text-amber-500 text-[10px] font-black uppercase italic">Status: {{ $sale->status }}</p>
                        </div>
                    </div>
                    <a href="{{ route('jual.show', $sale->id) }}" class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-white hover:bg-amber-600 transition-all">
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
            {{-- Notifikasi Sukses --}}
            @if (session('status'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="mb-8 bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-[0_0_30px_rgba(34,197,94,0.1)]">
                <i class="fa-solid fa-circle-check"></i>
                <span class="font-bold text-sm uppercase tracking-wide">{{ session('status') }}</span>
            </div>
            @endif

            

            <form action="{{ route('jual.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
                @csrf

                {{-- KOLOM KIRI: FORM INPUT (2/3) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-slate-900/40 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 md:p-10">
                        
                        <div class="space-y-10">
                            {{-- Step 1: Identitas --}}
                            <div class="space-y-6">
                                <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-amber-500 pl-3 text-sm">
                                    1. Spesifikasi Kendaraan
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Merek Motor</label>
                                        <select name="brand" required class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all appearance-none cursor-pointer">
                                            <option value="" class="bg-slate-900">Pilih Merek</option>
                                            <option value="Honda" class="bg-slate-900">Honda</option>
                                            <option value="Yamaha" class="bg-slate-900">Yamaha</option>
                                            <option value="Suzuki" class="bg-slate-900">Suzuki</option>
                                            <option value="Kawasaki" class="bg-slate-900">Kawasaki</option>
                                            <option value="Lainnya" class="bg-slate-900">Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tipe / Model</label>
                                        <input type="text" name="model" value="{{ old('model') }}" placeholder="Contoh: Ninja ZX-25R" required
                                            class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-slate-800">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Tahun</label>
                                        <input type="number" name="year" value="{{ old('year') }}" placeholder="2022" required
                                            class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Odometer (KM)</label>
                                        <div class="relative">
                                            <input type="number" name="mileage" value="{{ old('mileage') }}" placeholder="12000" required
                                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                                            <span class="absolute right-5 top-4 text-[10px] font-black text-slate-500 uppercase">KM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 2: Kondisi & Foto --}}
                            <div class="space-y-6">
                                <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-amber-500 pl-3 text-sm">
                                    2. Detail Kondisi & Visual
                                </h3>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Deskripsi Kondisi</label>
                                    <textarea name="description" rows="4" placeholder="Jelaskan kondisi mesin, surat-surat, Pajak, dan Modifikasi..." required
                                        class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all placeholder:text-slate-800">{{ old('description') }}</textarea>
                                </div>

                                <div x-data="{ photoPreview: null }" class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Foto Utama Kendaraan</label>
                                    <div class="relative group">
                                        <div class="w-full h-56 rounded-3xl border-2 border-dashed border-white/10 bg-white/5 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-amber-500/50">
                                            <input type="file" name="image" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                                                @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                            <template x-if="!photoPreview">
                                                <div class="text-center">
                                                    <i class="fa-solid fa-camera text-3xl text-slate-700 mb-2"></i>
                                                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Klik Untuk Upload</p>
                                                </div>
                                            </template>
                                            <template x-if="photoPreview">
                                                <img :src="photoPreview" class="w-full h-full object-cover">
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 3: Harga --}}
                            <div class="space-y-6">
                                <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-amber-500 pl-3 text-sm">
                                    3. Harga & Kontak
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Harga Penawaran (IDR)</label>
                                        <div class="relative">
                                            <span class="absolute left-5 top-4 text-xs font-black text-amber-500 uppercase italic">Rp</span>
                                            <input type="number" name="price_offer" value="{{ old('price_offer') }}" placeholder="25000000" required
                                                class="w-full bg-white/5 border-2 border-white/10 text-amber-500 pl-12 pr-5 py-4 rounded-2xl text-xl font-black focus:outline-none focus:border-amber-500 transition-all tracking-tighter italic">
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">WhatsApp Aktif</label>
                                        <div class="relative">
                                            <span class="absolute left-5 top-4 text-slate-600"><i class="fa-brands fa-whatsapp text-lg"></i></span>
                                            <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="0812XXXXXXXX" required
                                                class="w-full bg-white/5 border-2 border-white/10 text-white pl-12 pr-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: INFO & SUBMIT --}}
                <div class="space-y-6">
                    <div class="bg-amber-500 rounded-[2.5rem] p-8 shadow-[0_20px_50px_rgba(245,158,11,0.2)]">
                        <h3 class="text-slate-950 font-black uppercase italic text-xl mb-6 tracking-tighter">Kenapa Jual di Fayabi?</h3>
                        <ul class="space-y-5">
                            <li class="flex items-start gap-4 text-slate-950">
                                <i class="fa-solid fa-bolt mt-1 text-xs"></i>
                                <p class="text-[11px] font-bold leading-tight">Proses verifikasi cepat di hadapan pembeli potensial.</p>
                            </li>
                            <li class="flex items-start gap-4 text-slate-950">
                                <i class="fa-solid fa-hand-holding-dollar mt-1 text-xs"></i>
                                <p class="text-[11px] font-bold leading-tight">Penilaian harga jujur sesuai kondisi aktual motor.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-slate-900/40 border border-white/10 rounded-[2.5rem] p-8">
                        <p class="text-slate-500 text-[10px] leading-relaxed font-bold uppercase tracking-wider">
                            <i class="fa-solid fa-circle-info text-amber-500 mr-2"></i>
                            Verifikasi data dilakukan <span class="text-white">maksimal 24 Jam</span>. Kami akan menghubungi via WhatsApp.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-6 rounded-[2rem] uppercase tracking-[0.3em] text-xs shadow-xl transition-all transform hover:-translate-y-2 active:scale-95 flex items-center justify-center gap-3 group">
                        <span>Kirim Penawaran</span>
                        <i class="fa-solid fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    </button>
                </div>
            </form>

            

        </div>
    </div>
</main>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    select::-ms-expand { display: none; }
</style>
@endsection