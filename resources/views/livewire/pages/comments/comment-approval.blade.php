<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comments') }}
        </h2>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @if (session()->has('message'))
                <div
                    class="relative w-full rounded-lg border p-4 [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 border-green-400/50 text-green-400 dark:border-green-400 [&>svg]:text-green-400">
                    {{ session('message') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">User</th>
                                <th class="px-6 py-3">Comment</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $comment->user->name }}</td>
                                <td class="px-6 py-4">{{ $comment->content }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm {{ $comment->is_approved ? 'text-green-500' : 'text-yellow-500' }}">
                                        {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <!-- Botones para aprobar/rechazar -->
                                    @if(!$comment->is_approved)
                                    <button wire:click="approve({{ $comment->id }})"
                                        class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
                                    <button wire:click="reject({{ $comment->id }})"
                                        class="bg-red-500 text-white px-4 py-2 rounded ml-2">Reject</button>
                                    @else
                                    <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Approved</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>