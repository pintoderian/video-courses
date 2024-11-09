<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function like($videoId, Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $video = Video::find($videoId);
        if (!$video) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        if ($video->likes()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'You have already liked this video'], 409);
        }

        $video->likes()->attach($request->user_id);

        return response()->json(['message' => 'Like added successfully'], 200);
    }
}
