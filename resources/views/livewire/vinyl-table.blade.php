<div wire:init="init" class="mx-auto max-w-screen-xl text-left">
    @section('page-title')
        Samling
    @endsection
    @php
        $char = '';
    @endphp
    <div class="relative px-2">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pt-2.5 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <input wire:model.live.debounce.500ms="search" name="search" type="text"
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
                        Artister: <span
                            class="text-base sm:text-xl font-semibold text-blue-800">{{ $loadData ? $art_count : '...' }}</span>
                    </th>
                    <th scope="col"
                        class="px-2 pl-0 sm:px-6 py-2 text-base sm:text-xl whitespace-nowrap antialiased w-1/2">
                        Vinyler: <span
                            class="text-base sm:text-xl font-semibold text-blue-800">{{ $loadData ? $records : '...' }}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-sky-50 lg:border-l-2 lg:border-r-2 border-slate-300 hover:bg-slate-50">
                    <td colspan="2" class="text-center bg-sky-50">
                        <div wire:loading
                            class="px-2 sm:px-6 py-4 align-top text-base sm:text-lg text-gray-900 inline-block">
                            <svg aria-hidden="true"
                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
                    </td>
                </tr>
                @if ($loadData == true)
                    @if (!empty($search) && $artists->count() >= 1)
                        <tr class="bg-sky-50 border-dashed border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300">
                            <td colspan="2" class="text-left px-2 text-gray-900 text-sm sm:text-base sm:px-6 py-2">
                                <p>
                                    Sökord -> "<span
                                        class="font-semibold text-red-600">{{ mb_strtoupper($search) }}</span>"
                                </p>
                                <p><span
                                        class="{{ $searchCountArtist > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2">{{ $searchCountArtist }}</span>
                                    Artist{{ $searchCountArtist == 1 ? '' : 'er' }} och <span
                                        class="{{ $searchCountRecord > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2">{{ $searchCountRecord }}</span>
                                    Vinyl{{ $searchCountRecord == 1 ? '' : 'er' }}
                                    ({{ $searchCountArtist + $searchCountRecord }} totalt)</p>
                            </td>
                        </tr>
                    @endif
                    @if ($artists->count() >= 1)
                        @foreach ($artists as $artist)
                            @if (empty($char) || $char != mb_substr($artist->name, 0, 1))
                                <tr wire:key="char-{{ $char }}"
                                    class="bg-sky-50 border-b lg:border-l-2 lg:border-r-2 border-slate-300">
                                    <td colspan="2"
                                        class="text-center lg:text-left p-2 px-6 text-lg sm:text-xl lg:text-3xl rock-font font-bold text-slate-400">
                                        {{ mb_substr($artist->name, 0, 1) }}</td>
                                </tr>
                            @endif
                            @php
                                $char = mb_substr($artist->name, 0, 1);
                            @endphp
                            <tr wire:key="artist-{{ $artist->id }}"
                                class="bg-white border-b lg:border-l-2 lg:border-r-2 border-slate-300">
                                <td
                                    class="px-2 sm:px-6 py-2 pb-0 align-top font-bold text-lg sm:text-xl lg:text-3xl text-gray-700 rock-font">
                                    <a href="/artist/{{ $artist->id }}" class="antialiased hover:text-blue-800"
                                        wire:navigate>
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
                                    </a>
                                    @php
                                        $vinyler = $artist->records->count();
                                    @endphp
                                    @if ($vinyler == 0)
                                        <p class="text-sm lg:text-lg text-red-400 py-2">
                                            {{ $vinyler }}
                                            Vinyl{{ $vinyler == 1 ? '' : 'er' }}
                                        </p>
                                    @else
                                        <p class="text-sm lg:text-lg text-gray-400 py-2">
                                            {{ $vinyler }}
                                            Vinyl{{ $vinyler == 1 ? '' : 'er' }}
                                        </p>
                                    @endif
                                </td>
                                <td class="sm:px-6 py-2 text-xs align-top">
                                    @if ($vinyler >= 1)
                                        @foreach ($artist->records as $record)
                                            <p class="pb-1 uppercase text-gray-700 sm:text-sm antialiased inter-font">
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
                                        <p class="uppercase text-gray-600 italic">...</p>
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
                @endif
            </tbody>
        </table>
        @if ($loadData == true)
            <div class="py-2 sm:py-0">
                {{ $artists->onEachSide(2)->links() }}</td>
            </div>
        @endif
    </div>
