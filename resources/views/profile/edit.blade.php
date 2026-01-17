@extends('layouts.app')

@section('content')
{{-- Alpine.js untuk notifikasi & modal delete --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<main class="py-12 min-h-screen bg-slate-950 relative overflow-hidden flex flex-col items-center justify-center">
    
    {{-- Elemen Dekoratif Background --}}
    <div class="absolute top-0 -left-20 w-96 h-96 bg-red-600/20 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    
    <div class="absolute inset-0 opacity-10 pointer-events-none" 
         style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    <section class="w-full max-w-4xl mx-auto px-4 relative z-10 mb-10">
        
        {{-- NOTIFIKASI SUKSES --}}
        @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
             class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-[0_0_20px_rgba(34,197,94,0.2)]">
            <i class="fa-solid fa-circle-check"></i>
            <span class="font-bold text-sm uppercase tracking-wide">
                {{ session('status') === 'profile-updated' ? 'Profil & Alamat Berhasil Diperbarui!' : 'Password Berhasil Diubah!' }}
            </span>
        </div>
        @endif

        {{-- KARTU UTAMA --}}
        <div class="bg-slate-900/40 backdrop-blur-2xl rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 overflow-hidden">
            
            {{-- HEADER: Foto & Info User --}}
            <div class="relative p-8 border-b border-white/5 overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <i class="fa-solid fa-gears text-8xl text-white -rotate-12"></i>
                </div>

                <div class="relative flex flex-col md:flex-row items-center gap-6">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-3xl border-4 border-red-600/50 overflow-hidden rotate-3 group-hover:rotate-0 transition-transform duration-500 shadow-2xl bg-slate-800">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&bg=DC002E&color=fff&size=128" class="w-full h-full object-cover" alt="Profile">
                        </div>
                    </div>

                    <div class="text-center md:text-left">
                        <div class="inline-block px-3 py-1 bg-red-600/20 border border-red-600/30 rounded-full mb-2">
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-[0.2em]">
                                {{ ucfirst($user->role ?? 'User') }} Account
                            </p>
                        </div>
                        <h2 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                            Halo, <span class="text-red-600">{{ explode(' ', $user->name)[0] }}</span>
                        </h2>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">
                            Bergabung {{ $user->created_at->format('M Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 space-y-12">
                
                {{-- BAGIAN 1: FORM UTAMA (PROFIL + ALAMAT) --}}
                {{-- Kita satukan formnya agar user cukup sekali klik Simpan --}}
                <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
                    @csrf
                    @method('patch')

                    {{-- SUB: INFORMASI DASAR --}}
                    <div>
                        <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-red-600 pl-3 mb-6">
                            Informasi Dasar
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nama --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-white/10 transition-all">
                                @error('name') <span class="text-red-500 text-xs font-bold ml-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 focus:bg-white/10 transition-all">
                                @error('email') <span class="text-red-500 text-xs font-bold ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SUB: ALAMAT PENGIRIMAN (Field Baru di Tabel Users) --}}
                    <div>
                        <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-blue-500 pl-3 mb-6">
                            Alamat Pengiriman
                        </h3>
                        
                        {{-- Alert Info --}}
                        <div class="mb-6 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 flex gap-3 items-start">
                            <i class="fa-solid fa-circle-info text-blue-400 mt-0.5"></i>
                            <p class="text-blue-200/70 text-xs leading-relaxed">
                                Lengkapi alamat ini untuk mempercepat proses Checkout pembelian sparepart & aksesoris.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            {{-- Penerima --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Penerima Paket</label>
                                <input type="text" name="recipient_name" value="{{ old('recipient_name', $user->recipient_name) }}" placeholder="Nama Penerima"
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all">
                            </div>

                            {{-- No HP --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">No. WhatsApp</label>
                                <input type="number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="08xxxxx"
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all">
                            </div>
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div class="space-y-2 mb-6">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Lengkap</label>
                            <textarea name="address_line" rows="3" placeholder="Nama Jalan, No Rumah, RT/RW, Patokan..."
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 focus:bg-white/10 transition-all">{{ old('address_line', $user->address_line) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Provinsi --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Provinsi</label>
                                <input type="text" name="province" value="{{ old('province', $user->province) }}" placeholder="Jawa Barat"
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                            {{-- Kota --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kota/Kab</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="Bandung"
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                            {{-- Kode Pos --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kode Pos</label>
                                <input type="number" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" placeholder="40xxx"
                                    class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-blue-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black py-4 px-10 rounded-xl uppercase tracking-[0.2em] text-xs shadow-[0_10px_30px_rgba(220,0,46,0.3)] transition-all transform active:scale-95 flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
                        </button>
                    </div>
                </form>

                {{-- DIVIDER --}}
                <div class="border-t border-white/10"></div>

                {{-- BAGIAN 2: FORM UPDATE PASSWORD --}}
                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <h3 class="text-white font-black uppercase italic tracking-wider border-l-4 border-amber-500 pl-3">
                        Ganti Password
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Password Lama</label>
                            <input type="password" name="current_password" autocomplete="current-password"
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                            @error('current_password', 'updatePassword') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Password Baru</label>
                            <input type="password" name="password" autocomplete="new-password"
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                            @error('password', 'updatePassword') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" autocomplete="new-password"
                                class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-4 rounded-2xl text-sm font-bold focus:outline-none focus:border-amber-500 transition-all">
                            @error('password_confirmation', 'updatePassword') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-black py-3 px-8 rounded-xl uppercase tracking-[0.2em] text-xs shadow-[0_10px_30px_rgba(245,158,11,0.3)] transition-all transform active:scale-95 flex items-center gap-2">
                            <i class="fa-solid fa-key"></i> Update Password
                        </button>
                    </div>
                </form>

            </div>
        </div>

        {{-- BAGIAN 3: HAPUS AKUN --}}
        <div class="mt-8 p-6 rounded-3xl border-2 border-red-900/30 bg-red-900/10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h4 class="text-red-500 font-black uppercase tracking-wider mb-1"><i class="fa-solid fa-triangle-exclamation mr-2"></i> Zona Berbahaya</h4>
                <p class="text-slate-400 text-xs max-w-md">
                    Menghapus akun akan menghilangkan semua data riwayat transaksi dan profil Anda secara permanen.
                </p>
            </div>
            
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                class="px-6 py-3 border border-red-500/50 text-red-500 font-bold rounded-xl text-xs uppercase hover:bg-red-600 hover:text-white transition-all">
                Hapus Akun Saya
            </button>
        </div>

    </section>

    {{-- MODAL HAPUS --}}
    <div x-data="{ show: false, name: 'confirm-user-deletion' }" 
         x-show="show" 
         x-on:open-modal.window="if ($event.detail == name) show = true" 
         x-on:close-modal.window="if ($event.detail == name) show = false" 
         x-on:keydown.escape.window="show = false"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center px-4" x-cloak>
         
        <div x-show="show" x-transition.opacity class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="show = false"></div>

        <div x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-slate-900 border border-white/10 rounded-2xl p-6 md:p-8 shadow-2xl relative z-10 w-full max-w-md">
            
            <h2 class="text-xl font-black text-white italic uppercase mb-2">Yakin Hapus Akun?</h2>
            <p class="text-slate-400 text-sm mb-6">
                Masukkan password Anda untuk mengonfirmasi penghapusan akun. Tindakan ini tidak bisa dibatalkan.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-6">
                    <input type="password" name="password" placeholder="Password Anda..." 
                        class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 text-white focus:border-red-500 focus:outline-none">
                    @error('password', 'userDeletion') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" @click="show = false" class="px-4 py-2 text-slate-400 hover:text-white text-sm font-bold">Batal</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg text-sm transition-colors">
                        Ya, Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>
@endsection