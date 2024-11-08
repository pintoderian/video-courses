<div class="max-w-2xl mx-auto p-4 space-y-6">
    @if (session()->has('messageSuccess'))
    <x-alert-success>
        {{ session('messageSuccess') }}
    </x-alert-success>
    @endif

    @if (session()->has('error'))
    <x-alert-danger>
        {{ session('error') }}
    </x-alert-danger>
    @endif

    <!-- Caja de comentarios para usuarios autenticados -->
    @auth
    <div class="bg-white shadow-md rounded p-4">
        <h3 class="text-lg font-semibold mb-3">Add a comment</h3>
        <form wire:submit.prevent="addComment">
            <textarea wire:model="commentText" class="w-full p-2 border border-gray-300 rounded mb-2" rows="3"
                placeholder="Escribe tu comentario..."></textarea>
            @error('commentText') <span class="text-red-500">{{ $message }}</span> @enderror
            <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded hover:bg-blue-600">
                Comentar
            </button>
        </form>
    </div>
    @else
    <x-alert-danger>Sign in to leave a comment.</x-alert-danger>
    @endauth

    <!-- Lista de comentarios -->
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">Comments</h3>
        @forelse ($comments as $comment)
        <div class="bg-gray-100 p-4 rounded shadow">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-semibold text-gray-700">
                    {{ $comment->user->name }}
                </div>
                <div class="text-xs text-gray-500">
                    {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
            <p class="text-gray-700">{{ $comment->comment }}</p>
            @if (Auth::id() === $comment->user_id)
            <button wire:click="deleteComment({{ $comment->id }})" class="text-red-500 text-sm hover:underline">
                Eliminar
            </button>
            @endif
        </div>
        @empty
        <p class="text-gray-500">There are no comments yet. Be the first to comment!</p>
        @endforelse
    </div>
</div>