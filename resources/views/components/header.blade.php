<header class="border-b-2 border-slate-300 sticky top-0 z-50">
    <div x-data="{ open: false }" class="gradient">
        <div class="container mx-auto flex justify-between items-center p-2 pl-2 max-w-7xl">
            <div class="flex justify-center text-gray-900 font-bold text-xl sm:text-2xl lg:text-3xl">
                <a href="/" class="antialiased items-center" wire:navigate>
                    {{-- <img src="{{ asset('static/images/vinyl-record-svgrepo-com.svg') }}"
            class="inline-block -mt-1 h-6 w-6 lg:w-8 lg:h-8"> --}}
                    <div class="inline-block items-center">
                        <img src="{{ asset('static/images/vinyl-laravel_logo.png') }}"
                            class="h-[24px] lg:h-[32px] md:h-[32px]">
                    </div>
                    @auth
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="inline-block items-center -mt-2 lg:-mt-3 md:-mt-3 w-5 lg:w-6 md:w-6 text-green-700">
                            <path fill-rule="evenodd"
                                d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z"
                                clip-rule="evenodd" />
                        </svg>
                    @endauth
                </a>
            </div>
            <button @click="open = !open" class="lg:hidden text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="square" stroke-linejoin="square" stroke-width="3"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="hidden lg:flex">
                <ul class="lg:flex space-x-1 rock-font text-sm">
                    @auth
                        <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-green-700 hover:bg-green-50"
                                href="/create/vinyl" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>Ny Vinyl</a></li>
                        <li><a class="text-gray-900 hover:text-cyan-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-cyan-700 hover:bg-cyan-50"
                                href="/create/artist" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-cyan-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>Ny Artist</a></li>
                        <li><a class="text-gray-900 hover:text-blue-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-blue-700 hover:bg-blue-50"
                                href="/export/artist"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-blue-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>Excel (.xls)</a></li>
                        <li><a class="text-gray-900 hover:text-yellow-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50"
                                href="/history" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-yellow-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>Historik</a></li>
                        <li><a class="text-gray-900 hover:text-red-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-red-700 hover:bg-red-50"
                                href="/logout" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-red-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>Logga Ut</a></li>
                    @else
                        <li><a class="text-gray-900 hover:text-blue-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-blue-700 hover:bg-blue-50"
                                href="/export/artist">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-blue-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>Excel (.xls)</a></li>
                        <li><a class="text-gray-900 hover:text-yellow-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50"
                                href="/history" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 pr-1 text-yellow-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>Historik</a></li>
                        <li><a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 bg-slate-100 hover:border-green-700 hover:bg-green-50"
                                href="/login" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="inline-block w-7 h-7 -mt-1 text-green-700">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                </svg>Logga In</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div x-cloak x-show="open" class="lg:hidden" x-transition>
            <ul id="burgerMenu" class="bg-white px-4 py-4 rock-font text-sm">
                @auth
                    <li><a class="lg:hidden text-left block text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-green-700 hover:bg-green-50"
                            href="/create/vinyl" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-green-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>Ny Vinyl</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-cyan-700 hover:bg-cyan-50"
                            href="/create/artist" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-cyan-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>Ny Artist</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-blue-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-blue-700 hover:bg-blue-50"
                            href="/export/artist">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>Excel (.xls)</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-yellow-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50"
                            href="/history" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-yellow-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>Historik</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-red-700 bg-slate-100 shadow-md rounded-lg border-2 border-slate-300 p-2 text-lg hover:border-red-700 hover:bg-red-50"
                            href="/logout" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-red-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>Logga Ut</a></li>
                @else
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-blue-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-blue-700 hover:bg-blue-50"
                            href="/export/artist">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>Excel (.xls)</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-yellow-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50"
                            href="/history" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-yellow-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>Historik</a></li>
                    <li><a class="lg:hidden text-left block mt-2 text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100 hover:border-green-700 hover:bg-green-50"
                            href="/login" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="inline-block w-7 h-7 -mt-1 pr-1 text-green-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>Logga In</a></li>
                @endauth
            </ul>
        </div>
    </div>
</header>
