@extends('layouts.app')

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen pb-20 bg-slate-50">

    <div class="bg-slate-900 pt-12 pb-20 relative overflow-hidden border-b-4 border-amber-500 shadow-[inset_0_6px_10px_-4px_rgba(0,0,0,0.6)] z-20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fbbf24 1px, transparent 1px); background-size: 24px 24px;"></div>
        
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-amber-500/10 border border-amber-500/30 rounded-full px-4 py-1 mb-6">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-amber-500 text-xs font-bold uppercase tracking-widest">Proses Cepat & Aman</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white italic uppercase tracking-tighter mb-4">
                Jual Motormu, <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Langsung Cair.</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Dapatkan penawaran harga terbaik sesuai kondisi pasar. Kami menerima segala jenis motor Jepang (Honda, Yamaha, Suzuki, Kawasaki).
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-10 relative z-30 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3">
                <form action="#" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
                    @csrf
                    
                    <div class="bg-slate-50 border-b border-slate-100 p-6 flex items-center justify-between">
                        <h2 class="text-lg font-black text-slate-800 uppercase italic flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-list text-amber-500"></i> Form Data Motor
                        </h2>
                        <span class="text-xs text-slate-400 font-medium">*Wajib diisi lengkap</span>
                    </div>

                    <div class="p-6 md:p-8 space-y-8">

                        <div>
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">1. Identitas Kendaraan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Merek Motor</label>
                                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all text-slate-700 cursor-pointer">
                                        <option value="" disabled selected>Pilih Merek...</option>
                                        <option value="Honda">Honda</option>
                                        <option value="Yamaha">Yamaha</option>
                                        <option value="Suzuki">Suzuki</option>
                                        <option value="Kawasaki">Kawasaki</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tipe / Model</label>
                                    <input type="text" placeholder="Contoh: Vario 160 ABS" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Pembuatan</label>
                                    <input type="number" placeholder="2022" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Jarak Tempuh (KM)</label>
                                    <div class="relative">
                                        <input type="number" placeholder="15000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 transition-all">
                                        <span class="absolute right-4 top-3 text-slate-400 text-sm font-bold">KM</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ photoPreview: null }">
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">2. Kondisi & Foto</h3>
                            
                            <div class="mb-6">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Kondisi</label>
                                <textarea rows="4" placeholder="Jelaskan kondisi mesin, body, pajak hidup/mati, atau modifikasi yang sudah terpasang..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-500 transition-all"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Upload Foto Motor (Utama)</label>
                                
                                <div class="relative w-full h-48 border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 hover:bg-amber-50 hover:border-amber-400 transition-all flex flex-col items-center justify-center cursor-pointer group overflow-hidden">
                                    
                                    <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                           @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                    
                                    <div x-show="!photoPreview" class="text-center p-4">
                                        <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                                            <i class="fa-solid fa-camera text-slate-400 group-hover:text-amber-500"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-600 group-hover:text-amber-600">Klik untuk upload foto</p>
                                        <p class="text-xs text-slate-400 mt-1">Format JPG/PNG, Maks 5MB</p>
                                    </div>

                                    <img x-show="photoPreview" :src="photoPreview" class="absolute inset-0 w-full h-full object-cover">
                                    
                                    <div x-show="photoPreview" class="absolute bottom-3 right-3 bg-black/50 text-white text-xs px-3 py-1 rounded-full backdrop-blur-sm z-20">
                                        Ganti Foto
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4 border-b border-slate-100 pb-2">3. Harga & Kontak</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga Penawaran Anda</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 text-slate-800 font-bold">Rp</span>
                                        <input type="number" placeholder="15.000.000" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-3 focus:outline-none focus:border-amber-500 font-bold text-slate-800 text-lg transition-all">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor WhatsApp</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-3 text-slate-500"><i class="fa-brands fa-whatsapp text-lg"></i></span>
                                        <input type="tel" placeholder="0812xxxxxxx" class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:border-amber-500 transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="bg-slate-50 p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                        <p class="text-xs text-slate-400 text-center md:text-left">
                            Dengan mengirim formulir ini, Anda menyetujui kebijakan privasi kami.
                        </p>
                        <button type="button" class="w-full md:w-auto bg-amber-500 hover:bg-amber-600 text-white font-black uppercase tracking-wider py-3 px-8 rounded-xl shadow-lg shadow-amber-500/30 transition-transform transform hover:-translate-y-1 active:scale-95">
                            Kirim Penawaran <i class="fa-solid fa-paper-plane ml-2"></i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="w-full lg:w-1/3 space-y-6">
                
                <div class="bg-slate-900 rounded-3xl p-6 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500 rounded-full blur-[60px] opacity-20"></div>
                    
                    <h3 class="text-xl font-black italic uppercase mb-6">Kenapa Jual Disini?</h3>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-amber-500 shrink-0">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">Proses Cepat</h4>
                                <p class="text-xs text-slate-400 mt-1">Estimasi harga dalam 1x24 jam setelah data diterima.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-amber-500 shrink-0">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">Harga Kompetitif</h4>
                                <p class="text-xs text-slate-400 mt-1">Kami berani adu harga sesuai kondisi motor dan pasaran.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-amber-500 shrink-0">
                                <i class="fa-solid fa-file-shield"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm">Dokumen Aman</h4>
                                <p class="text-xs text-slate-400 mt-1">Proses balik nama dan surat-surat kami bantu urus.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <i class="fa-solid fa-headset text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 mb-1">Butuh Bantuan?</h3>
                    <p class="text-xs text-slate-500 mb-4">Bingung soal harga pasaran motormu? Chat admin kami dulu.</p>
                    <a href="#" class="inline-flex items-center justify-center gap-2 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 rounded-xl transition-colors">
                        <i class="fa-brands fa-whatsapp text-lg"></i> Chat via WhatsApp
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection