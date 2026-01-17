<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    // Menampilkan daftar orang yang chat dengan kita
    public function index()
    {
        $authId = Auth::id();

        // Query untuk mengambil list user yang pernah chat dengan kita
        $chats = Message::where('sender_id', $authId)
            ->orWhere('receiver_id', $authId)
            ->select(DB::raw('CASE WHEN sender_id = ' . $authId . ' THEN receiver_id ELSE sender_id END as contact_id'), DB::raw('MAX(created_at) as last_chat'))
            ->groupBy('contact_id')
            ->orderBy('last_chat', 'desc')
            ->get()
            ->map(function ($chat) use ($authId) {
                $contact = User::find($chat->contact_id);
                $lastMsg = Message::where(function($q) use ($authId, $chat) {
                    $q->where('sender_id', $authId)->where('receiver_id', $chat->contact_id);
                })->orWhere(function($q) use ($authId, $chat) {
                    $q->where('sender_id', $chat->contact_id)->where('receiver_id', $authId);
                })->latest()->first();

                return (object)[
                    'user_id' => $contact->id,
                    'user_name' => $contact->name,
                    'last_message' => $lastMsg->message,
                    'unread_count' => Message::where('sender_id', $contact->id)->where('receiver_id', $authId)->where('is_read', false)->count(),
                    'time' => $lastMsg->created_at->diffForHumans()
                ];
            });

        return view('vendor.chats.index', compact('chats'));
    }

    // Menampilkan room chat
    public function show($id)
    {
        $receiver = User::findOrFail($id);
        $authId = Auth::id();

        // Tandai pesan sudah dibaca
        Message::where('sender_id', $id)->where('receiver_id', $authId)->update(['is_read' => true]);

        // Ambil history pesan
        $messages = Message::where(function($q) use ($authId, $id) {
            $q->where('sender_id', $authId)->where('receiver_id', $id);
        })->orWhere(function($q) use ($authId, $id) {
            $q->where('sender_id', $id)->where('receiver_id', $authId);
        })->orderBy('created_at', 'asc')->get();

        return view('chat.index', compact('receiver', 'messages'));
    }

    // Mengirim pesan
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required'
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return redirect()->back();
    }
}