@extends('layouts.app')

@section('content')
<div class="bg-slate-950 h-[calc(100vh-80px)] flex flex-col relative overflow-hidden" x-data="chatHandler()">
    {{-- Header --}}
    <div class="bg-white/5 backdrop-blur-md border-b border-white/10 p-4 flex items-center gap-4 z-10">
        <a href="{{ route('chat.list') }}" class="text-white p-2 hover:bg-white/5 rounded-full"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center font-bold text-white">
                {{ substr($receiver->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-white font-bold text-sm leading-none">{{ $receiver->name }}</h3>
                <span class="text-[10px] text-green-500 flex items-center gap-1 mt-1">Online</span>
            </div>
        </div>
    </div>

    {{-- Chat Body --}}
    <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4 no-scrollbar bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]">
        @foreach($messages as $msg)
            <div class="flex flex-col {{ $msg->sender_id == Auth::id() ? 'items-end' : 'items-start' }}">
                <div class="{{ $msg->sender_id == Auth::id() ? 'bg-red-600 text-white rounded-tr-none' : 'bg-white/10 text-slate-200 border border-white/10 rounded-tl-none' }} p-3 rounded-2xl max-w-[80%] text-sm shadow-xl">
                    {{ $msg->message }}
                </div>
                <span class="text-[9px] text-slate-500 mt-1 {{ $msg->sender_id == Auth::id() ? 'mr-1' : 'ml-1' }}">
                    {{ $msg->created_at->format('H:i') }}
                </span>
            </div>
        @endforeach
    </div>

    {{-- Input Chat --}}
    <div class="p-4 bg-slate-900 border-t border-white/10">
        <form action="{{ route('chat.send') }}" method="POST" class="flex items-center gap-3 bg-white/5 p-2 rounded-2xl border border-white/5 focus-within:border-red-600 transition-all">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input type="text" name="message" id="message-input" autocomplete="off" placeholder="Tulis pesan..." class="flex-1 bg-transparent border-none text-white text-sm focus:ring-0">
            <button type="submit" class="bg-red-600 text-white w-10 h-10 rounded-xl flex items-center justify-center hover:bg-red-700 transition-all">
                <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>
    </div>
</div>

<script>
    // Scroll ke bawah saat pertama kali buka
    const chatContainer = document.getElementById('chat-container');
    chatContainer.scrollTop = chatContainer.scrollHeight;

    // Fungsi Polling Sederhana (Cek pesan baru tiap 3 detik)
    function chatHandler() {
        return {
            init() {
                setInterval(() => {
                    // Hanya merefresh bagian chat-container agar tidak lag
                    fetch(window.location.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newMessages = doc.getElementById('chat-container').innerHTML;
                            if (chatContainer.innerHTML !== newMessages) {
                                chatContainer.innerHTML = newMessages;
                                chatContainer.scrollTop = chatContainer.scrollHeight;
                            }
                        });
                }, 3000);
            }
        }
    }
</script>
@endsection