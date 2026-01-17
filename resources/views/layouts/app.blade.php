<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-SHOP | E-Commerce Otomotif Modern</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style> [x-cloak] { display: none !important; } </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        window.addEventListener('open-delete-modal', (event) => {
            console.log("Sinyal diterima oleh Window!", event.detail);
        });
    </script>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%230F172A' stroke='%23ef4444' stroke-width='4'/%3E%3Cpath d='M50 20L54 10H46L50 20Z' fill='%23ef4444'/%3E%3Cpath d='M50 80L46 90H54L50 80Z' fill='%23ef4444'/%3E%3Crect x='42' y='35' width='16' height='20' rx='2' fill='white'/%3E%3Crect x='40' y='32' width='20' height='6' rx='1' fill='%23ef4444'/%3E%3Cpath d='M47 55h6v15h-6z' fill='white'/%3E%3Ccircle cx='50' cy='72' r='5' stroke='white' stroke-width='3'/%3E%3C/svg%3E">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .nav-link-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [x-cloak] {
            display: none !important;
        }

        #loader {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.9);
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
            border-top: 5px solid #ef4444;
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

        .mobile-nav-item {
            opacity: 0;
            transform: translateX(-20px);
        }

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
    </style>
</head>

<body class="bg-slate-50">

    <div id="loader">
        <div class="flex flex-col items-center gap-4">
            <div class="spinner"></div>
            <span class="text-white text-xs font-black uppercase tracking-[0.3em] animate-pulse">Memuat...</span>
        </div>
    </div>

@php 
    $cartCount = count(session()->get('cart', [])); 
@endphp

<nav x-data="{ openMobile: false }" class="bg-slate-900 sticky top-0 z-50 shadow-2xl border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex-shrink-0 flex items-center gap-3 group cursor-pointer">
                <div class="flex flex-col leading-none">
                    <a href="/"><span class="text-white text-xl font-black tracking-tighter uppercase italic">
                        FAYABI<span class="text-red-500">WORKSHOP'S</span>
                    </span></a>
                    <span class="text-[10px] text-slate-400 font-bold tracking-[0.2em] uppercase">Premium Hub</span>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-1">
                <a href="/" class="nav-link-transition text-slate-300 hover:text-[#69BE28] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Beranda</a>
                <a href="/sparepart" class="nav-link-transition text-slate-300 hover:text-[#DC002E] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Sparepart</a>
                <a href="/aksesoris" class="nav-link-transition text-slate-300 hover:text-[#003DA5] hover:bg-white/5 px-4 py-2 rounded-xl text-sm font-semibold">Aksesoris</a>

                <div class="relative group" x-data="{ openJasa: false }" @mouseenter="openJasa = true" @mouseleave="openJasa = false">
                    <button class="nav-link-transition flex items-center gap-1.5 text-slate-300 group-hover:text-white px-4 py-2 rounded-xl text-sm font-semibold">
                        Jasa <i class="fa-solid fa-chevron-down text-[10px] group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                    <div x-show="openJasa" x-cloak x-transition
                        class="absolute left-0 mt-2 w-56 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 z-[70]">
                        <a href="/service_motor" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-screwdriver-wrench text-slate-500 w-5"></i> Service Motor
                        </a>
                        <a href="/modifikasi_motor" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-wand-magic-sparkles text-slate-500 w-5"></i> Modifikasi
                        </a>
                        <a href="/cuci_motor" class="flex Fitems-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-soap text-slate-500 w-5"></i> Cuci Motor
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="/checkout" class="hidden md:flex relative group p-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-full transition-all">
                    <i class="fa-solid fa-cart-shopping text-white text-lg group-hover:text-red-500 transition-colors"></i>
                    @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-slate-900 animate-bounce">
                        {{ $cartCount }}
                    </span>
                    @endif
                </a>

                <a href="/jual" class="flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 p-2.5 md:px-5 md:py-2.5 rounded-full font-bold text-xs uppercase tracking-tight transition-all transform hover:scale-105 shadow-lg shadow-amber-500/20">
                    <i class="fa-solid fa-plus text-lg md:text-sm"></i> 
                    <span class="hidden sm:inline">Jual Motor</span>
                </a>
                <div class="flex items-center gap-4">

    @auth
    <div x-data="{ userOpen: false }" @click.away="userOpen = false" class="relative">
        
        <button @click="userOpen = !userOpen" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 border border-white/10 p-1.5 pr-4 rounded-full transition-all">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-slate-700 to-slate-600 flex items-center justify-center border border-white/20 shadow-inner">
                <i class="fa-solid fa-user text-white text-xs"></i>
            </div>
            
            <div class="hidden sm:flex flex-col items-start leading-tight">
                <span class="text-white text-[11px] font-medium opacity-60">Halo,</span>
                <span class="text-white text-sm font-bold">{{ Auth::user()->name }}</span>
            </div>
            
            <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 transition-transform duration-300" :class="userOpen ? 'rotate-180' : ''"></i>
        </button>

        <div 
            x-show="userOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            style="display: none;" 
            class="absolute right-0 mt-2 w-52 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 z-50"
        >
            <div class="px-4 py-2 border-b border-white/5 mb-1">
                <p class="text-xs text-slate-400">Signed in as</p>
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->email }}</p>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                <i class="fa-solid fa-gear w-5 text-center"></i> Pengaturan
            </a>
            
            <a href="{{ url('/booking_history') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i> Riwayat
            </a>

            <div class="border-t border-white/5 my-1"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition-colors font-bold text-left">
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout
                </button>
            </form>
        </div>
    </div>
    @endauth

    @guest
    <div class="flex items-center gap-3">
        <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-sm font-bold transition-colors px-2">
            Masuk
        </a>

        <a href="{{ route('register') }}" class="bg-white text-slate-900 hover:bg-slate-100 px-5 py-2 rounded-full text-sm font-bold transition-transform hover:scale-105 shadow-lg shadow-white/10">
            Daftar
        </a>
    </div>
    @endguest

</div>
                
                    <div x-show="userOpen" x-cloak x-transition
                        class="absolute right-0 mt-3 w-52 bg-slate-800 border border-white/10 rounded-2xl shadow-2xl py-2 z-[60]">
                        <a href="/profile_setting" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-circle-user text-slate-500 w-4"></i> Profil Saya
                        </a>
                        <a href="/booking_history" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">
                            <i class="fa-solid fa-clock-rotate-left text-slate-500 w-4"></i> Riwayat Booking
                        </a>
                        <div class="border-t border-white/5 my-1"></div>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 font-bold transition-colors">
                            <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="md:hidden fixed bottom-0 inset-x-0 z-[60] bg-slate-900/95 backdrop-blur-xl border-t border-white/10 pb-6 pt-3 px-6 flex items-center justify-between shadow-[0_-10px_30px_rgba(0,0,0,0.5)]">
    <a href="/service_motor" class="flex flex-col items-center gap-1">
        <i class="fa-solid fa-screwdriver-wrench text-lg {{ Request::is('service_motor*') ? 'text-red-500' : 'text-slate-400' }}"></i>
        <span class="text-[10px] font-bold {{ Request::is('service_motor*') ? 'text-red-500' : 'text-slate-500' }}">Jasa</span>
    </a>
    <a href="/sparepart" class="flex flex-col items-center gap-1">
        <i class="fa-solid fa-gears text-lg {{ Request::is('sparepart*') ? 'text-red-500' : 'text-slate-400' }}"></i>
        <span class="text-[10px] font-bold {{ Request::is('sparepart*') ? 'text-red-500' : 'text-slate-500' }}">Parts</span>
    </a>
    <a href="/" class="flex flex-col items-center -translate-y-4">
        <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center shadow-lg shadow-red-600/40 border-4 border-slate-900 transition-transform active:scale-90">
            <i class="fa-solid fa-house text-white text-xl"></i>
        </div>
        <span class="text-[10px] font-black text-red-500 mt-1 uppercase">Beranda</span>
    </a>
    <a href="/aksesoris" class="flex flex-col items-center gap-1">
        <i class="fa-solid fa-helmet-safety text-lg {{ Request::is('aksesoris*') ? 'text-red-500' : 'text-slate-400' }}"></i>
        <span class="text-[10px] font-bold {{ Request::is('aksesoris*') ? 'text-red-500' : 'text-slate-500' }}">Aksesori</span>
    </a>
    <a href="/checkout" class="flex flex-col items-center gap-1">
        <i class="fa-solid fa-cart-shopping text-lg {{ Request::is('checkout*') ? 'text-red-500' : 'text-slate-400' }}"></i>
        <span class="text-[10px] font-bold {{ Request::is('checkout*') ? 'text-red-500' : 'text-slate-500' }}">Cart</span>
    </a>
</div>

<style>
    @media (max-width: 768px) {
        body { padding-bottom: 80px; } /* Memberi ruang di bawah agar konten tidak tertutup nav bottom tanpa membuat spasi putih */
    }
</style>

    {{-- POPUP NOTIFIKASI --}}
    @if(session('success'))
    <div x-data="{ 
            show: false, 
            message: '{{ session('success') ?? '' }}',
            isComplete: false 
        }" 
        x-init="
            if(message) { 
                setTimeout(() => show = true, 500); 
                setTimeout(() => show = false, 3000); 
            }
        "
        x-on:notif-sukses.window="
            isComplete = true; 
            show = true; 
            setTimeout(() => show = false, 3000);
        "
        x-show="show"
        x-cloak
        {{-- Perubahan di sini: Menggunakan items-center agar ke tengah layar --}}
        class="fixed inset-0 z-[99999] pointer-events-none flex items-center justify-center px-4">
        
        {{-- Overlay Background Halus agar lebih fokus ke tengah --}}
        <div x-show="show" x-transition.opacity class="absolute inset-0 bg-slate-950/20 backdrop-blur-[2px]"></div>

        <div x-show="show"
            {{-- Animasi Masuk: Efek Zoom + Bounce --}}
            x-transition:enter="transition duration-500 style-bounce"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-400 ease-in"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative group">
            
            {{-- Glassmorphism Body (Gaya tetap sama) --}}
            <div class="bg-slate-900/95 backdrop-blur-2xl border border-white/10 px-10 py-6 rounded-[2.5rem] shadow-[0_40px_80px_rgba(0,0,0,0.5)] flex flex-col items-center text-center gap-4">
                
                @php $isDelete = str_contains(strtolower(session('success') ?? ''), 'hapus'); @endphp
                
                {{-- Icon (Sedikit lebih besar karena di tengah) --}}
                <div class="w-14 h-14 rounded-full flex items-center justify-center shadow-2xl transition-colors mb-2"
                    :class="isComplete || !'{{ $isDelete }}' ? 'bg-red-600 shadow-red-500/40' : 'bg-amber-500 shadow-amber-500/40'">
                    <i class="fa-solid text-white text-xl" 
                    :class="isComplete ? 'fa-check-double' : ('{{ $isDelete }}' ? 'fa-trash-can' : 'fa-check')"></i>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-white text-xl font-black uppercase italic tracking-tighter leading-tight">
                        <template x-if="isComplete">
                            <span>Transaksi <span class="text-red-500 italic">Berhasil!</span></span>
                        </template>
                        <template x-if="!isComplete">
                            <span>
                                {{ $isDelete ? 'Item' : 'Produk' }} <br>
                                <span class="{{ $isDelete ? 'text-amber-500' : 'text-red-500' }}">
                                    {{ $isDelete ? 'Dihapus' : 'Berhasil Ditambah' }}
                                </span>
                            </span>
                        </template>
                    </h2>
                    <div class="w-10 h-[2px] bg-slate-700 mx-auto my-3"></div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.4em]">Fayabi Workshop System</span>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Animasi spring/kenyal untuk menghilangkan kesan kaku */
        .style-bounce {
            transition-timing-function: cubic-bezier(0.68, -0.6, 0.32, 1.6);
        }
    </style>
    @endif

    <main class="min-h-screen flex flex-col">
        <div class="flex-grow">
            @yield('content')
        </div>
    </main>

    <footer class="bg-[#0a0f18] text-white pt-20 pb-10 relative overflow-hidden mt-0 border-t-4 border-red-600">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-red-600/5 blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">

                <div class="lg:col-span-2">
                    <div class="flex flex-col mb-6">
                        <span class="text-2xl font-black tracking-tighter uppercase italic">
                            FAYABI<span class="text-red-600">WORKSHOP'S</span>
                        </span>
                        <span class="text-[10px] text-slate-500 font-bold tracking-[0.3em] uppercase">Premium Hub</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8 italic">
                        "Penyedia layanan otomotif premium dengan standar workshop internasional. Solusi terbaik untuk perawatan, modifikasi, dan unit motor impian Anda."
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all group">
                            <i class="fa-brands fa-facebook-f text-sm group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all group">
                            <i class="fa-brands fa-instagram text-sm group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all group">
                            <i class="fa-brands fa-tiktok text-sm group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all group">
                            <i class="fa-brands fa-youtube text-sm group-hover:scale-110"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-white font-black uppercase italic tracking-widest text-sm mb-6 border-l-4 border-red-600 pl-3">Navigasi</h3>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a href="/" class="hover:text-red-500 transition-colors">Beranda</a></li>
                        <li><a href="/sparepart" class="hover:text-red-500 transition-colors">Sparepart</a></li>
                        <li><a href="/aksesoris" class="hover:text-red-500 transition-colors">Aksesoris</a></li>
                        <li><a href="/jasa" class="hover:text-red-500 transition-colors">Layanan Jasa</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-black uppercase italic tracking-widest text-sm mb-6 border-l-4 border-red-600 pl-3">Layanan</h3>
                    <ul class="space-y-4 text-slate-400 text-sm font-medium">
                        <li><a href="#" class="hover:text-red-500 transition-colors">Service Rutin</a></li>
                        <li><a href="#" class="hover:text-red-500 transition-colors">Modifikasi Heavy</a></li>
                        <li><a href="#" class="hover:text-red-500 transition-colors">Detailing & Wash</a></li>
                        <li><a href="#" class="hover:text-red-500 transition-colors">Konsultasi Gratis</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-black uppercase italic tracking-widest text-sm mb-6 border-l-4 border-red-600 pl-3">Update</h3>
                    <div class="space-y-4">
                        <div class="flex gap-3 group cursor-pointer">
                            <div class="w-16 h-12 bg-slate-800 rounded overflow-hidden flex-shrink-0">
                                <img src="https://i.pinimg.com/736x/28/44/45/2844454618a9a4463c18c99438c51715.jpg" class="w-full h-full object-cover group-hover:scale-110 transition">
                            </div>
                            <div>
                                <p class="text-[10px] text-red-500 font-bold uppercase italic">Jan 15, 2026</p>
                                <p class="text-[11px] text-slate-300 font-bold leading-tight group-hover:text-white transition">Gelar Workshop Modifikasi Honda</p>
                            </div>
                        </div>
                        <div class="flex gap-3 group cursor-pointer">
                            <div class="w-16 h-12 bg-slate-800 rounded overflow-hidden flex-shrink-0">
                                <img src="https://i.pinimg.com/1200x/d8/d1/ab/d8d1abf7bc86bf6166d7abeb275206e6.jpg" class="w-full h-full object-cover group-hover:scale-110 transition">
                            </div>
                            <div>
                                <p class="text-[10px] text-red-500 font-bold uppercase italic">Jan 10, 2026</p>
                                <p class="text-[11px] text-slate-300 font-bold leading-tight group-hover:text-white transition">Layanan Detailing Keramik Pro</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="border-t border-white/5 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                        &copy; 2023 - 2026 PT FAYABI WORKSHOP INDONESIA. ALL RIGHTS RESERVED.
                    </p>
                    <div class="flex gap-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                        <a href="#" class="hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>

        const loader = document.getElementById('loader');
        const hideLoader = () => { if (loader) loader.classList.add('loader-hidden'); };
        const showLoader = () => { if (loader) loader.classList.remove('loader-hidden'); };

        window.addEventListener('load', hideLoader);
        setTimeout(hideLoader, 5000);

        window.addEventListener('pageshow', (event) => { if (event.persisted) hideLoader(); });

        // Ganti bagian ini di script paling bawah
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const target = this.getAttribute('target');
                
                // Tambahkan pengecekan agar tidak mencegat tombol yang tidak punya href
                if (href && href !== '#' && !href.startsWith('javascript') && !href.startsWith('#') && target !== '_blank') {
                    showLoader();
                }
            });
        });
    </script>
</body>
</html>