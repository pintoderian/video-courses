<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Course;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Str;

class CourseForm extends Component
{
    use WithFileUploads;

    public $course;
    public $name, $description, $age_group, $category_id, $slug, $image, $is_paid;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'age_group' => 'required|in:5-8,9-13,14-16,16+',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function mount($courseId = null)
    {
        if ($courseId) {
            $this->course = Course::findOrFail($courseId);
            $this->name = $this->course->name;
            $this->description = $this->course->description;
            $this->age_group = $this->course->age_group;
            $this->category_id = $this->course->category_id;
            $this->slug = $this->course->slug;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $data = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'age_group' => $validatedData['age_group'],
            'category_id' => $validatedData['category_id'],
            'slug' => isset($validatedData['slug']) ? $validatedData['slug'] : Str::slug($validatedData['name']),
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('images', 'public');
        }

        if ($this->course) {
            $this->course->update($data);
        } else {
            Course::create($data);
        }

        session()->flash('message', $this->course ? 'Course updated successfully' : 'Course created successfully');

        return redirect()->route('courses.index');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.pages.courses.course-form', compact('categories'));
    }
}
