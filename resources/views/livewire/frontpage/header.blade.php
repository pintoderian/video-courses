<header class="border-b">

  <div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <a href="/" class="text-2xl font-bold" wire:navigate>{{ config('app.name') }}</a>
    <div class="hidden md:flex items-center space-x-4 flex-1 max-w-sm lg:max-w-xl mx-4">
      <input type="search" placeholder="Search for anything"
        class="flex h-10 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full" />
      <button
        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
        <span>Search</span>
      </button>
    </div>
    <nav class="hidden lg:flex items-center space-x-4">
      <a href="/category/development" class="text-sm font-medium hover:underline" wire:navigate>Development</a>
      <a href="/category/marketing" class="text-sm font-medium hover:underline" wire:navigate>Marketing</a>
    </nav>
    <div class="flex items-center space-x-2">
      @if (Route::has('login'))
      <livewire:frontpage.navigation />
      @endif
    </div>
  </div>
</header>