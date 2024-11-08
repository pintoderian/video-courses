<footer class="bg-gray-900 text-white py-12">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <h3 class="font-bold mb-4">{{ config('app.name') }} Business</h3>
        <ul class="space-y-2">
          <li>
            <a href="#" class="hover:underline">Teach on {{ config('app.name') }}</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Get the app</a>
          </li>
          <li>
            <a href="#" class="hover:underline">About us</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Contact us</a>
          </li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold mb-4">Careers</h3>
        <ul class="space-y-2">
          <li>
            <a href="#" class="hover:underline">Blog</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Help and Support</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Affiliate</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Investors</a>
          </li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold mb-4">Terms</h3>
        <ul class="space-y-2">
          <li>
            <a href="#" class="hover:underline">Privacy policy</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Cookie settings</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Sitemap</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Accessibility statement</a>
          </li>
        </ul>
      </div>
      <div>
        <h3 class="font-bold mb-4">Stay up to date</h3>
        <form class="flex">
          <input type="email" placeholder="Email"
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 rounded-r-none" />
          <button type="submit"
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 rounded-l-none">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="mt-8 pt-8 border-t border-gray-800 flex justify-between items-center">
      <p>&copy; 2024 {{ config('app.name') }}, Inc.</p>
      <div class="flex space-x-4">
        <a href="#" class="hover:underline">Terms</a>
        <a href="#" class="hover:underline">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>