<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
        <x-link-button href="/dashboard/courses">Lists</x-link-button>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <h1 class="mb-4 text-2xl font-semibold">
                        {{ isset($course) ? 'Edit Course' : 'Create New Course' }}
                    </h1>

                    <form wire:submit.prevent="save">
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                                <input type="text" id="title"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="title">
                                @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
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
                                <label for="age_group"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age Group</label>
                                <select id="age_group"
                                    class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="age_group">
                                    <option value="5-8">5-8</option>
                                    <option value="9-13">9-13</option>
                                    <option value="14-16">14-16</option>
                                    <option value="16+">16+</option>
                                </select>
                                @error('age_group') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select id="category_id"
                                    class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="category_id">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="image"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                <input type="file" id="image"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="image">
                                @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="mt-3 max-w-[200px] rounded-md shadow-md">
                                @endif
                                @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <x-primary-button class="mt-4">
                                    {{ isset($course) ? 'Edit Course' : 'Create Course' }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>