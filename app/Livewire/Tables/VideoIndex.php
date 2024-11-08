<?php

namespace App\Livewire\Tables;

use App\Models\Course;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;

class VideoIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $courseId = '';

    public function render()
    {
        $videos = Video::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('course_id', $this->courseId)
            ->paginate(10);
        $courses = Course::all();

        return view('livewire.pages.videos.videos-index', compact('videos', 'courses'));
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->courseId = '';
    }

    public function delete($videoId)
    {
        $video = Video::findOrFail($videoId);
        $video->delete();

        session()->flash('message', 'Video successfully deleted.');

        $this->resetPage();
    }
}
