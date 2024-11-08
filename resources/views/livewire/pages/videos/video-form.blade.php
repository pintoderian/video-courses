<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Videos') }}
        </h2>
        <x-link-button href="/dashboard/videos">Lists</x-link-button>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <h1 class="mb-4 text-2xl font-semibold">
                        {{ isset($course) ? 'Edit Video' : 'Create New Video' }}
                    </h1>

                    <form wire:submit.prevent="save">
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="course_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course</label>
                                <select id="course_id"
                                    class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="course_id">
                                    <option value="">None</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" id="name"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="name">
                                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea id="description"
                                    class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="description"></textarea>
                                @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Url</label>
                                <input type="text" id="url"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="url">
                                @error('url') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <div class="flex flex-row gap-2">
                                    <input type="checkbox" id="is_block"
                                        class="rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                        wire:model="is_block">
                                    <label for="is_block"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video is
                                        Private?</label>
                                </div>
                                @error('is_block') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <x-primary-button class="mt-4">
                                    {{ isset($video) ? 'Edit Video' : 'Create Video' }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>