<div id="like">
    <button wire:click="toggleLike" class="px-4 py-2 text-white rounded 
        {{ $isLiked ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-500 hover:bg-gray-600' }}">
        {{ $isLiked ? 'Unlike' : 'Like' }}
    </button>
</div>