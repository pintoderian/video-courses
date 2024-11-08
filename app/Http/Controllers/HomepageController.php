<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

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
}
