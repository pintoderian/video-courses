<x-homepage-layout>
  <section class="py-20 border-b">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
        <div class="md:col-span-2">
          <h1 class="text-3xl font-bold mb-4">{{ $course->name }}</h1>
          <p class="text-lg mb-4">{{ $course->description }}</p>
        </div>
        <div>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden">
            @if($course->image)
            <img alt="{{ $course->name }}" class="w-full h-60 object-cover" src="{{ Storage::url($course->image) }}" />
            @else
            <img alt="{{ $course->name }}" class="w-full h-60 object-cover" src="/placeholder.svg" />
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-12">
    <div class="container mx-auto px-4">
      <h2 class="text-2xl font-bold mb-4">Course content</h2>
      @foreach($course->videos as $video)
      <a href="/video/{{ $video->slug }}" class="w-full border-b py-4 flex flex-row justify-between">
        {{ $video->name }}
        <span class="bg-slate-700 rounded-md p-2 text-white">@if($video->is_block) Is Private @else Is Public
          @endif</span>
      </a>
      @endforeach
    </div>
  </section>
</x-homepage-layout>