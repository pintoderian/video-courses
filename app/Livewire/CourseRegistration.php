<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseRegistration extends Component
{
    public $course;
    public $isRegistered;

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->isRegistered = UserCourse::where('user_id', Auth::id())
            ->where('course_id', $this->course->id)
            ->exists();
    }

    public function toggleRegistration()
    {
        if (!Auth::check()) {
            session()->flash('message', 'You have withdrawn from the course.');
            $this->redirect(route('homepage.course', ['slug' => $this->course->slug]));
            return;
        }

        if ($this->isRegistered) {
            UserCourse::where('user_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->delete();

            $this->isRegistered = false;
            session()->flash('message', 'You have withdrawn from the course.');
            $this->redirect(route('homepage.course', ['slug' => $this->course->slug]));
        } else {
            UserCourse::create([
                'user_id' => Auth::id(),
                'course_id' => $this->course->id,
            ]);

            $this->isRegistered = true;
            session()->flash('messageSuccess', 'You have successfully registered for the course!');
            $this->redirect(route('homepage.course', ['slug' => $this->course->slug]));
        }
    }

    public function render()
    {
        return view('livewire.course-registration');
    }
}
