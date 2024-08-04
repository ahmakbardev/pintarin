<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'dosen_id' => 'required|integer|exists:dosens,id',
        ]);

        $chat = Chat::create([
            'user_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'message' => $request->message,
            'sender' => 'user', // Set 'user' as sender
        ]);

        broadcast(new MessageSent($chat))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }

    public function fetchMessages($dosen_id)
    {
        $user_id = Auth::id(); // Get the authenticated user's ID
        return Chat::where('dosen_id', $dosen_id)
            ->where('user_id', $user_id) // Filter by authenticated user's ID
            ->get();
    }
}
