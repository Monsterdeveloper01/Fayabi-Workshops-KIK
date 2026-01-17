@extends('layouts.app')

@section('content')
<div class="bg-slate-950 min-h-screen py-10 relative overflow-hidden" x-data="vendorChatHandler()">
    
    {{-- Glow Effects --}}
    <div class="absolute top-0 -left-20 w-[500px] h-[500px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-2xl mx-auto px-4 relative z-10">
        
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-black text-white uppercase italic tracking-tighter">
                    Pesan <span class="text-red-600">Masuk</span>
                </h1>
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Customer Service Center</p>
            </div>
            <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-slate-400">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>

        {{-- Inbox List --}}
        <div id="vendor-inbox" class="bg-slate-900/40 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
            
            {{-- Search Bar --}}
            <div class="p-6 border-b border-white/5 bg-white/5">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                    <input type="text" placeholder="Cari nama customer..." 
                           class="w-full bg-slate-950 border border-white/5 rounded-xl py-3 pl-10 pr-4 text-xs text-white focus:border-red-600 transition-all outline-none">
                </div>
            </div>

            {{-- List Conversations --}}
            <div class="divide-y divide-white/5">
                @forelse($chats as $chat)
                <a href="{{ route('chat.show', $chat->user_id) }}" 
                   class="flex items-center gap-4 p-6 hover:bg-white/5 transition-all group relative">
                    
                    {{-- Avatar Inisial --}}
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-slate-800 to-slate-700 flex items-center justify-center text-white font-black text-xl border border-white/10 shadow-lg group-hover:border-red-600/50 transition-colors">
                        {{ substr($chat->user_name, 0, 1) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="text-sm font-black text-white group-hover:text-red-500 transition-colors uppercase tracking-tight">
                                {{ $chat->user_name }}
                            </h4>
                            <span class="text-[10px] text-slate-500 font-bold uppercase">{{ $chat->time }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <p class="text-xs {{ $chat->unread_count > 0 ? 'text-white font-bold' : 'text-slate-400 font-medium' }} truncate pr-10 italic">
                                {{ $chat->last_message }}
                            </p>
                            
                            {{-- Badge Notifikasi Unread --}}
                            @if($chat->unread_count > 0)
                            <div class="bg-red-600 text-white text-[9px] font-black w-5 h-5 flex items-center justify-center rounded-lg shadow-lg shadow-red-600/40 animate-bounce">
                                {{ $chat->unread_count }}
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Indikator Panah --}}
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity ml-2">
                        <i class="fa-solid fa-chevron-right text-red-600 text-xs"></i>
                    </div>
                </a>
                @empty
                <div class="py-24 text-center">
                    <div class="w-20 h-20 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/5">
                        <i class="fa-solid fa-message-slash text-3xl text-slate-600"></i>
                    </div>
                    <h3 class="text-white font-bold uppercase italic tracking-wider">Belum Ada Pesan</h3>
                    <p class="text-slate-500 text-xs max-w-xs mx-auto mt-2 leading-relaxed">
                        Kotak masuk Anda masih kosong. Pesan dari pelanggan akan muncul di sini.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-8 flex items-center justify-center gap-2 text-slate-600 uppercase text-[9px] font-black tracking-[0.3em]">
            <i class="fa-solid fa-shield-halved"></i>
            <span>End-to-End Encrypted Fayabi Chat</span>
        </div>
    </div>
</div>

<script>
    function vendorChatHandler() {
        return {
            init() {
                // Polling untuk update inbox setiap 5 detik agar unread count & pesan terbaru update otomatis
                setInterval(() => {
                    fetch(window.location.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newInbox = doc.getElementById('vendor-inbox').innerHTML;
                            document.getElementById('vendor-inbox').innerHTML = newInbox;
                        });
                }, 5000);
            }
        }
    }
</script>
@endsection