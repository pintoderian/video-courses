<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Videos') }}
        </h2>
        <x-link-button href="/dashboard/videos/create">Create +</x-link-button>
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

                <div class="my-6">
                    <div class="flex flex-row justify-between gap-6">
                        <div class="form-group w-full md:w-9/12">
                            <label for="search"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                            <input type="text" id="search"
                                class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Search ..." wire:model.live="search" />
                        </div>
                        <div class="form-group w-full md:w-3/12">
                            <label for="course_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course</label>
                            <select id="course_id"
                                class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                wire:model.live="course_id">
                                <option value="">None</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Course</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Slug</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $video->course->name }}</td>
                                <td class="px-6 py-4">{{ $video->name }}</td>
                                <td class="px-6 py-4">{{ $video->slug }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-row gap-4">
                                        <!-- Edit Button -->
                                        <x-link-button href="{{ route('videos.edit', $video) }}">Edit</x-link-button>
                                        <!-- Delete Form -->
                                        <x-secondary-button wire:click="delete({{ $video->id }})">
                                            Delete
                                        </x-secondary-button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-center mt-4">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>