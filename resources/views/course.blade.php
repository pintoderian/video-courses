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

            <div class="py-4 text-center">
              @livewire('course-registration', ['course' => $course])
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mt-12">
    <div class="container mx-auto px-4">
      <div id="flash-container">
        @if(Session::has('message'))
        <div class="mb-4">
          <x-alert-danger>
            {{ Session::get('message') }}
          </x-alert-danger>
        </div>
        @endif
        @if(Session::has('messageSuccess'))
        <div class="mb-4">
          <x-alert-success>
            {{ Session::get('messageSuccess') }}
          </x-alert-success>
        </div>
        @endif
      </div>
      <h2 class="text-2xl font-bold mb-4">Course content</h2>
      @foreach($course->videos as $video)
      <div class="flex flex-row justify-between w-full border-b py-4 items-center">
        <a href="/video/{{ $video->slug }}" class="hover:underline">
          {{ $video->name }}
        </a>
        <div class="flex flex-row gap-4">
          <span
            class="rounded-md p-2 text-black  {{ $video->is_block ? 'bg-red-400' : 'bg-green-400' }}">@if($video->is_block)
            Is Private @else Is Public
            @endif</span>
          @livewire('video-progress', ['video' => $video])
        </div>
      </div>
      @endforeach
    </div>
  </section>
</x-homepage-layout>