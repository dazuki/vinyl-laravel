<div class="sticky top-0 z-50">
    <header class="drop-shadow-box mx-auto w-full max-w-7xl">
        <div x-data="{ open: false }">
            <div
                class="inner-shadow-box container mx-auto flex max-w-7xl items-center justify-between border-b-2 border-l-2 border-r-2 border-slate-300 bg-white p-2 pl-2 shadow-xl">
                <div class="flex justify-center text-xl font-bold text-gray-900 sm:text-2xl lg:text-3xl">
                    <a
                        href="/"
                        wire:navigate
                    >
                        {{-- <img src="{{ asset('static/images/vinyl-record-svgrepo-com.svg') }}"
                class="inline-block -mt-1 h-6 w-6 lg:w-8 lg:h-8"> --}}
                        <div class="inline-block">
                            <img
                                src="{{ asset('static/images/vinyl-laravel_logo2.png') }}"
                                class="h-[20px] md:h-[32px] lg:h-[32px] xl:h-[48px]"
                            >
                        </div>
                        @auth
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="-mt-2 inline-block w-5 items-center text-green-700 md:-mt-3 md:w-6 lg:-mt-3 lg:w-6 xl:-mt-6 xl:w-10"
                            >
                                <path
                                    d="M13 14.0619V22H4C4 17.5817 7.58172 14 12 14C12.3387 14 12.6724 14.021 13 14.0619ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM17.7929 19.9142L21.3284 16.3787L22.7426 17.7929L17.7929 22.7426L14.2574 19.2071L15.6716 17.7929L17.7929 19.9142Z"
                                >
                                </path>
                            </svg>
                        @endauth
                    </a>
                </div>
                <button
                    @click="open = !open"
                    class="text-slate-700 lg:hidden"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="square"
                            stroke-linejoin="square"
                            stroke-width="3"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
                <div class="hidden lg:flex">
                    <ul class="rock-font space-x-1 text-sm lg:flex">
                        @auth
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-green-700 hover:bg-green-50 hover:text-green-700"
                                    href="/create/vinyl"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-green-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                        />
                                    </svg>Ny Vinyl</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-cyan-700 hover:bg-cyan-50 hover:text-cyan-700"
                                    href="/create/artist"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-cyan-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                        />
                                    </svg>Ny Artist</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
                                    href="/export/artist"
                                ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-blue-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                                        />
                                    </svg>Excel (.xls)</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
                                    href="/history"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-yellow-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                        />
                                    </svg>Historik</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-red-700 hover:bg-red-50 hover:text-red-700"
                                    href="/logout"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-red-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                                        />
                                    </svg>Logga Ut</a></li>
                        @else
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
                                    href="/export/artist"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-blue-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                                        />
                                    </svg>Excel (.xls)</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
                                    href="/history"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 pr-1 text-yellow-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                        />
                                    </svg>Historik</a></li>
                            <li><a
                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-gray-900 hover:border-green-700 hover:bg-green-50 hover:text-green-700"
                                    href="/login"
                                    wire:navigate
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="-mt-1 inline-block h-7 w-7 text-green-700"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"
                                        />
                                    </svg>Logga In</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div
                x-cloak
                x-show="open"
                class="lg:hidden"
                x-transition
            >
                <ul
                    id="burgerMenu"
                    class="rock-font bg-white px-4 py-4 text-sm"
                >
                    @auth
                        <li><a
                                class="block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
                                href="/create/vinyl"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-green-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>Ny Vinyl</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-cyan-700 hover:bg-cyan-50 hover:text-green-700 lg:hidden"
                                href="/create/artist"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-cyan-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                    />
                                </svg>Ny Artist</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
                                href="/export/artist"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-blue-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                                    />
                                </svg>Excel (.xls)</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
                                href="/history"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-yellow-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                    />
                                </svg>Historik</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-red-700 hover:bg-red-50 hover:text-red-700 lg:hidden"
                                href="/logout"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-red-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                                    />
                                </svg>Logga Ut</a></li>
                    @else
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
                                href="/export/artist"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-blue-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                                    />
                                </svg>Excel (.xls)</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
                                href="/history"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-yellow-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                    />
                                </svg>Historik</a></li>
                        <li><a
                                class="mt-2 block rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-left text-lg text-gray-900 shadow-md hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
                                href="/login"
                                wire:navigate
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="-mt-1 inline-block h-7 w-7 pr-1 text-green-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"
                                    />
                                </svg>Logga In</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>
</div>
