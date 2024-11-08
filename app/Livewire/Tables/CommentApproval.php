<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;

class CommentApproval extends Component
{
    use WithPagination;

    public $comments;

    public function mount()
    {
        $this->comments = Comment::with('user')->where('approved', false)->get();
    }

    // Aprobar un comentario
    public function approve($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = true;
        $comment->save();

        // Volver a cargar los comentarios
        $this->comments = Comment::with('user')->where('approved', false)->get();

        session()->flash('message', 'Comment approved successfully!');
        $this->resetPage();
    }

    // Rechazar un comentario
    public function reject($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->approved = false;
        $comment->save();

        // Volver a cargar los comentarios
        $this->comments = Comment::with('user')->where('approved', false)->get();

        session()->flash('message', 'Comment rejected.');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.comments.comment-approval');
    }
}
