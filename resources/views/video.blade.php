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
        <h2 class="text-2xl font-bold mb-4">{{ $video->name }}</h2>

        <p>{{ $video->description }}</p>
      </div>
    </div>
  </section>
</x-homepage-layout>