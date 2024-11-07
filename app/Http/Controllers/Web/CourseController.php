<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->category_id = $request->category_id;
        $course->age_group = $request->age_group;
        $course->image = $request->file('image')->store('courses', 'public');
        $course->save();

        return redirect()->route('courses.index');
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show', compact('course'));
    }

    public function edit($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(CourseRequest $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->category_id = $request->category_id;
        $course->age_group = $request->age_group;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->save();

        return redirect()->route('courses.index');
    }

    public function destroy($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        Storage::disk('public')->delete($course->image);
        $course->delete();

        return redirect()->route('courses.index');
    }
}
