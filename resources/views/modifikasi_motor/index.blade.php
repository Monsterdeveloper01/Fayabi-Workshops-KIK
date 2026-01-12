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
<body class="bg-slate-900 hero-bg min-h-screen">

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
    </div>

<div x-show="openMobile" 
     x-cloak
     @click.away="openMobile = false"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-10"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-10"
     class="md:hidden bg-slate-900/95 backdrop-blur-xl border-t border-slate-800 px-4 pt-2 pb-6 space-y-1 shadow-2xl">
    
    <a href="{{ url('/') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 1">
        <i class="fa-solid fa-house text-sm w-5"></i>
        <span class="font-bold">Beranda</span>
    </a>
    
    <a href="{{ route('sparepart_motor.index') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 2">
        <i class="fa-solid fa-gears text-sm w-5"></i>
        <span class="font-bold">Sparepart</span>
    </a>
    
    <a href="{{ route('aksesoris_motor.index') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 3">
        <i class="fa-solid fa-helmet-safety text-sm w-5"></i>
        <span class="font-bold">Aksesoris</span>
    </a>

    <div class="border-t border-white/5 my-4 mx-4"></div>
    <span class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 block" style="--delay: 4">Layanan Bengkel</span>

    <a href="{{ route('service_motor.index') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 5">
        <i class="fa-solid fa-screwdriver-wrench text-sm w-5"></i>
        <span class="font-bold">Service Motor</span>
    </a>
    
    <a href="{{ route('cuci_motor.index') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 6">
        <i class="fa-solid fa-soap text-sm w-5"></i>
        <span class="font-bold">Cuci Motor</span>
    </a>
    
    <a href="{{ route('modifikasi_motor.index') }}" class="mobile-nav-item flex items-center gap-3 px-4 py-4 text-slate-300 hover:text-white hover:bg-white/5 rounded-2xl transition-all" style="--delay: 7">
        <i class="fa-solid fa-wand-magic-sparkles text-sm w-5"></i>
        <span class="font-bold">Modifikasi</span>
    </a>
</div></nav>
<script>
    // 1. Logika Loading Page
    window.addEventListener('load', () => {
        // Hilangkan loader saat halaman selesai dimuat
        const loader = document.getElementById('loader');
        loader.classList.add('loader-hidden');
    });

    // 2. Trigger Loading saat klik Link
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Cek jika link internal (bukan # atau javascript:void)
            const href = this.getAttribute('href');
            if (href && href !== '#' && !href.startsWith('javascript')) {
                const loader = document.getElementById('loader');
                loader.classList.remove('loader-hidden');
            }
        });
    });

    // 3. Tambahan untuk Alpine.js (Memastikan menu tertutup saat resize)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            // Akses data Alpine secara manual jika diperlukan
            const nav = document.querySelector('nav');
            if (nav.__x) nav.__x.$data.openMobile = false;
        }
    });
</script>

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