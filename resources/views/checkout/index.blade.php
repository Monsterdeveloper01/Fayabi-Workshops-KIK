@extends('layouts.app')

@section('content')
@php
    $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * ($item['qty'] ?? 1));
    $ppn = $subtotal * 0.11;
    $serviceFee = $subtotal > 0 ? 2500 : 0;
    $total = $subtotal + $ppn + $serviceFee;
@endphp

<div class="bg-white min-h-screen pb-20 font-sans">
    <div class="max-w-6xl mx-auto px-4 pt-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">      
            {{-- KOLOM KIRI: RINGKASAN --}}
            <div>
                <h2 class="text-4xl font-black text-slate-900 mb-2 uppercase italic tracking-tighter">Shopping <span class="text-red-600">Cart</span></h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-10">Review your items before payment</p>

                <div class="space-y-10 border-t border-slate-100 pt-10">
                        @forelse($cartItems as $index => $item)
                    <div class="flex gap-8 items-start group relative p-4 hover:bg-slate-50/50 transition-all rounded-2xl border border-transparent hover:border-slate-100">
                            {{-- Gambar Produk --}}
                            <div class="w-32 h-32 bg-slate-50 overflow-hidden rounded-xl border border-slate-100 flex-shrink-0">
                                <img src="{{ $item['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            
                            {{-- Konten Produk --}}
                            <div class="flex-grow pr-10"> {{-- pr-10 agar teks tidak menabrak tombol hapus --}}
                                <span class="text-[9px] font-black text-red-600 uppercase tracking-widest">{{ $item['category'] ?? 'Product' }}</span>
                                <h3 class="font-black text-xl text-slate-900 uppercase italic leading-tight mb-1">{{ $item['name'] }}</h3>
                                <p class="font-black text-slate-700 italic text-sm">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                
                                <div class="mt-4">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Quantity: {{ $item['qty'] ?? 1 }}</p>
                                </div>
                            </div>

                            {{-- TOMBOL HAPUS (POJOK KANAN ATAS) --}}
                            <div class="absolute top-4 right-4">
                                <form action="{{ route('cart.remove', $index) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus {{ $item['name'] }} dari keranjang?')" class="text-slate-300 hover:text-red-600 transition-colors flex items-center gap-1 group/btn">
                                        <span class="text-[10px] font-black uppercase tracking-tighter opacity-0 group-hover/btn:opacity-100 transition-opacity">Remove</span>
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>                        
                        </div>                   
                        @empty
                        <div class="py-20 text-center border-2 border-dashed border-slate-100 rounded-xl">
                            <i class="fa-solid fa-cart-shopping text-4xl text-slate-200 mb-4"></i>
                            <p class="font-bold text-slate-400 uppercase tracking-widest text-xs">Keranjang Anda Kosong</p>
                            <a href="/" class="text-red-600 font-black text-xs uppercase underline mt-4 inline-block italic">Mulai Belanja</a>
                        </div>
                    @endforelse
                </div>

                @if($subtotal > 0)
                <div class="mt-16 space-y-4 border-t-4 border-slate-900 pt-10">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400">
                        <span>Subtotal</span>
                        <span class="text-slate-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400">
                        <span>Tax (PPN 11%)</span>
                        <span class="text-red-600">+ Rp {{ number_format($ppn, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400">
                        <span>Service Fee</span>
                        <span class="text-slate-900 font-bold">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-end pt-6">
                        <span class="text-sm font-black uppercase italic tracking-[0.2em]">Total Bill</span>
                        <span class="text-3xl font-black text-slate-900 italic tracking-tighter">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endif
            </div>

            {{-- KOLOM KANAN: CHECKOUT & PAYMENT --}}
            <div>
                <h2 class="text-4xl font-black text-slate-900 mb-2 uppercase italic tracking-tighter">Checkout</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-10">Select your preferred payment method</p>

                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-900">Contact Information</label>
                        <input type="email" name="email" required placeholder="EMAIL ADDRESS (CONTOH: JANE@GMAIL.COM)" 
                               class="w-full p-5 border-2 border-slate-100 font-bold text-sm uppercase focus:border-red-600 outline-none transition-all italic rounded-lg">
                    </div>

                    <div class="space-y-6">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-900 flex items-center gap-2">
                            <span class="w-4 h-[2px] bg-red-600"></span> Select Payment Method
                        </label>
                        
                        <div class="grid grid-cols-1 gap-4">
                            {{-- QRIS --}}
                            <label class="relative flex items-center justify-between p-5 border-2 border-slate-100 cursor-pointer hover:border-red-600 transition-all has-[:checked]:border-red-600 has-[:checked]:bg-red-50/30 group rounded-lg">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment" value="qris" class="w-5 h-5 accent-red-600" checked>
                                    <div>
                                        <span class="text-sm font-black uppercase italic block group-hover:text-red-600">QRIS / All E-Wallet</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter italic">Dana, OVO, GoPay, ShopeePay</span>
                                    </div>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/QRIS_logo.svg" class="h-6 object-contain grayscale group-hover:grayscale-0 transition-all">
                            </label>

                            {{-- BANK --}}
                            <label class="relative flex items-center justify-between p-5 border-2 border-slate-100 cursor-pointer hover:border-red-600 transition-all has-[:checked]:border-red-600 has-[:checked]:bg-red-50/30 group rounded-lg">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment" value="va" class="w-5 h-5 accent-red-600">
                                    <div>
                                        <span class="text-sm font-black uppercase italic block group-hover:text-red-600">Virtual Account</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter italic">BCA, Mandiri, BNI, BRI</span>
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center grayscale group-hover:grayscale-0 transition-all">
                                    <img src="https://lenterakecil.com/wp-content/uploads/2023/08/e-wallet.jpg" class="h-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" class="h-3">
                                </div>
                            </label>
                        </div>
                    </div>

                    <a href="/" 
                    @click.prevent="
                            $dispatch('notif-sukses'); 
                            setTimeout(() => { window.location.href = '/' }, 2000)
                    "
                    class="w-full bg-slate-900 text-white py-6 font-black uppercase tracking-[0.3em] text-xs hover:bg-red-600 transition-all duration-500 shadow-xl rounded-lg flex items-center justify-center group cursor-pointer">
                        <span class="group-hover:scale-110 transition-transform duration-300">
                            Complete Order
                        </span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection