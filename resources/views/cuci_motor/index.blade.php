@extends('layouts.app')

@section('content')
    <main class="py-8">
        <section class="max-w-2xl mx-auto my-6 px-4">
            <div class="mb-4">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-white hover:text-red-500 transition-all group bg-slate-900/50 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                    <div class="w-6 h-6 rounded-full border border-white flex items-center justify-center group-hover:bg-white group-hover:text-slate-900 transition-all">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </div>
                    <span class="font-black uppercase tracking-widest text-[9px]">Kembali</span>
                </a>
            </div>

            <div class="bg-slate-900/90 backdrop-blur-xl rounded-[1.5rem] shadow-2xl border border-white/10 overflow-hidden">
                <div class="bg-slate-800/50 p-6 border-b-4 border-red-600">
                    <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tighter">
                        Formulir <span class="text-red-600">Cuci Steam Motor</span>
                    </h2>
                    <p class="text-slate-400 text-xs md:text-sm mt-1 font-bold italic text-white/70">Lengkapi data kendaraan untuk pendaftaran antrean cuci motor.</p>
                </div>

                <form action="#" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Nama Lengkap Pelanggan</label>
                            <input type="text" name="nama" placeholder="Nama Anda" 
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-slate-800 transition-all placeholder:text-slate-500">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Nomor WhatsApp (Aktif)</label>
                            <input type="tel" name="whatsapp" placeholder="0812..." 
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-[#DC002E] focus:bg-slate-800 transition-all placeholder:text-slate-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Tipe Motor</label>
                            <div class="relative">
                                <select name="tipe" class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-slate-800 appearance-none cursor-pointer transition-all">
                                    <option value="" class="bg-slate-900">Pilih Tipe Motor</option>
                                    <option value="sport" class="bg-slate-900">Motor Sport</option>
                                    <option value="matic" class="bg-slate-900">Motor Matic</option>
                                    <option value="bebek" class="bg-slate-900">Motor Bebek</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white pointer-events-none text-xs"></i>
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Model / Nama Motor</label>
                            <input type="text" name="model" placeholder="Contoh: Yamaha NMAX / Honda Beat" 
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-slate-800 transition-all placeholder:text-slate-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Jenis Layanan</label>
                            <div class="bg-white text-slate-900 p-2.5 rounded-xl text-center font-black text-[10px] uppercase border-2 border-white">
                                Cuci Steam Premium
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Tanggal Kedatangan</label>
                            <input type="date" name="tanggal"
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-slate-800 transition-all color-scheme-dark">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-white uppercase tracking-widest">Catatan Tambahan</label>
                        <textarea name="catatan" rows="2" placeholder="Contoh: Fokus bersihkan bagian velg..." 
                            class="w-full bg-slate-800/50 border-2 border-slate-700 text-white p-4 rounded-xl text-sm font-bold focus:outline-none focus:border-white focus:bg-slate-800 transition-all placeholder:text-slate-500 resize-none"></textarea>
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row gap-3">
                        <button type="button" onclick="history.back()"
                            class="flex-1 bg-transparent border-2 border-white text-white font-black py-3 rounded-xl uppercase tracking-[0.1em] text-[10px] hover:bg-white hover:text-slate-900 transition-all order-2 md:order-1">
                            Batal
                        </button>
                        <button type="submit" 
                            class="flex-[1.5] bg-red-600 hover:bg-red-700 text-white font-black py-3 rounded-xl uppercase tracking-[0.1em] text-xs shadow-lg transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 order-1 md:order-2 border-2 border-red-600">
                            <i class="fa-solid fa-soap text-sm"></i>
                            Booking Antrean
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <style>.color-scheme-dark { color-scheme: dark; }</style>
@endsection