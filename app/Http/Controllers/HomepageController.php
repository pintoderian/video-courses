<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $courses = Course::limit(8)->get();

        return view('welcome', compact('courses', 'categories'));
    }

    public function course($slug)
    {
        $course = Course::with(['category', 'videos'])->where('slug', $slug)->firstOrFail();

        return view('course', compact('course'));
    }

    public function video($slug)
    {
        $video = Video::with(['course'])->where('slug', $slug)->firstOrFail();
        if ($video->is_block && !Auth::check()) {
            return redirect('/course/' . $video->course->slug);
        }

        return view('video', compact('video'));
    }
}
