<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
  <div className="min-h-screen bg-white">
    <livewire:frontpage.header />
    <div class="mx-auto max-w-lg min-h-screen">
      <main class="py-24">
        {{ $slot }}
      </main>
    </div>
    <livewire:frontpage.footer />
  </div>
</body>

</html>