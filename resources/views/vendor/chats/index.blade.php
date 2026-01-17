@extends('layouts.app')

@section('content')
<div class="bg-slate-950 min-h-screen py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-black text-white mb-6 uppercase tracking-tighter italic">Pesan <span class="text-red-600">Masuk</span></h1>
        
        <div class="bg-white/5 border border-white/10 rounded-[2rem] overflow-hidden backdrop-blur-xl shadow-2xl">
            {{-- Search Bar --}}
            <div class="p-4 border-b border-white/10 bg-white/5">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                    <input type="text" placeholder="Cari percakapan..." class="w-full bg-slate-950 border border-white/5 rounded-xl py-2 pl-10 pr-4 text-xs text-white focus:border-red-600 transition-all">
                </div>
            </div>

            {{-- List Chat --}}
            <div class="divide-y divide-white/5">
                @forelse($chats as $chat)
                <a href="{{ route('chat.index', $chat->user_id) }}" class="flex items-center gap-4 p-4 hover:bg-white/5 transition-colors group relative">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-slate-800 to-slate-700 flex items-center justify-center text-white font-bold border border-white/10">
                        {{ substr($chat->user_name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="text-sm font-bold text-white group-hover:text-red-500 transition-colors">{{ $chat->user_name }}</h4>
                            <span class="text-[10px] text-slate-500">12/05/26</span>
                        </div>
                        <p class="text-xs text-slate-400 truncate pr-8">{{ $chat->last_message }}</p>
                    </div>
                    
                    {{-- Badge Notifikasi Unread (Mirip Gambar 3) --}}
                    @if($chat->unread_count > 0)
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 bg-red-600 text-white text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full shadow-lg shadow-red-600/30">
                        {{ $chat->unread_count }}
                    </div>
                    @endif
                </a>
                @empty
                <div class="p-20 text-center">
                    <i class="fa-solid fa-comments text-5xl text-slate-800 mb-4"></i>
                    <p class="text-slate-500 text-sm">Belum ada pesan dari customer.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection