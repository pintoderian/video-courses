<?php

namespace App\Livewire\Tables;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $courses = Course::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.pages.courses.courses-index', compact('courses'));
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function delete($courseId)
    {
        $course = Course::findOrFail($courseId);
        $course->delete();

        session()->flash('message', 'Course successfully deleted.');

        $this->resetPage();
    }
}
