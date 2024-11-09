<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCourse;
use App\Models\UserVideoProgress;
use App\Models\Video;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function update($courseId, Request $request)
    {
        $request->validate([
            'video_id' => 'required|exists:videos,id',
            'is_completed' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = $request->user_id;

        // Validar que el usuario esté registrado en el curso
        $isRegistered = UserCourse::where('user_id', $user)
            ->where('course_id', $courseId)
            ->exists();

        if (!$isRegistered) {
            return response()->json(['message' => 'Please register for the course first!'], 403);
        }

        // Obtener el ID del video del request
        $videoId = $request->video_id;

        // Validar que el video pertenece al curso
        $video = Video::where('id', $videoId)
            ->where('course_id', $courseId)
            ->first();

        if (!$video) {
            return response()->json(['message' => 'Video not found in this course!'], 404);
        }

        $progress = UserVideoProgress::updateOrCreate(
            [
                'user_id' => $user,
                'video_id' => $videoId,
                'course_id' => $courseId,
            ],
            [
                'is_completed' => $request->is_completed,
                'watched_at' => now(),
            ]
        );

        return response()->json([
            'message' => $progress->is_completed ? 'Video marked as completed!' : 'Progress unmarked!',
            'is_completed' => $progress->is_completed
        ]);
    }
}
