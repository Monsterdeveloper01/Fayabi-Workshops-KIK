<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChatController extends Controller
{
    // Satu fungsi untuk menampilkan daftar chat (List Chat)
    public function index()
    {
        // Data Dummy agar tampilan tidak error (Bisa diganti Query Database nanti)
        $chats = [
            (object)[
                'user_id' => 2,
                'user_name' => 'OKIP VARIASI',
                'last_message' => 'Mohon maaf atas kendalanya kak',
                'unread_count' => 0,
                'time' => '13/12/25'
            ],
            (object)[
                'user_id' => 3,
                'user_name' => 'Arjunaireng_part',
                'last_message' => 'Gada ka',
                'unread_count' => 1,
                'time' => '13/12/25'
            ],
        ];

        return view('vendor.chats.index', compact('chats'));
    }

    // Fungsi untuk detail percakapan
    public function show($id)
    {
        $receiver = User::findOrFail($id);
        return view('chat.index', compact('receiver'));
    }
}