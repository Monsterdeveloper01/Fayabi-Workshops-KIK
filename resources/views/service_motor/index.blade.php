<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAYABI Workshop's</title>

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
    </style>
</head>
<body class="bg-slate-50">

    <nav class="bg-slate-900 sticky top-0 z-50 shadow-2xl border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <div class="flex-shrink-0 flex items-center gap-3 group cursor-pointer">
                    {{-- <div class="bg-gradient-to-tr from-red-600 to-red-500 p-2 rounded-xl shadow-lg shadow-red-600/30 group-hover:rotate-6 transition-transform">
                        <i class="fa-solid fa-motorcycle text-white text-xl"></i>
                    </div> --}}
                    <div class="flex flex-col leading-none">
                        <span class="text-white text-xl font-black tracking-tighter uppercase italic">
                            FAYABI<span class="text-red-500">WORKSHOP'S</span>
                        </span>
                        <span class="text-[10px] text-slate-400 font-bold tracking-[0.2em] uppercase">Premium Hub</span>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="#" class="nav-link-transition text-slate-300 hover:text-[#69BE28] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">
                        Beranda
                    </a>
                    <a href="#" class="nav-link-transition text-slate-300 hover:text-[#DC002E] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">
                        Sparepart
                    </a>
                    <a href="#" class="nav-link-transition text-slate-300 hover:text-[#003DA5] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">
                        Aksesoris
                    </a>

                    <div class="relative group">
                        <button class="nav-link-transition flex items-center gap-1.5 text-slate-300 group-hover:text-white px-4 py-2 rounded-xl text-sm font-semibold">
                            Jasa
                            <i class="fa-solid fa-chevron-down text-[10px] group-hover:rotate-180 transition-transform duration-300"></i>
                        </button>

                        <div class="absolute left-0 mt-2 w-56 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <i class="fa-solid fa-screwdriver-wrench text-slate-500 w-5"></i> Service Motor
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <i class="fa-solid fa-soap text-slate-500 w-5"></i> Cuci Motor
                            </a>
                            <div class="border-t border-white/5 my-1"></div>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <i class="fa-solid fa-wand-magic-sparkles text-slate-500 w-5"></i> Jasa Modifikasi
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button class="hidden lg:flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 px-5 py-2.5 rounded-full font-bold text-xs uppercase tracking-tight transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20">
                        <i class="fa-solid fa-plus-circle"></i> Jual Motor
                    </button>

                    <div class="relative group">
                        <button class="flex items-center gap-3 bg-white/5 hover:bg-white/10 border border-white/10 p-1.5 pr-4 rounded-full transition-all">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-slate-700 to-slate-600 flex items-center justify-center border border-white/20 shadow-inner">
                                <i class="fa-solid fa-user text-white text-xs"></i>
                            </div>
                            <div class="hidden sm:flex flex-col items-start leading-tight">
                                <span class="text-white text-[11px] font-medium opacity-60">Selamat datang,</span>
                                <span class="text-white text-sm font-bold">User Pro</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-500"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-52 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="px-4 py-2 border-b border-white/5 mb-1">
                                <p class="text-xs text-slate-400">ID Member: #MS-9921</p>
                            </div>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <i class="fa-solid fa-circle-user text-slate-500"></i> Profil Saya
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                                <i class="fa-solid fa-gear text-slate-500"></i> Pengaturan
                            </a>
                            <div class="border-t border-white/5 my-1"></div>
                            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors font-bold">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </div>
                    </div>

                    <div class="md:hidden flex items-center">
                        <button class="text-slate-300 p-2 hover:bg-white/5 rounded-lg">
                            <i class="fa-solid fa-bars-staggered text-xl"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <main class="py-12">
       @yield('content')
       <section class="max-w-4xl mx-auto my-12 px-4">
    
    <div class="mb-6">
        <a href="#" class="inline-flex items-center gap-2 text-slate-900 hover:text-red-600 transition-all group">
            <div class="w-10 h-10 rounded-full border-2 border-slate-900 flex items-center justify-center group-hover:bg-slate-900 group-hover:text-white transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </div>
            <span class="font-black uppercase tracking-widest text-sm">Kembali</span>
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl border-2 border-slate-200 overflow-hidden">
        
        <div class="bg-white p-8 md:p-10 border-b-8 border-red-600">
            <h2 class="text-4xl font-black text-slate-900 uppercase tracking-tighter">
                Formulir <span class="text-red-600">Service Motor</span>
            </h2>
            <p class="text-slate-500 text-lg mt-1 font-bold">Lengkapi data kendaraan untuk pendaftaran service.</p>
        </div>

        <form action="#" method="POST" class="p-8 md:p-12 space-y-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Nama Lengkap Pelanggan</label>
                    <input type="text" placeholder="Masukkan nama sesuai STNK" 
                        class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 px-6 py-5 rounded-2xl text-xl font-bold focus:outline-none focus:border-[#69BE28] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                </div>

                <div class="space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Nomor WhatsApp (Aktif)</label>
                    <input type="tel" placeholder="Contoh: 08123456789" 
                        class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 px-6 py-5 rounded-2xl text-xl font-bold focus:outline-none focus:border-[#DC002E] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Tipe Motor</label>
                    <div class="relative">
                        <select class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 px-6 py-5 rounded-2xl text-xl font-bold focus:outline-none focus:border-[#003DA5] focus:bg-white appearance-none cursor-pointer transition-all">
                            <option value="">Pilih Tipe</option>
                            <option value="sport">Motor Sport</option>
                            <option value="matic">Motor Matic</option>
                            <option value="bebek">Motor Bebek</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-slate-900 pointer-events-none"></i>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Model / Nama Motor</label>
                    <input type="text" placeholder="Contoh: Yamaha NMAX 2023 / Ninja 250" 
                        class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 px-6 py-5 rounded-2xl text-xl font-bold focus:outline-none focus:border-[#003DA5] focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Jenis Layanan</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="service" class="peer sr-only">
                            <div class="bg-white border-2 border-slate-300 text-slate-900 p-5 rounded-2xl text-center font-black text-sm uppercase peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 transition-all hover:border-slate-400">
                                Service Rutin
                            </div>
                        </label>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Tanggal Kedatangan</label>
                    <input type="date" 
                        class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 px-6 py-5 rounded-2xl text-xl font-bold focus:outline-none focus:border-slate-900 focus:bg-white transition-all cursor-pointer">
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-base font-black text-slate-900 uppercase tracking-widest">Catatan Keluhan Mesin</label>
                <textarea rows="3" placeholder="Ceritakan masalah motor Anda secara detail..." 
                    class="w-full bg-slate-50 border-2 border-slate-300 text-slate-900 p-6 rounded-2xl text-xl font-bold focus:outline-none focus:border-red-600 focus:bg-white transition-all placeholder:text-slate-400 placeholder:font-normal resize-none"></textarea>
            </div>

            <div class="pt-6 flex flex-col md:flex-row gap-4">
                <button type="button" onclick="history.back()"
                    class="flex-1 bg-white border-2 border-slate-900 text-slate-900 font-black py-6 rounded-2xl uppercase tracking-[0.2em] text-sm hover:bg-slate-50 transition-all">
                    Batal
                </button>
                <button type="submit" 
                    class="flex-[2] bg-slate-900 hover:bg-black text-white font-black py-6 rounded-2xl uppercase tracking-[0.2em] text-lg shadow-xl transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                    <i class="fa-solid fa-paper-plane text-xl"></i>
                    Kirim Data Booking
                </button>
            </div>

        </form>
    </div>
</section>
    </main>

</body>
</html>
