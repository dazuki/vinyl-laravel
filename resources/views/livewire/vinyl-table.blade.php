@section('page-title')
    Samling
@endsection
<div wire:init="init" class="mx-auto max-w-screen-xl text-left">
    <div class="px-2">
        @if ($removed)
            <p class="mb-4 px-2 pt-1 text-lg font-semibold text-red-600 text-center">Artist är borttagen!</p>
        @endif
        <input wire:model.live.debounce.500ms="search" wire:keydown="resetRemoved" type="text"
            class="p-2 mt-2 mb-2 sm:mb-0 w-full shadow-lg sm:w-2/6 border-l-2 border-r-2 border-t-2 border-b-2 sm:border-b-0 border-slate-300 outline-none"
            placeholder="Sök artist..." autocomplete="off" required="">
    </div>
    <div class="relative overflow-x-auto shadow-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead
                class="border-b-2 border-t-2 lg:border-l-2 lg:border-r-2 border-slate-300 text-xs text-slate-900 bg-slate-100">
                <tr>
                    <th scope="col" class="px-2 sm:px-6 py-2 text-base whitespace-nowrap">
                        Artister: <span class="font-medium">{{ $art_count }}</span>
                    </th>
                    <th scope="col" class="px-2 pl-0 sm:px-6 py-2 text-base whitespace-nowrap">
                        Vinyler: <span class="font-medium">{{ $records }}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white lg:border-l-2 lg:border-r-2 border-slate-300 hover:bg-slate-50">
                    <td colspan="2" class="text-center">
                        <div wire:loading wire:target="search"
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
                @if ($artists->count() >= 1 && $loadData == true)
                    @foreach ($artists->get() as $artist)
                        <tr wire:key="{{ $artist->id }}"
                            class="bg-white border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300 hover:bg-slate-50">
                            <td
                                class="px-2 sm:px-6 py-4 pb-0 align-top font-semibold text-lg sm:text-xl lg:text-2xl text-gray-900">
                                <a href="/artist/{{ $artist->id }}" class="hover:text-blue-800">
                                    {{ $artist->name }}
                                </a>
                                <p class="flex justify-start">
                                    <a href="https://www.discogs.com/search/?q={{ urlencode($artist->name) }}&type=artist"
                                        class="opacity-25 pt-4 hover:opacity-100" target="_BLANK">
                                        <img src="{{ asset('static/images/Discogs-01.svg') }}" class="h-12 sm:h-14"
                                            alt="DG">
                                    </a>
                                </p>
                            </td>
                            <td class="sm:px-6 py-4 text-xs align-top">
                                @php
                                    $recordCount = 1;
                                    $vinyler = $artist->records->count();
                                @endphp
                                <p class="pb-2">
                                    <span class="text-slate-700 text-base sm:text-lg font-semibold">{{ $vinyler }}
                                        Vinyl{{ $vinyler == 1 ? '' : 'er' }}</span>
                                </p>
                                @if ($vinyler >= 1)
                                    @foreach ($artist->records as $record)
                                        <p class="pb-1 uppercase text-gray-900 sm:text-sm">
                                            {{ $record->record_name }}
                                        </p>
                                        @php
                                            $recordCount++;
                                        @endphp
                                    @endforeach
                                @else
                                    <p class="uppercase text-gray-600 italic">(Tomt)</p>
                                @endif
                                @php
                                    $recordCount = 1;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-white border-b-2 lg:border-l-2 lg:border-r-2 border-slate-300">
                        <td colspan="2"
                        class="px-2 sm:px-6 py-4 align-top text-base sm:text-lg text-gray-900 text-center">
                            @if ($loadData == false)
                                <p class="inline-block">
                                    <svg width="36" height="36" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                            opacity=".25" />
                                        <path
                                            d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
                                            <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                                values="0 12 12;360 12 12" repeatCount="indefinite" />
                                        </path>
                                    </svg>
                                </p>
                            @else
                                <p>Här var det tomt...</p>
                                @auth
                                    <div class="mt-4 flex justify-center w-full">
                                        <a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md font-semibold bg-slate-100 w-full text-center"
                                            href="/create/artist?name={{ strtoupper($search) }}">
                                            <p><span class="text-green-700">Ny Artist</span></p>
                                            <p>{{ strtoupper($search) }}</p>
                                        </a>
                                    </div>
                                @endauth
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
