@extends('layouts.app')

@section('content')
    {{-- Menambahkan min-h-screen dan background khusus dengan elemen dekoratif --}}
    <main class="py-12 min-h-screen bg-slate-950 relative overflow-hidden flex items-center justify-center">
        
        {{-- Elemen Dekoratif Background (Glow Effects) --}}
        <div class="absolute top-0 -left-20 w-96 h-96 bg-red-600/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        {{-- Background Pattern (Grid) --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <section class="w-full max-w-2xl mx-auto px-4 relative z-10">
            {{-- Card Utama dengan Border Glow --}}
            <div class="bg-slate-900/40 backdrop-blur-2xl rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 overflow-hidden">
                
                {{-- Header dengan Visual yang Lebih Berani --}}
                <div class="relative p-8 border-b border-white/5 overflow-hidden">
                    {{-- Dekorasi Garis Diagonal di Header --}}
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <i class="fa-solid fa-gears text-8xl text-white -rotate-12"></i>
                    </div>

                    <div class="relative flex flex-col md:flex-row items-center gap-6">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-3xl border-4 border-red-600/50 overflow-hidden rotate-3 group-hover:rotate-0 transition-transform duration-500 shadow-2xl">
                                <img src="https://ui-avatars.com/api/?name=User+Name&bg=DC002E&color=fff" class="w-full h-full object-cover" alt="Profile">
                            </div>
                            <label class="absolute -bottom-2 -right-2 bg-red-600 text-white w-9 h-9 rounded-xl flex items-center justify-center cursor-pointer border-4 border-slate-900 hover:scale-110 transition-all shadow-xl">
                                <i class="fa-solid fa-camera text-xs"></i>
                                <input type="file" class="hidden">
                            </label>
                        </div>

                        <div class="text-center md:text-left">
                            <div class="inline-block px-3 py-1 bg-red-600/20 border border-red-600/30 rounded-full mb-2">
                                <p class="text-red-500 text-[10px] font-black uppercase tracking-[0.2em]">Verified Member</p>
                            </div>
                            <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                                Akun <span class="text-red-600">Saya</span>
                            </h2>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">ID: #M-77291 • Bergabung 2024</p>
                        </div>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="#" method="POST" class="p-8 md:p-10 space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                <i class="fa-solid fa-user text-red-600"></i> Nama Lengkap
                            </label>
                            <input type="text" value="User Name" 
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-white/10 transition-all placeholder:text-slate-600">
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                <i class="fa-solid fa-envelope text-red-600"></i> Email Terdaftar
                            </label>
                            <input type="email" value="user@example.com" 
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-white/10 transition-all">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                            <i class="fa-solid fa-lock text-red-600"></i> Keamanan Password
                        </label>
                        <div class="relative">
                            <input type="password" placeholder="Masukan password baru..." 
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-white transition-all">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 text-[9px] font-bold uppercase hidden md:block">
                                Opsional
                            </div>
                        </div>
                    </div>

                    {{-- Info Box dengan Style Glass --}}
                    <div class="bg-gradient-to-r from-red-600/20 to-transparent border-l-4 border-red-600 p-5 rounded-r-2xl">
                        <div class="flex gap-4">
                            <i class="fa-solid fa-shield-halved text-red-500 text-xl mt-1"></i>
                            <div>
                                <h4 class="text-white text-xs font-black uppercase mb-1">Verifikasi WhatsApp</h4>
                                <p class="text-slate-400 text-[10px] font-medium leading-relaxed">
                                    Status pengerjaan unit Anda akan dikirimkan secara realtime ke nomor yang terdaftar. Pastikan nomor selalu aktif.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-6 flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-[2] bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl uppercase tracking-[0.2em] text-xs shadow-[0_10px_30px_rgba(220,0,46,0.3)] transition-all transform active:scale-95 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                        <button type="button" class="flex-1 px-6 border-2 border-white/20 text-white font-black rounded-2xl uppercase tracking-[0.2em] text-[10px] hover:bg-white hover:text-slate-900 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </div>
                </form>
            </div>

            {{-- Footer Text --}}
            <p class="text-center mt-8 text-slate-600 text-[10px] font-bold uppercase tracking-[0.3em]">
                Fayabi Workshop &copy; 2026 - Secure Account System
            </p>
        </section>
    </main>
@endsection