<x-homepage-layout>
  <section class="flex-grow flex">
    <div class="flex-grow">
      <div class="aspect-video bg-black flex items-center justify-center">
        <div class="w-full h-full">
          <iframe class="w-full h-full" src="{{ $video->embed_url }}" title="YouTube video" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
      </div>

      <div class="container mx-auto px-4 lg:px-0 py-8 border-b mb-8">
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

        <h2 class="text-2xl font-bold mb-4">{{ $video->name }}</h2>

        <p>{{ $video->description }}</p>

        <div class="my-2 flex flex-row gap-4">
          @livewire('video-progress', ['video' => $video, 'routeName' => 'homepage.video'])
          @livewire('like-video', ['video' => $video])
        </div>
      </div>
      <div class="my-6">
        @livewire('video-comments', ['video' => $video])
      </div>
    </div>
  </section>
</x-homepage-layout>