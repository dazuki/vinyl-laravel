<div wire:init="init" class="mx-auto max-w-screen-xl text-left">
    @section('page-title')
        Samling
    @endsection
    <div class="relative px-2">
        @if ($removed)
            {{-- <p class="alert mb-4 px-2 pt-1 text-lg font-semibold text-red-600 text-center">Artist är borttagen!</p> --}}
        @endif
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pt-2.5 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <input wire:model.live.debounce.500ms="search" type="text"
            class="p-2 pl-10 mt-2 mb-0 w-full sm:w-2/6 border-l-2 border-r-2 border-t-2 border-b-0 border-slate-300 outline-none rounded-t-lg shadow-md"
            placeholder="Sök artister/vinyler..." autocomplete="off" required="">
    </div>
    <div class="relative overflow-x-auto">
        <table
            class="w-full text-sm text-left border-t-2 border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300 text-gray-500">
            <thead
                class="border-b-2 border-t-2 lg:border-l-2 lg:border-r-2 border-slate-300 text-xs text-slate-900 gradient-2">
                <tr>
                    <th scope="col"
                        class="px-2 sm:px-6 py-2 text-base sm:text-xl whitespace-nowrap antialiased w-1/2">
                        Artister: <span class="font-medium">{{ $art_count }}</span>
                    </th>
                    <th scope="col"
                        class="px-2 pl-0 sm:px-6 py-2 text-base sm:text-xl whitespace-nowrap antialiased w-1/2">
                        Vinyler: <span class="font-medium">{{ $records }}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-slate-100 lg:border-l-2 lg:border-r-2 border-slate-300 hover:bg-slate-50">
                    <td colspan="2" class="text-center">
                        <div wire:loading
                            class="px-2 sm:px-6 py-4 align-top text-base sm:text-lg text-gray-900 inline-block">
                            <svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                    opacity=".25" />
                                <path
                                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
                                    <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                        values="0 12 12;360 12 12" repeatCount="indefinite" />
                                </path>
                            </svg>
                        </div>
                    </td>
                </tr>
                @if (!empty($search) && $artists->count() >= 1)
                    <tr class="bg-slate-100 border-dashed border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300">
                        <td colspan="2" class="text-left px-2 text-gray-900 text-sm sm:text-base sm:px-6 py-2">
                            <p>
                                Sökord -> "<span class="font-semibold text-red-800">{{ mb_strtoupper($search) }}</span>"
                            </p>
                            <p><span
                                class="{{ $searchCountArtist > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2">{{ $searchCountArtist }}</span>
                            Artist{{ $searchCountArtist == 1 ? '' : 'er' }} och <span
                                class="{{ $searchCountRecord > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2">{{ $searchCountRecord }}</span>
                            Vinyl{{ $searchCountRecord == 1 ? '' : 'er' }} ({{ $searchCountArtist + $searchCountRecord }} totalt)</p></td>
                    </tr>
                @endif
                @if ($artists->count() >= 1 && $loadData == true)
                    @foreach ($artists as $artist)
                        <tr wire:key="{{ $artist->id }}"
                            onclick="window.location.href='/artist/{{ $artist->id }}'"
                            class="bg-white border-b cursor-pointer lg:border-l-2 lg:border-r-2 border-slate-300 hover:bg-sky-50">
                            <td
                                class="px-2 sm:px-6 py-2 pb-0 align-top font-bold text-lg sm:text-xl lg:text-2xl text-gray-900">
                                <a href="/artist/{{ $artist->id }}" class="antialiased hover:text-blue-800">
                                    @if (!empty($search))
                                        @php
                                            $highlightArtist = explode(' ', mb_strtoupper($search));
                                            $replaceArtist = [];
                                            foreach ($highlightArtist as $wordsArtist) {
                                                $replaceArtist[] = '<span class="text-red-600 underline underline-offset-4">' . $wordsArtist . '</span>';
                                            }

                                            echo str_replace($highlightArtist, $replaceArtist, $artist->name, $count);
                                        @endphp
                                    @else
                                        {{ $artist->name }}
                                    @endif
                                    {{-- $artist->name --}}
                                </a>
                                {{-- <p class="flex justify-start items-center">
                                    <a href="https://www.discogs.com/search/?q={{ urlencode($artist->name) }}&type=artist"
                                        class="opacity-20 hover:opacity-100" target="_BLANK">
                                        <img src="{{ asset('static/images/Discogs-01.svg') }}" class="h-12 sm:h-14"
                                            alt="DG">
                                    </a>
                                    <a href="spotify:search:{{ urlencode($artist->name) }}"
                                        class="opacity-20 grayscale hover:opacity-100 hover:grayscale-0" target="_BLANK">
                                        <img src="{{ asset('static/images/spotify-icon.svg') }}" class="h-6 sm:h-8"
                                            alt="SF">
                                    </a>
                                </p> --}}
                            </td>
                            <td class="sm:px-6 py-2 text-xs align-top">
                                @php
                                    $vinyler = $artist->records->count();
                                @endphp
                                <p class="pb-2">
                                    <span
                                        class="text-slate-700 text-sm sm:text-base font-semibold underline underline-offset-4 antialiased">{{ $vinyler }}
                                        Vinyl{{ $vinyler == 1 ? '' : 'er' }}</span>
                                </p>
                                @if ($vinyler >= 1)
                                    @foreach ($artist->records as $record)
                                        <p class="pb-1 uppercase text-gray-900 sm:text-sm antialiased">
                                            @if (!empty($search))
                                                @php
                                                    $highlightVinyl = explode(' ', mb_strtoupper($search));
                                                    $replaceVinyl = [];
                                                    foreach ($highlightVinyl as $wordsVinyl) {
                                                        $replaceVinyl[] = '<span class="text-red-600 font-semibold underline underline-offset-4">' . $wordsVinyl . '</span>';
                                                    }

                                                    echo str_replace($highlightVinyl, $replaceVinyl, mb_strtoupper($record->record_name), $count);
                                                @endphp
                                            @else
                                                {{ $record->record_name }}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <p class="uppercase text-gray-600 italic">(Tomt)</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    @if ($artists->count() <= 0)
                        <tr class="bg-white border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300">
                            <td colspan="2"
                                class="px-2 sm:px-6 py-4 align-top text-base sm:text-lg text-gray-900 text-center">
                                <p>Här var det tomt...</p>
                                @auth
                                    <div class="mt-4 flex justify-center w-full">
                                        <a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md font-semibold bg-slate-100 w-full text-center"
                                            href="/create/artist?name={{ mb_strtoupper($search) }}">
                                            <p><span class="text-green-700">Ny Artist</span></p>
                                            <p>{{ mb_strtoupper($search) }}</p>
                                        </a>
                                    </div>
                                @endauth
                            </td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
        @if ($loadData == true)
            <div class="py-2 sm:py-0">
                {{ $artists->onEachSide(2)->links() }}</td>
            </div>
        @endif
    </div>
