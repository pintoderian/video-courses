<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\UserCourse;
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
            session()->flash('message', 'This ' . $video->name . ' is private, auth required!.');
            return redirect('/course/' . $video->course->slug);
        }

        $userRegistered = UserCourse::where('user_id', Auth::id())->where('course_id', $video->course->id)->first();

        if (Auth::check() && !$userRegistered) {
            session()->flash('message', 'This ' . $video->name . ' is private, You are required to register for the course!.');
            return redirect('/course/' . $video->course->slug);
        }

        return view('video', compact('video'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $courses = Course::where('category_id', $category->id)->get();

        return view('category', compact('category', 'courses', 'categories'));
    }

    public function groupCourse($slug)
    {
        $ageGroups = ['5-8', '9-13', '14-16', '16+'];
        if (!in_array($slug, $ageGroups)) {
            abort(404);
        }
        $categories = Category::all();
        $courses = Course::where('age_group', $slug)->get();
        return view('group', compact('slug', 'courses', 'categories'));
    }
}
