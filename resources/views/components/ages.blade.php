<section class="py-12 bg-gray-50">
  <div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">Age group</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      @php $ages = ['5-8', '9-13', '14-16', '16+']; @endphp
      @foreach($ages as $age)
      <a class="text-center" href="/group/{{ $age }}" wire:navigate>
        <div class="bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
          <span class="font-medium">{{ $age }}</span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>