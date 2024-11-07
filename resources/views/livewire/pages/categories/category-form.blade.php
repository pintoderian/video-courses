<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
        <x-link-button href="/dashboard/categories">Lists</x-link-button>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <h1 class="mb-4 text-2xl font-semibold">
                        {{ isset($category) ? 'Edit Category' : 'Create New Category' }}
                    </h1>

                    <form wire:submit.prevent="save">
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" id="name"
                                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    wire:model="name">
                                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <x-primary-button class="mt-4">
                                    {{ isset($category) ? 'Edit Category' : 'Create Category' }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>