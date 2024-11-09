<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('category');

        $search = $request->input('search');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $category = $request->input('category_id');
        if ($category) {
            $query->where('category_id', $category);
        }

        $age_group = $request->input('age_group');
        if ($age_group) {
            $query->where('age_group', $age_group);
        }

        $courses = $query->paginate(10)->appends(request()->query());

        return $courses;
    }

    public function videos($courseId)
    {
        $course = Course::findOrFail($courseId);
        $videos = Video::where('course_id', $course->id)->paginate(10);
        return $videos;
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        $courseId = $request->course_id;
        $course = Course::find($courseId);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $user = User::find($request->user_id);
        if ($user->courses()->where('course_id', $courseId)->exists()) {
            return response()->json(['message' => 'User already registered in this course'], 400);
        }

        $user->courses()->attach($courseId);

        return response()->json(['message' => 'User successfully registered in the course'], 200);
    }
}
