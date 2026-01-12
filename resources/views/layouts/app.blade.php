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

                [x-cloak] { display: none !important; }
        /* Animasi Loading Overlay */
    #loader {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.9); /* slate-900 */
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.5s ease-out;
    }
    
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(255, 255, 255, 0.1);
        border-top: 5px solid #ef4444; /* red-500 */
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loader-hidden {
        opacity: 0;
        pointer-events: none;
    }

        /* Efek Staggered Animation untuk Menu Mobile */
    .mobile-nav-item {
        opacity: 0;
        transform: translateX(-20px);
    }

    /* Saat menu terbuka, jalankan animasi pada tiap item */
    [x-show="openMobile"] .mobile-nav-item {
        animation: slideInRight 0.4s forwards;
        animation-delay: calc(var(--delay) * 0.1s);
    }

    @keyframes slideInRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Efek Glassmorphism tambahan */
    .bg-slate-900\/95 {
        background-color: rgba(15, 23, 42, 0.95);
    }

    </style>
</head>
<body class="bg-slate-50">

    <div id="loader" class="loader-hidden">
            <div class="flex flex-col items-center gap-4">
                <div class="spinner"></div>
                <span class="text-white text-xs font-black uppercase tracking-[0.3em] animate-pulse">Memuat...</span>
            </div>
    </div>
<nav x-data="{ openMobile: false }" class="bg-slate-900 sticky top-0 z-50 shadow-2xl border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <div class="flex-shrink-0 flex items-center gap-3 group cursor-pointer">
                <div class="flex flex-col leading-none">
                    <span class="text-white text-xl font-black tracking-tighter uppercase italic">
                        FAYABI<span class="text-red-500">WORKSHOP'S</span>
                    </span>
                    <span class="text-[10px] text-slate-400 font-bold tracking-[0.2em] uppercase">Premium Hub</span>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ url('/') }}" class="nav-link-transition text-slate-300 hover:text-[#69BE28] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Beranda</a>
                <a href="{{ route('sparepart_motor.index') }}" class="nav-link-transition text-slate-300 hover:text-[#DC002E] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Sparepart</a>
                <a href="{{ route('aksesoris_motor.index') }}" class="nav-link-transition text-slate-300 hover:text-[#003DA5] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Aksesoris</a>

                <div class="relative group">
                    <button class="nav-link-transition flex items-center gap-1.5 text-slate-300 group-hover:text-white px-4 py-2 rounded-xl text-sm font-semibold">
                        Jasa <i class="fa-solid fa-chevron-down text-[10px] group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>

                    <div class="absolute left-0 mt-2 w-56 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <a href="{{ route('service_motor.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-screwdriver-wrench text-slate-500 w-5"></i> Service Motor
                        </a>
                        <a href="{{ route('cuci_motor.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-soap text-slate-500 w-5"></i> Cuci Motor
                        </a>
                        <div class="border-t border-white/5 my-1"></div>
                        <a href="{{ route('modifikasi_motor.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-wand-magic-sparkles text-slate-500 w-5"></i> Jasa Modifikasi
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="hidden lg:flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 px-5 py-2.5 rounded-full font-bold text-xs uppercase tracking-tight transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20">
                    <i class="fa-solid fa-plus-circle"></i> Jual Motor
                </button>
                
                <div class="md:hidden">
                    <button @click="openMobile = !openMobile" class="text-slate-300 hover:text-white transition-colors">
                        <i class="fa-solid text-2xl" :class="openMobile ? 'fa-xmark' : 'fa-bars-staggered'"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-12">
       @yield('content')
    </main>

</body>
</html>
