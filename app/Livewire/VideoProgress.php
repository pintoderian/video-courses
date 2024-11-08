<?php

namespace App\Livewire;

use App\Models\UserCourse;
use App\Models\UserVideoProgress;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class VideoProgress extends Component
{
    public $video;
    public $isCompleted;
    public $routeName =  'homepage.course';

    public function mount(Video $video)
    {
        $this->video = $video;

        $progress = UserVideoProgress::where('user_id', Auth::id())
            ->where('video_id', $this->video->id)
            ->first();

        $this->isCompleted = $progress ? $progress->is_completed : false;
    }

    public function toggleProgress()
    {
        $routeSlugRedirect = $this->routeName === 'homepage.course' ? $this->video->course->slug : $this->video->slug;

        if (!Auth::check()) {
            session()->flash('message', 'Auth required!');
            $this->redirect(route($this->routeName, ['slug' => $routeSlugRedirect]));
            return;
        }
        $check = UserCourse::where('user_id', Auth::id())
            ->where('course_id', $this->video->course->id)
            ->first();
        if (!$check) {
            session()->flash('message', 'Please register for the course!');
            $this->redirect(route($this->routeName, ['slug' => $routeSlugRedirect]));
            return;
        }

        UserVideoProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'video_id' => $this->video->id,
                'course_id' => $this->video->course_id,
            ],
            [
                'is_completed' => !$this->isCompleted,
                'watched_at' => now(),
            ]
        );

        $this->isCompleted = !$this->isCompleted;
        if ($this->isCompleted) {
            session()->flash('messageSuccess', '¡Video marked as completed!');
        } else {
            session()->flash('message', '¡Progress unmarked!');
        }
        $this->redirect(route($this->routeName, ['slug' => $routeSlugRedirect]));
    }

    public function render()
    {
        return view('livewire.video-progress');
    }
}
