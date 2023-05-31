<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    public function get_chats($id)
    {
        $user = User::findOrFail($id);

        $chats = Chat::where('user_id', auth()->user()->id)
            ->where('receiver_id', $id)
            ->orWhere('user_id', $id)
            ->where('receiver_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($chats as $chat) {
            //Format chat so it show the date and time only
            $created_at = Carbon::parse($chat->created_at)->locale('id');
            $chat->time = $created_at->format('D, d M Y H:i');
        }

        $response = [
            'success' => true,
            'data' => $chats,
            'user' => $user,
            'message' => 'Chats retrieved successfully.'
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function post_chat($id)
    {
        $validator = Validator::make(request()->all(), [
            'body' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Chat failed to be sent.',
                'data' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $chat = Chat::create([
            'body' => request('body'),
            'user_id' => auth()->user()->id,
            'receiver_id' => $id,
        ]);

        $response = [
            'success' => true,
            'message' => 'Chat sent successfully.',
            'data' => $chat,
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
