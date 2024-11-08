<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use App\Models\Video;
use Livewire\Component;
use Illuminate\Support\Str;

class VideoForm extends Component
{
    public $video;
    public $name, $description, $url, $course_id, $slug, $is_block;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'url' => 'required',
        'course_id' => 'required|exists:courses,id',
    ];

    public function mount($videoId = null)
    {
        if ($videoId) {
            $this->video = Video::findOrFail($videoId);
            $this->name = $this->video->name;
            $this->description = $this->video->description;
            $this->url = $this->video->url;
            $this->course_id = $this->video->course_id;
            $this->slug = $this->video->slug;
            $this->is_block = $this->video->is_block;
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
            'url' => $validatedData['url'],
            'course_id' => $validatedData['course_id'],
            'slug' => isset($validatedData['slug']) ? $validatedData['slug'] : Str::slug($validatedData['name']),
            'is_block' => isset($validatedData['is_block']) ? true : false,
        ];

        if ($this->video) {
            $this->video->update($data);
        } else {
            Video::create($data);
        }

        session()->flash('message', $this->video ? 'Video updated successfully' : 'Video created successfully');

        return redirect()->route('videos.index');
    }

    public function render()
    {
        $courses = Course::all();

        return view('livewire.pages.videos.video-form', compact('courses'));
    }
}
