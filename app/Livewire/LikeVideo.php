<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeVideo extends Component
{
    public $video;
    public $isLiked;

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->isLiked = Like::where('user_id', Auth::id())
            ->where('video_id', $this->video->id)
            ->exists();
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            session()->flash('message', 'You must be logged in to like a video.');
            $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
            return;
        }

        if ($this->isLiked) {
            Like::where('user_id', Auth::id())
                ->where('video_id', $this->video->id)
                ->delete();

            $this->isLiked = false;
            session()->flash('message', 'You have unliked the video.');
            $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'video_id' => $this->video->id,
            ]);

            $this->isLiked = true;
            session()->flash('messageSuccess', 'You liked the video!');
            $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
        }
    }

    public function render()
    {
        return view('livewire.like-video');
    }
}
