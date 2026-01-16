@extends('layouts.app')

@section('content')
{{-- Master Container --}}
<div class="bg-white min-h-screen pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        
        {{-- Layout: 2 Kolom (Konten & Sidebar) --}}
        <div class="flex flex-col lg:flex-row gap-12">
            
            {{-- KOLOM KIRI: KONTEN UTAMA --}}
            <div class="lg:w-2/3">
                {{-- Breadcrumb Sederhana --}}
                <nav class="flex text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-6">
                    <a href="/" class="hover:text-red-600">Beranda</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-900">Detail Berita</span>
                </nav>

                {{-- Judul Dinamis --}}
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">
                    {{ $news['title'] }}
                </h1>

                {{-- Penulis & Share Buttons --}}
                <div class="flex items-center justify-between border-y border-slate-100 py-6 mb-8">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Admin+Fayabi&background=dc2626&color=fff" class="w-11 h-11 rounded-full border border-slate-100">
                        <div>
                            <p class="text-sm font-black text-slate-900 uppercase italic">Admin Fayabi Workshop</p>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">{{ $news['date'] }}</p>
                        </div>
                    </div>
                    
                    {{-- Social Share --}}
                    <div class="flex gap-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white hover:bg-red-600 transition-colors">
                            <i class="fa-brands fa-facebook-f text-xs"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white hover:bg-red-600 transition-colors">
                            <i class="fa-brands fa-whatsapp text-xs"></i>
                        </a>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="relative group mb-10">
                    <img src="{{ $news['image'] }}" class="w-full h-auto rounded-none shadow-sm transition-transform duration-700" alt="News Image">
                    <div class="absolute bottom-0 left-0 bg-red-600 text-white text-[9px] font-black px-4 py-2 uppercase italic tracking-widest">
                        Official News
                    </div>
                </div>

                {{-- Isi Berita Dinamis --}}
                <article class="prose prose-slate max-w-none">
                    <div class="text-slate-700 leading-relaxed text-lg space-y-6 italic font-medium">
                        {!! nl2br(e($news['content'])) !!}
                    </div>

                    {{-- Elemen 'Baca Juga' untuk mempercantik layout --}}
                    <div class="bg-slate-50 border-l-4 border-red-600 p-6 my-10">
                        <p class="text-sm font-bold text-slate-900">BACA JUGA: 
                            <a href="#" class="text-red-600 hover:underline ml-1 italic">Update Stok Sparepart Original Bulan Ini di Fayabi Workshop</a>
                        </p>
                    </div>

                    <p class="text-slate-700 leading-relaxed text-lg">
                        Fayabi Workshop terus berkomitmen memberikan pelayanan terbaik bagi pelanggan setianya. Jangan lupa untuk melakukan pengecekan rutin pada kendaraan Anda agar performa tetap maksimal di jalan raya. Hubungi admin kami melalui WhatsApp untuk konsultasi teknis lebih lanjut.
                    </p>
                </article>

                {{-- Footer Artikel --}}
                <div class="mt-16 pt-8 border-t border-slate-100">
                    <a href="/" class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-red-600 transition-colors">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN: SIDEBAR TERPOPULER --}}
            <div class="lg:w-1/3">
                <div class="sticky top-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-8 w-1 bg-red-600"></div>
                        <h3 class="text-xl font-black text-slate-900 uppercase italic">Terpopuler</h3>
                    </div>

                    {{-- List Artikel Terpopuler (Manual untuk contoh) --}}
                    <div class="space-y-8">
                        @php
                            $trending = [
                                "Tips Merawat Rantai Motor Agar Tidak Cepat Berkarat",
                                "Update Harga Ban Michelin dan Pirelli 2026",
                                "Kenali Tanda-tanda Kampas Ganda Matic Sudah Habis",
                                "Promo Service Besar Cuma 150 Ribu di Akhir Bulan",
                                "Workshop Modifikasi Honda Vario Bergaya Thai-Look"
                            ];
                        @endphp

                        @foreach($trending as $index => $item)
                        <a href="#" class="flex gap-5 group">
                            <span class="text-4xl font-black text-slate-100 group-hover:text-red-600 transition-colors leading-none">
                                {{ $index + 1 }}
                            </span>
                            <div class="pt-1">
                                <h4 class="text-sm font-bold text-slate-800 leading-tight group-hover:text-red-600 transition-colors">
                                    {{ $item }}
                                </h4>
                                <p class="text-[9px] font-bold text-slate-400 uppercase mt-2 italic">Official Workshop News</p>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- Iklan / Call to Action --}}
                    <div class="mt-12 bg-slate-950 p-8 relative overflow-hidden group">
                        <div class="relative z-10 text-center">
                            <h5 class="text-white font-black text-lg italic uppercase leading-tight mb-4">Butuh Layanan <br><span class="text-red-600">Service Cepat?</span></h5>
                            <a href="https://wa.me/yournumber" class="inline-block bg-red-600 text-white text-[10px] font-black px-6 py-3 uppercase tracking-widest hover:bg-white hover:text-red-600 transition-all">Booking Via WhatsApp</a>
                        </div>
                        <i class="fa-solid fa-wrench absolute -bottom-4 -right-4 text-7xl text-white/5 group-hover:rotate-45 transition-transform duration-700"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection