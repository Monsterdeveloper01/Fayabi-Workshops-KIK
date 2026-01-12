<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-SHOP | E-Commerce Otomotif Modern</title>

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
    <main>
       @yield('content')
    </main>

</body>
</html>
