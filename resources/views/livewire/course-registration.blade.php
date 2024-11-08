<div>
    <button wire:click="toggleRegistration" class="px-4 py-2 font-semibold text-white rounded
        {{ $isRegistered ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }}">
        {{ $isRegistered ? 'Unsubscribe' : 'Register for the course' }}
    </button>
</div>