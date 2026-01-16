@extends('layouts.app')
@section('content')
    <main class="min-h-screen w-full relative flex flex-col justify-center items-center py-12" 
      style="background: linear-gradient(rgba(15, 23, 42, 0.534), rgba(15, 23, 42, 0.9)), 
             url('https://i.pinimg.com/1200x/88/93/8c/88938c5f0db56ce9fd137d88941f3d47.jpg'); 
             background-size: cover; 
             background-position: center; 
             background-attachment: fixed;
             margin-bottom: -2rem; 
             ">

        <section class="max-w-2xl w-full mx-auto px-4 relative z-10">
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-white hover:text-blue-500 transition-all group bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20">
                    <div class="w-6 h-6 rounded-full border border-white flex items-center justify-center group-hover:bg-blue-500 group-hover:border-blue-500 transition-all">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </div>
                    <span class="font-black uppercase tracking-widest text-[10px]">Kembali</span>
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.8)] border border-white/20 overflow-hidden">
                <div class="bg-slate-900/40 p-6 border-b-4 border-blue-500 backdrop-blur-md">
                    <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tighter">
                        Premium <span class="text-blue-500">Wash</span> & Detail
                    </h2>
                    <p class="text-white/70 text-xs md:text-sm mt-1 font-bold italic">Kembalikan kilau motor Anda dengan pencucian standar professional.</p>
                </div>

                <form action="#" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Nama Anda" 
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all placeholder:text-white/30">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Nomor WhatsApp</label>
                            <input type="tel" name="whatsapp" placeholder="0812..." 
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all placeholder:text-white/30">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Ukuran Motor</label>
                            <div class="relative">
                                <select name="ukuran" class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-slate-900 appearance-none cursor-pointer transition-all">
                                    <option value="" class="bg-slate-900">Pilih Ukuran</option>
                                    <option value="small" class="bg-slate-900">Small (Beat, Vario, Mio)</option>
                                    <option value="medium" class="bg-slate-900">Medium (NMAX, PCX, CBR)</option>
                                    <option value="large" class="bg-slate-900">Large/Moge (Ninja 250, Harley, dll)</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white pointer-events-none text-xs"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Paket Cuci</label>
                            <div class="relative">
                                <select name="paket" class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-slate-900 appearance-none cursor-pointer transition-all">
                                    <option value="reguler" class="bg-slate-900">Cuci Reguler</option>
                                    <option value="steam" class="bg-slate-900">Cuci Steam + Snow Wash</option>
                                    <option value="detailing" class="bg-slate-900">Premium Detailing</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white pointer-events-none text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Jam Kedatangan</label>
                            <input type="time" name="jam"
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all color-scheme-dark">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Tanggal</label>
                            <input type="date" name="tanggal"
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all color-scheme-dark">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-white uppercase tracking-widest">Permintaan Khusus</label>
                        <textarea name="catatan" rows="2" placeholder="Contoh: Titip helm, bersihkan area mesin lebih detail, dll..." 
                            class="w-full bg-white/5 border-2 border-white/10 text-white p-4 rounded-xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all placeholder:text-white/30 resize-none"></textarea>
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row gap-4">
                        <button type="button" onclick="history.back()"
                            class="flex-1 bg-white/10 backdrop-blur-md border-2 border-white text-white font-black py-4 rounded-2xl uppercase tracking-[0.1em] text-[10px] hover:bg-white hover:text-slate-900 transition-all order-2 md:order-1 shadow-lg">
                            Batal
                        </button>
                        <button type="submit" 
                            class="flex-[2] bg-blue-500 hover:bg-blue-600 text-white font-black py-4 rounded-2xl uppercase tracking-[0.1em] text-xs shadow-[0_0_20px_rgba(59,130,246,0.4)] transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 order-1 md:order-2 border-2 border-blue-500">
                            <i class="fa-solid fa-soap text-sm"></i>
                            Kirim Booking Cuci
                        </button>
                    </div>
                </form>
            </div>
            <br><br>
        </section>
    </main>

    <style>
        .color-scheme-dark { color-scheme: dark; }
        main { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
@endsection