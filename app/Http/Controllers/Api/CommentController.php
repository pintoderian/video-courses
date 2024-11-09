<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($videoId, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->video_id = $videoId;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json(['message' => 'Comment successfully added'], 200);
    }
}
