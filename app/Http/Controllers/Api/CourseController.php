<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
}
