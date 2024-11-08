<x-homepage-layout>
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl font-bold mb-4">Welcome to the course website</h1>
                <p class="text-xl mb-6">Prepare yourself with the best knowledge on the internet. Enjoy the
                    best courses.
                </p><a
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-8"
                    href="#">Get started</a>
            </div>
        </div>
    </section>
    <section class="py-14">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Last courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($courses as $course)
                <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                    <div class="flex flex-col space-y-1.5 p-0">
                        @if($course->image)
                        <img alt="{{ $course->name }}" class="w-full h-40 object-cover"
                            src="{{ Storage::url($course->image) }}" />
                        @else
                        <img alt="{{ $course->name }}" class="w-full h-40 object-cover" src="/placeholder.svg" />
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold tracking-tight text-lg mb-2">{{ $course->name }}
                        </h3>
                    </div>
                    <div class="flex items-center p-4 pt-0">
                        <a href="/course/{{ $course->slug }}"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full">
                            View Course
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold mb-6">Top categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories as $category)
                <a class="text-center" href="/category/{{ $category->slug }}" wire:navigate>
                    <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                        <span class="font-medium">{{ $category->name }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</x-homepage-layout>