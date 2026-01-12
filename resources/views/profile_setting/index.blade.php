@extends('layouts.app')

@section('content')
    <main class="py-8">
        <section class="max-w-2xl mx-auto px-4">
            <div class="bg-slate-900/90 backdrop-blur-xl rounded-[1.5rem] shadow-2xl border border-white/10 overflow-hidden">
                {{-- Header --}}
                <div class="bg-slate-800/50 p-6 border-b-4 border-red-600 flex items-center gap-4">
                    <div class="relative group">
                        <div class="w-16 h-16 rounded-full border-2 border-red-600 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=User+Name&bg=DC002E&color=fff" alt="Profile">
                        </div>
                        <label class="absolute bottom-0 right-0 bg-white text-slate-900 w-6 h-6 rounded-full flex items-center justify-center cursor-pointer border-2 border-slate-900 hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-solid fa-camera text-[10px]"></i>
                            <input type="file" class="hidden">
                        </label>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-white uppercase tracking-tighter">Pengaturan <span class="text-red-600">Akun</span></h2>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">ID Member: #M-77291</p>
                    </div>
                </div>

                <form action="#" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" value="User Name" 
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-white uppercase tracking-widest">Email</label>
                            <input type="email" value="user@example.com" 
                                class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-red-600 transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-white uppercase tracking-widest">Ganti Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" placeholder="••••••••" 
                            class="w-full bg-slate-800/50 border-2 border-slate-700 text-white px-4 py-3 rounded-xl text-sm font-bold focus:outline-none focus:border-white transition-all">
                    </div>

                    <div class="bg-red-600/10 border border-red-600/20 p-4 rounded-xl">
                        <p class="text-red-500 text-[10px] font-bold leading-relaxed">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Pastikan nomor WhatsApp Anda aktif untuk menerima notifikasi status booking secara otomatis.
                        </p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-black py-3 rounded-xl uppercase tracking-widest text-xs shadow-lg transition-all transform active:scale-95">
                            Simpan Perubahan
                        </button>
                        <button type="button" class="px-6 border-2 border-white text-white font-black rounded-xl uppercase tracking-widest text-[10px] hover:bg-white hover:text-slate-900 transition-all">
                            Logout
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection