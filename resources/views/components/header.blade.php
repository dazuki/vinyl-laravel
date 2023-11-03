<header class="bg-white lg:border-b-2 lg:border-slate-300">
  <div x-data="{ open: false }" class="bg-white">
    <div class="container mx-auto flex justify-between items-center p-4 max-w-6xl">
      <div class="text-gray-900 font-bold text-2xl">
        <a href="/">Vinylskivor Förteckning
          @auth
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 inline-block text-green-700">
            <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z" clip-rule="evenodd" />
          </svg>
          @endauth
        </a>
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
        @auth
          <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md font-semibold bg-slate-100" href="/create/vinyl">Ny Vinyl</a></li>
          <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md font-semibold bg-slate-100" href="/create/artist">Ny Artist</a></li>
          <li><a class="text-gray-900 hover:text-red-700 rounded-lg border-2 border-red-300 p-2 shadow-md bg-red-100" href="/logout">Logga Ut</a></li>
        @else
          <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md bg-slate-100" href="/login">Logga In</a></li>
        @endauth
        </ul>
      </div>
    </div>
    <div x-show="open" class="lg:hidden">
      <ul class="bg-white p-4">
        @auth
        <li><a class="lg:hidden text-center block text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg font-semibold shadow-md" href="/create/vinyl">Ny Vinyl</a></li>
        <li><a class="lg:hidden text-center block mt-2 text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg font-semibold shadow-md" href="/create/artist">Ny Artist</a></li>
        <li><a class="lg:hidden text-center block mt-2 text-gray-900 hover:text-red-700 bg-red-100 shadow-md rounded-lg border-2 border-red-300 p-2 text-lg" href="/logout">Logga Ut</a></li>
        @else
        <li><a class="lg:hidden text-center block font-semibold text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md" href="/login">Logga In</a></li>
        @endauth
      </ul>
    </div>
  </div>
  </header>