<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::all()->except(auth()->user()->id);

        foreach ($users as $user) {
            $last_chat = Chat::where('user_id', auth()->user()->id)
                ->where('receiver_id', $user->id)
                ->orWhere('user_id', $user->id)
                ->where('receiver_id', auth()->user()->id)
                ->latest()
                ->first();

            if ($last_chat != null) {
                $user->last_chat = $last_chat->body;
                //Substract only first 25 words
                $user->last_chat = implode(' ', array_slice(explode(' ', $user->last_chat), 0, 25));
                $created_at = Carbon::parse($last_chat->created_at)->locale('id');
                $user->chat_diff = $created_at->diffForHumans();
            } else {
                $user->last_chat = null;
            }
        }

        $chats = $users->where('last_chat', '!=', null)->sortByDesc('chat_diff');

        return view('content.general.chat.index', compact('chats', 'users'));
    }
}
