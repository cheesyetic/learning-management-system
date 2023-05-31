<?php

use App\Http\Controllers\Api\ArtController;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    //Art
    Route::get('/art/{id}/like', [ArtController::class, 'like'])->name('art.like');
    Route::get('/art/{id}/unlike', [ArtController::class, 'unlike'])->name('art.unlike');
    Route::get('/art/{id}/comments', [ArtController::class, 'comment'])->name('art.comment');
    Route::post('/art/{id}/comments', [ArtController::class, 'post_comment'])->name('art.post-comment');
    Route::delete('/art/comments/{comment_id}', [ArtController::class, 'delete_comment'])->name('art.delete-comment');

    //Chat
    Route::get('/chats/{id}', [ChatController::class, 'get_chats'])->name('chat.get-chats');
    Route::post('/chats/{id}', [ChatController::class, 'post_chat'])->name('chat.post-chat');
});
