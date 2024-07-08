<div
    wire:init="init"
    class="mx-auto max-w-screen-xl text-left"
>
    @section('page-title')
        Samling
    @endsection
    @php
        $char = '';
    @endphp
    <div class="relative pt-4">
        <svg
            class="svg-icon search-icon absolute bottom-2 left-4 w-8 max-sm:left-6 max-sm:w-6"
            aria-labelledby="title desc"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 19.9 19.7"
        >
            <g
                class="search-path"
                fill="none"
                stroke="#959595"
            >
                <path
                    stroke-linecap="square"
                    d="M18.5 18.3l-5.4-5.4"
                />
                <circle
                    cx="8"
                    cy="8"
                    r="7"
                />
            </g>
        </svg>
        <input
            wire:model.live.debounce.500ms="search"
            name="search"
            type="text"
            class="z-1 inner-shadow-box w-full rounded-t-lg border-b-2 border-l-2 border-r-2 border-t-2 border-slate-300 bg-white p-2 pl-14 text-2xl outline-none max-sm:pl-12 max-sm:text-base"
            placeholder="Sök Artister/Vinyler..."
            autocomplete="off"
            required=""
        >
    </div>
    <div class="relative z-10">
        <div class="shadow-xl">
            <table
                class="w-full border-b-2 border-l-2 border-r-2 border-t-0 border-slate-300 text-left text-sm text-gray-500"
            >
                <thead
                    class="border-b-, border-l-0 border-r-0 border-t-0 border-slate-300 bg-white text-xs text-slate-900"
                >
                    <tr>
                        <th
                            scope="col"
                            class="w-1/2 whitespace-nowrap px-2 py-2 text-base antialiased sm:px-6 sm:text-xl"
                        >
                            Artister: <span
                                class="text-base font-semibold text-green-800 sm:text-xl">{{ $loadData ? $art_count : '...' }}</span>
                        </th>
                        <th
                            scope="col"
                            class="w-1/2 whitespace-nowrap px-2 py-2 pl-0 text-base antialiased sm:px-6 sm:text-xl"
                        >
                            Vinyler: <span
                                class="text-base font-semibold text-green-800 sm:text-xl">{{ $loadData ? $records : '...' }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-slate-300 bg-white hover:bg-slate-50">
                        <td
                            colspan="2"
                            class="bg-white text-center"
                        >
                            <div
                                wire:loading
                                class="inline-block px-2 py-4 align-top text-base text-gray-900 sm:px-6 sm:text-lg"
                            >
                                <svg
                                    aria-hidden="true"
                                    class="h-8 w-8 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
                                    viewBox="0 0 100 101"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor"
                                    />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill"
                                    />
                                </svg>
                                <span class="sr-only">Laddar...</span>
                            </div>
                        </td>
                    </tr>
                    @if ($loadData == true)
                        @if (!empty($search) && $artists->count() >= 1)
                            <tr class="border-b-2 border-dashed border-slate-300 bg-sky-50">
                                <td
                                    colspan="2"
                                    class="border-t-2 border-slate-300 px-2 py-2 text-left text-sm text-gray-900 sm:px-6 sm:text-base"
                                >
                                    <p>
                                        Sökord -> "<span
                                            class="font-semibold text-red-600">{{ mb_strtoupper($search) }}</span>"
                                    </p>
                                    <p><span
                                            class="{{ $searchCountArtist > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2">{{ $searchCountArtist }}</span>
                                        Artist{{ $searchCountArtist == 1 ? '' : 'er' }} och <span
                                            class="{{ $searchCountRecord > 0 ? 'font-semibold text-gray-900 underline ' : '' }}underline-offset-2"
                                        >{{ $searchCountRecord }}</span>
                                        Vinyl{{ $searchCountRecord == 1 ? '' : 'er' }}
                                        ({{ $searchCountArtist + $searchCountRecord }} totalt)</p>
                                </td>
                            </tr>
                        @endif
                        @if ($artists->count() >= 1)
                            @foreach ($artists as $artist)
                                @if (empty($char) || $char != mb_substr($artist->name, 0, 1))
                                    <tr
                                        wire:key="char-{{ $char }}"
                                        class="inner-shadow-box border-b-2 border-t-2 border-slate-300 bg-sky-50"
                                    >
                                        <td
                                            colspan="2"
                                            class="rock-font p-2 px-6 text-center text-lg font-bold text-slate-400 sm:text-xl lg:text-left lg:text-3xl"
                                        >
                                            {{ mb_substr($artist->name, 0, 1) }}</td>
                                    </tr>
                                @endif
                                @php
                                    $char = mb_substr($artist->name, 0, 1);
                                @endphp
                                <tr
                                    wire:key="artist-{{ $artist->id }}"
                                    class="border-b border-slate-300 bg-white"
                                >
                                    <td
                                        class="rock-font px-2 py-2 pb-0 align-top text-lg font-bold text-gray-700 sm:px-6 sm:text-xl lg:text-3xl">
                                        <a
                                            href="/artist/{{ $artist->id }}"
                                            class="antialiased hover:text-blue-800"
                                            wire:navigate
                                        >
                                            @if (!empty($search))
                                                @php
                                                    $highlightArtist = explode(' ', mb_strtoupper($search));
                                                    $replaceArtist = [];
                                                    foreach ($highlightArtist as $wordsArtist) {
                                                        $replaceArtist[] =
                                                            '<span class="text-red-600 underline underline-offset-4">' .
                                                            $wordsArtist .
                                                            '</span>';
                                                    }

                                                    echo str_replace(
                                                        $highlightArtist,
                                                        $replaceArtist,
                                                        $artist->name,
                                                        $count,
                                                    );
                                                @endphp
                                            @else
                                                {{ $artist->name }}
                                            @endif
                                        </a>
                                        @php
                                            $vinyler = $artist->records->count();
                                        @endphp
                                        @if ($vinyler == 0)
                                            <p class="py-2 text-sm text-red-400 lg:text-lg">
                                                {{ $vinyler }}
                                                Vinyl{{ $vinyler == 1 ? '' : 'er' }}
                                            </p>
                                        @else
                                            <p class="py-2 text-sm text-gray-400 lg:text-lg">
                                                {{ $vinyler }}
                                                Vinyl{{ $vinyler == 1 ? '' : 'er' }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="py-2 align-top text-xs sm:px-6">
                                        @if ($vinyler >= 1)
                                            @foreach ($artist->records as $record)
                                                <p
                                                    class="inter-font pb-1 uppercase text-gray-700 antialiased sm:text-sm">
                                                    @if (!empty($search))
                                                        @php
                                                            $highlightVinyl = explode(' ', mb_strtoupper($search));
                                                            $replaceVinyl = [];
                                                            foreach ($highlightVinyl as $wordsVinyl) {
                                                                $replaceVinyl[] =
                                                                    '<span class="font-semibold text-red-600 underline underline-offset-4">' .
                                                                    $wordsVinyl .
                                                                    '</span>';
                                                            }

                                                            echo "<a href='https://www.discogs.com/search/?q=" .
                                                                urlencode($artist->name . ' ' . $record->record_name) .
                                                                "&type=release&format_exact=Vinyl' class='underline-offset-4 hover:text-blue-800 hover:underline' target='_BLANK'>" .
                                                                str_replace(
                                                                    $highlightVinyl,
                                                                    $replaceVinyl,
                                                                    mb_strtoupper($record->record_name),
                                                                    $count,
                                                                ) .
                                                                '</a>';
                                                        @endphp
                                                    @else
                                                        @php
                                                            echo "<a href='https://www.discogs.com/search/?q=" .
                                                                urlencode($artist->name . ' ' . $record->record_name) .
                                                                "&type=release&format_exact=Vinyl' class='underline-offset-4 hover:text-blue-800 hover:underline' target='_BLANK'>" .
                                                                $record->record_name .
                                                                '</a>';
                                                        @endphp
                                                    @endif
                                                </p>
                                            @endforeach
                                        @else
                                            <p class="uppercase italic text-gray-600">...</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @if ($artists->count() <= 0)
                                <tr class="border-b-2 border-slate-300 bg-white lg:border-l-2 lg:border-r-2">
                                    <td
                                        colspan="2"
                                        class="px-2 py-4 text-center align-top text-base text-gray-900 sm:px-6 sm:text-lg"
                                    >
                                        <p>Sökord gav inga träffar...</p>
                                        @auth
                                            <div class="mt-4 flex items-center justify-center">
                                                <a
                                                    class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-center font-semibold text-gray-900 shadow-md hover:text-green-700 max-sm:w-full"
                                                    href="/create/artist?name={{ mb_strtoupper($search) }}"
                                                >
                                                    <p>
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
                                                        </svg>
                                                        <span class="font-semibild">Ny Artist?
                                                        </span><span
                                                            class="font-normal text-green-700">{{ mb_strtoupper($search) }}</span>
                                                    </p>
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
        </div>
        @if ($loadData == true)
            <div class="py-2 sm:py-0">
                {{ $artists->onEachSide(2)->links() }}</td>
            </div>
        @endif
    </div>
