<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VideoComments extends Component
{
    public $video;
    public $commentText;

    protected $rules = [
        'commentText' => 'required|max:500',
    ];

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function addComment()
    {
        $this->validate();

        if (Auth::check()) {
            Comment::create([
                'user_id' => Auth::id(),
                'video_id' => $this->video->id,
                'comment' => $this->commentText,
            ]);

            $this->commentText = '';

            session()->flash('messageSuccess', 'Comment added successfully.');
        } else {
            session()->flash('error', 'You must log in to comment!');
        }
        $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
            session()->flash('messageSuccess', 'Comment successfully deleted.');
            $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
        } else {
            session()->flash('error', 'You cannot delete this comment.');
            $this->redirect(route('homepage.video', ['slug' => $this->video->slug]));
        }
    }

    public function render()
    {
        $comments = Comment::where('video_id', $this->video->id)
            ->where('approved', 1)
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.video-comments', compact('comments'));
    }
}
