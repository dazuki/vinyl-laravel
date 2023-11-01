<header class="bg-white lg:border-b-2 lg:border-slate-300">
  <div x-data="{ open: false }" class="bg-white">
    <div class="container mx-auto flex justify-between items-center p-4">
      <div class="text-gray-900 font-bold text-xl">
        <a href="/">Vinylskivor Förteckning</a>
      </div>
      <button @click="open = !open" class="lg:hidden text-gray-900">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-6 h-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>
      <div class="hidden lg:flex">
        <ul class="lg:flex space-x-4">
          <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2" href="/create/vinyl">Ny Vinyl</a></li>
          <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2" href="/create/artist">Ny Artist</a></li>
        </ul>
      </div>
    </div>
    <div x-show="open" class="lg:hidden">
      <ul class="bg-white p-4">
        <li><a class="block text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg" href="/create/vinyl">Ny Vinyl</a></li>
        <li><a class="block mt-2 text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg" href="/create/artist">Ny Artist</a></li>
      </ul>
    </div>
  </div>
  </header>