@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">
                    Mulai <span class="text-red-600">Berjualan</span>
                </h1>
                <p class="text-slate-400 text-sm">Upload produk aksesoris atau sparepartmu disini.</p>
            </div>
            <a href="{{ route('vendor.dashboard') }}" class="text-slate-400 hover:text-white text-sm font-bold">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            
            <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="space-y-4">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Foto Produk Utama</label>
                    <div class="relative w-full h-64 border-2 border-dashed border-slate-700 hover:border-red-600 rounded-2xl bg-slate-800/50 flex flex-col items-center justify-center cursor-pointer group transition-colors overflow-hidden">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                        <div class="text-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-slate-500 group-hover:text-red-500 mb-3"></i>
                            <p class="text-slate-400 text-sm font-bold">Klik untuk upload foto</p>
                            <p class="text-slate-600 text-xs mt-1">Format JPG/PNG, Max 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Nama Produk</label>
                        <input type="text" name="name" placeholder="Contoh: Knalpot Racing Vario 150" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none transition-colors">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Kategori (Admin List)</label>
                        <select name="category_id" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none transition-colors">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            
                            <optgroup label="AKSESORIS">
                                @foreach($categories->where('type', 'aksesoris') as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </optgroup>

                            <optgroup label="SPAREPART">
                                @foreach($categories->where('type', 'sparepart') as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Harga (Rp)</label>
                        <input type="number" name="price" placeholder="150000" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Stok</label>
                        <input type="number" name="stock" placeholder="10" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Berat (Gram)</label>
                        <input type="number" name="weight" placeholder="1000" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Kondisi</label>
                        <select name="condition" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                            <option value="baru">Baru (New)</option>
                            <option value="bekas">Bekas (Second)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Merek / Brand</label>
                        <input type="text" name="brand" placeholder="Misal: RCB, BRT, AHM" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Kompatibilitas Motor</label>
                        <input type="text" name="compatibility" placeholder="Misal: Vario 125/150, Beat FI" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Deskripsi Lengkap</label>
                    <textarea name="description" rows="5" placeholder="Jelaskan spesifikasi detail produkmu..." class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none"></textarea>
                </div>

                <div class="pt-4 border-t border-white/10 flex justify-end">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black py-4 px-10 rounded-xl uppercase tracking-[0.2em] text-xs shadow-lg shadow-red-600/20 transition-all transform active:scale-95">
                        <i class="fa-solid fa-check-circle mr-2"></i> Tayangkan Produk
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection