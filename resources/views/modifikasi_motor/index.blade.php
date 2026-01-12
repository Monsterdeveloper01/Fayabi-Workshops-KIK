@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-SHOP | Jasa Modifikasi Motor</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Custom Smooth Transition */
        .nav-link-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Background Image Styling - Diganti ke Tema Modifikasi/Kustom */
        .hero-bg {
            background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), 
                              url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

    </style>
</head>
<body class="bg-slate-900 hero-bg min-h-screen">
    <main class="py-8"> <section class="max-w-2xl mx-auto my-6 px-4">
            <div class="mb-4"> <a href="#" class="inline-flex items-center gap-2 text-white hover:text-red-500 transition-all group bg-slate-900/50 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                    <div class="w-6 h-6 rounded-full border border-white flex items-center justify-center group-hover:bg-white group-hover:text-slate-900 transition-all">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    </div>
                    <span class="font-black uppercase tracking-widest text-[9px]">Kembali</span>
                </a>
            </div>

            <div class="bg-white rounded-[1.5rem] shadow-xl border-2 border-slate-200 overflow-hidden">
                <div class="bg-white p-6 border-b-4 border-red-600">
                    <h2 class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tighter">
                        Formulir <span class="text-red-600">Modifikasi Motor</span>
                    </h2>
                    <p class="text-slate-500 text-xs md:text-sm mt-1 font-bold">Konsultasikan konsep kustom dan modifikasi impian Anda.</p>
                </div>

                <form action="#" method="POST" class="p-6 md:p-8 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Nama Lengkap Pelanggan</label>
                            <input type="text" placeholder="Masukkan nama Anda" 
                                class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-[#69BE28] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Nomor WhatsApp (Aktif)</label>
                            <input type="tel" placeholder="08123456789" 
                                class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-[#DC002E] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Tipe Motor</label>
                            <div class="relative">
                                <select class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-[#003DA5] focus:bg-white appearance-none cursor-pointer transition-all">
                                    <option value="">Pilih Tipe</option>
                                    <option value="sport">Motor Sport</option>
                                    <option value="matic">Motor Matic</option>
                                    <option value="kustom">Kustom / Klasik</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-900 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Model / Nama Motor</label>
                            <input type="text" placeholder="Contoh: Honda CB150R / Kawasaki W175" 
                                class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-[#003DA5] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Kategori Modifikasi</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="service" class="peer sr-only">
                                    <div class="bg-white border-2 border-slate-200 text-slate-900 p-2.5 rounded-xl text-center font-black text-[9px] uppercase peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 transition-all hover:border-slate-300">
                                        Modifikasi Ringan
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="service" class="peer sr-only">
                                    <div class="bg-white border-2 border-slate-200 text-slate-900 p-2.5 rounded-xl text-center font-black text-[9px] uppercase peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 transition-all hover:border-slate-300">
                                        Full Custom
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Rencana Masuk Workshop</label>
                            <input type="date" 
                                class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-slate-900 focus:bg-white transition-all cursor-pointer">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-900 uppercase tracking-widest">Konsep / Deskripsi Modifikasi</label>
                        <textarea rows="3" placeholder="Jelaskan konsep modifikasi..." 
                            class="w-full bg-slate-50 border-2 border-slate-200 text-slate-900 p-4 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal resize-none"></textarea>
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row gap-3">
                        <button type="button" onclick="history.back()"
                            class="flex-1 bg-white border-2 border-slate-900 text-slate-900 font-black py-3 rounded-xl uppercase tracking-[0.1em] text-[10px] hover:bg-slate-50 transition-all order-2 md:order-1">
                            Batal
                        </button>
                        <button type="submit" 
                            class="flex-[1.5] bg-slate-900 hover:bg-black text-white font-black py-3 rounded-xl uppercase tracking-[0.1em] text-xs shadow-lg transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 order-1 md:order-2">
                            <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
                            Kirim Rencana Modif
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
@endsection