@extends('layouts.app')

@section('content')
<div class="bg-slate-950 h-[calc(100vh-80px)] flex flex-col relative overflow-hidden">
    {{-- Header Chat --}}
    <div class="bg-white/5 backdrop-blur-md border-b border-white/10 p-4 flex items-center gap-4 z-10">
        <a href="javascript:history.back()" class="text-white p-2 hover:bg-white/5 rounded-full"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold text-white shadow-lg shadow-red-600/20">
                {{ substr($receiver->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-white font-bold text-sm leading-none">{{ $receiver->name }}</h3>
                <span class="text-[10px] text-green-500 flex items-center gap-1 mt-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Online
                </span>
            </div>
        </div>
    </div>

    {{-- Chat Body --}}
    <div class="flex-1 overflow-y-auto p-4 space-y-4 no-scrollbar bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]">
        {{-- Pesan dari Vendor (Kiri) --}}
        <div class="flex flex-col items-start">
            <div class="bg-white/10 backdrop-blur-sm border border-white/10 text-slate-200 p-3 rounded-2xl rounded-tl-none max-w-[80%] text-sm shadow-xl">
                Halo kak, ada yang bisa kami bantu mengenai produknya?
            </div>
            <span class="text-[9px] text-slate-500 mt-1 ml-1">14:02</span>
        </div>

        {{-- Pesan dari Customer (Kanan) --}}
        <div class="flex flex-col items-end">
            <div class="bg-red-600 text-white p-3 rounded-2xl rounded-tr-none max-w-[80%] text-sm shadow-lg shadow-red-600/10">
                Barangnya ready stock kak? Untuk pengiriman ke Jakarta berapa hari ya?
            </div>
            <span class="text-[9px] text-slate-500 mt-1 mr-1">14:05 <i class="fa-solid fa-check-double text-blue-500"></i></span>
        </div>
    </div>

    {{-- Input Chat --}}
    <div class="p-4 bg-slate-900 border-t border-white/10">
        <form action="{{ route('chat.send') }}" method="POST" class="flex items-center gap-3 bg-white/5 p-2 rounded-2xl border border-white/5 focus-within:border-red-600/50 transition-all">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <button type="button" class="text-slate-400 p-2 hover:text-white"><i class="fa-solid fa-paperclip"></i></button>
            <input type="text" name="message" placeholder="Tulis pesan..." class="flex-1 bg-transparent border-none text-white text-sm focus:ring-0 placeholder:text-slate-600">
            <button type="submit" class="bg-red-600 text-white w-10 h-10 rounded-xl flex items-center justify-center hover:bg-red-700 transition-all shadow-lg shadow-red-600/20">
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>
    </div>
</div>
@endsection