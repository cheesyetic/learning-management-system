<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ArtController extends Controller
{
    public function like($id)
    {
        $art = Art::findOrFail($id);
        $art->like = $art->like + 1;
        $art->save();

        Like::create([
            'user_id' => auth()->user()->id,
            'art_id' => $id,
        ]);

        $response = [
            'success' => true,
            'message' => 'Art Liked Successfully',
            'data' => $art,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function unlike($id)
    {
        $art = Art::findOrFail($id);
        $art->like = $art->like - 1;
        $art->save();

        Like::where('user_id', auth()->user()->id)->where('art_id', $id)->delete();

        $response = [
            'success' => true,
            'message' => 'Art Disliked Successfully',
            'data' => $art,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function comment($id)
    {
        $comments = Comment::where('art_id', $id)->whereNull('parent_id')->with('user', 'art', 'replies')->get();

        $response = [
            'success' => true,
            'message' => 'Berhasil mengomentari karya',
            'data' => $comments,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function post_comment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:500',
        ]);

        $art = Art::findOrFail($id);
        $art->comment = $art->comment + 1;
        $art->save();

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];

            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge([
            'user_id' => auth()->user()->id,
            'art_id' => $id,
        ]);

        $comment_creted = Comment::create($request->all());

        $comment = Comment::where('id', $comment_creted->id)->with('user', 'art', 'replies')->first();

        $response = [
            'success' => true,
            'message' => 'Art Commented Successfully',
            'data' => $comment,
            'count' => $art->comment,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function delete_comment($id)
    {
        $comment = Comment::findOrFail($id);
        $art = '';

        if ($comment->parent_id == null) {
            $art = Art::findOrFail($comment->art_id);
            $art->comment = $art->comment - 1;
            $art->save();
        }
        if ($comment->replies->count() > 0) {
            foreach ($comment->replies as $reply) {
                $reply->delete();
            }
        }

        $comment->delete();

        $response = [
            'success' => true,
            'message' => 'Art Comment Deleted Successfully',
            'data' => $comment,
            'count' => $art->comment,
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
