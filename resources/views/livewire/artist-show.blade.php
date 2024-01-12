@section('page-title')
    {{ $artist->name }}
@endsection
<div class="mx-auto max-w-screen-xl text-left pb-2">
    <div
        class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <div x-data="{ show: false }">
            <h1 class="text-2xl text-center font-bold text-gray-700 sm:text-4xl rock-font">
                {{ $artist->name }}
                @auth
                    <div wire:loading class="inline-block">
                        <svg aria-hidden="true"
                            class="w-5 h-5 sm:w-8 sm:h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Laddar...</span>
                    </div>
                    <p>
                        <button x-on:click="show = ! show" id="btnEdit"
                            class="rounded-lg border-2 border-slate-300 px-2 py-1 bg-slate-100 hover:bg-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                        </button>
                        <button id="btnDel"
                            onclick="confirm('Vill du ta bort artist {{ $artist->name }} och ALLA Vinyler till denna artist? (ALLA Vinyler kommer också försvinna från databasen)') || event.stopImmediatePropagation()"
                            wire:click="delete({{ $artist->id }})"
                            class="rounded-lg border-2 border-red-300 px-2 py-1 bg-red-100 hover:bg-red-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </p>
                @endauth
            </h1>
            {{-- <h2 class="text-lg text-center font-semibold">{{ $artist->records->count() }}
                Vinyl{{ $artist->records->count() == 1 ? '' : 'er' }}</h2> --}}
            @auth
                <p class="mt-4 mb-2 text-center mx-auto w-full">
                    <a class="text-gray-900 rounded-lg border-2 border-green-600 p-2 shadow-md bg-slate-100 hover:bg-green-100 w-full"
                        href="/create/vinyl?artist_id={{ $artist->id }}" wire:navigate><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="inline-block -mt-1 mr-1 w-6 h-6 text-green-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>Ny Vinyl</a>
                </p>
            @endauth
            <p class="flex justify-center items-center">
                <a href="https://www.discogs.com/search/?q={{ urlencode($artist->name) }}&type=artist"
                    class="opacity-70 mr-4 hover:opacity-100" target="_BLANK">
                    <img src="{{ asset('static/images/Discogs-01.svg') }}" class="h-16 sm:h-20" alt="DG">
                </a>
                <a href="spotify:search:{{ urlencode($artist->name) }}" class="opacity-70 hover:opacity-100"
                    target="_BLANK">
                    <img src="{{ asset('static/images/spotify_logo.svg') }}" class="h-8 sm:h-10" alt="SF">
                </a>
            </p>
            @if (session('status'))
                <p class="mb-4 px-2 pt-1 text-lg font-semibold text-center">{{ session('status') }}</p>
            @endif
            @error('name')
                <p class="mb-4 px-2 pt-1 text-lg font-semibold text-center text-red-500">Namn kan inte vara tomt...</p>
            @enderror
            @auth
                <div x-cloak x-show="show" x-transition>
                    <form wire:submit="save" id="edit_form">
                        <p class="text-center">
                            <input wire:model="name" type="text" id="artist_edit"
                                class="p-2 mt-2 w-full sm:w-2/6 border-2 border-slate-300 outline-none"
                                placeholder="Skriv nytt namn här..." autocomplete="off"
                                wire:dirty.class="border-orange-300">
                        </p>
                        <p class="text-center">
                            <button type="submit" id="subBtn"
                                class="p-4 mt-2 mb-2 shadow-md rounded-lg bg-slate-100 font-semibold w-full sm:w-2/6 border-2 border-slate-300 outline-none hover:bg-slate-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="inline-block mr-2 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>Uppdatera Namn
                            </button>
                        </p>
                    </form>
                </div>
            @endauth
        </div>
        @php
            $count = 1;
        @endphp
        @foreach ($artist->records as $record)
            <p wire:key="{{ $record->id }}"
                class="flex items-center px-2 py-2 text-left font-medium uppercase {{ $loop->last ? '' : 'border-b ' }}hover:bg-slate-50">
                <span class="font-bold text-slate-500 lg:text-2xl w-6 sm:w-8 mr-2">{{ $count }}.</span>
                @auth
                    <button
                        onclick="confirm('Vill du ta bort vinylen {{ $record->record_name }}?') || event.stopImmediatePropagation()"
                        wire:click="recordDelete({{ $record->id }})"
                        class="inline-block text-red-500 text-xl lg:text-2xl px-2 mr-2 hover:bg-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
                @endauth
                <span class="lg:text-2xl rock-font text-gray-700">
                    <a href="https://www.discogs.com/search/?q={{ urlencode($artist->name . ' ' . $record->record_name) }}&type=release&format_exact=Vinyl"
                        target="_BLANK" class="hover:text-green-700">{{ $record->record_name }}</a>
                </span>
            </p>
            @php
                $count++;
            @endphp
        @endforeach
        <p class="mt-6 mb-6 text-center">
            <a href="/"
                class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300"
                wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="inline-block -mt-2 mr-1 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>Startsidan
            </a>
        </p>
    </div>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</div>
