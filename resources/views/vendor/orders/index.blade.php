@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 py-12">
    <div class="container mx-auto px-4">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">
                    Pesanan <span class="text-red-600">Masuk</span>
                </h1>
                <p class="text-slate-400 text-sm">Kelola pesanan pelanggan Anda di sini.</p>
            </div>
            <a href="{{ route('vendor.dashboard') }}" class="text-slate-400 hover:text-white text-sm font-bold flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-slate-900 border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-400">
                        <thead class="bg-white/5 text-white font-bold uppercase text-xs tracking-wider">
                            <tr>
                                <th class="p-4">No. Order</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Pembeli</th>
                                <th class="p-4">Metode Bayar</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($orders as $order)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="p-4 font-bold text-white font-mono">{{ $order->order_number }}</td>
                                <td class="p-4">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-white">{{ $order->user->name }}</div>
                                    <div class="text-xs opacity-70">{{ $order->email }}</div>
                                </td>
                                <td class="p-4 uppercase font-bold text-xs">{{ $order->payment_method }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('vendor.orders.show', $order->id) }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-4 py-2 rounded-lg font-bold text-xs transition-colors">
                                        <i class="fa-regular fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <i class="fa-solid fa-clipboard-list text-6xl text-slate-800 mb-4"></i>
                    <h3 class="text-white font-bold text-lg">Belum Ada Pesanan</h3>
                    <p class="text-slate-500 text-sm">Produk Anda belum ada yang membeli.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection