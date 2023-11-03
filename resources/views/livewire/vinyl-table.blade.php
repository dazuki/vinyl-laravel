<div class="mx-auto max-w-screen-xl text-left">
    <div class="px-2">
        @if (session('status'))
            <p class="mb-4 px-2 pt-1 text-lg font-semibold text-red-600 text-center">{{ session('status') }}</p>
        @endif
        <input wire:model.live.debounce.500ms="search" type="text"
            class="p-2 mt-2 w-full drop-shadow-lg rounded-t-lg sm:w-2/6 border-l-2 border-r-2 border-t-2 border-slate-300 outline-none" placeholder="Sök artist..."
            autocomplete="off" required="">
        <div wire:loading class="items-center">

            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="4" width="6" height="14" opacity="1">
                    <animate id="spinner_rQ7m" begin="0;spinner_2dMV.end-0.25s" attributeName="opacity" dur="0.75s"
                        values="1;.2" fill="freeze" />
                </rect>
                <rect x="9" y="4" width="6" height="14" opacity=".4">
                    <animate begin="spinner_rQ7m.begin+0.15s" attributeName="opacity" dur="0.75s" values="1;.2"
                        fill="freeze" />
                </rect>
                <rect x="17" y="4" width="6" height="14" opacity=".3">
                    <animate id="spinner_2dMV" begin="spinner_rQ7m.begin+0.3s" attributeName="opacity" dur="0.75s"
                        values="1;.2" fill="freeze" />
                </rect>
            </svg>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full mb-1 text-sm text-left text-gray-500">
            <thead class="drop-shadow-lg border-b-2 border-t-2 lg:border-l-2 lg:border-r-2 border-slate-300 text-xs text-slate-900 uppercase bg-slate-100">
                <tr>
                    <th scope="col" class="px-2 sm:px-6 py-2 text-base whitespace-nowrap">
                        Artister: <span class="font-medium">{{ $art_count }}</span>
                    </th>
                    <th scope="col" class="px-2 sm:px-6 py-2 text-base whitespace-nowrap">
                        Vinyler: <span class="font-medium">{{ $records }}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
            @if ($artists->count() >= 1)
                @foreach ($artists->get() as $artist)
                    <tr wire:key="{{ $artist->id }}" class="bg-white border-b border-slate-300 hover:bg-slate-100">
                        <td class="px-2 sm:px-6 py-4 align-top font-semibold text-base sm:text-xl text-gray-900">
                            <a href="/artist/{{ $artist->id }}" class="hover:text-blue-800">
                                {{ $artist->name }}
                            </a> <span class="text-blue-800">({{ $artist->records->count() }})</span>
                        </td>
                        <td class="px-2 sm:px-6 py-4 text-xs align-top">
                            @php
                                $recordCount = 1;
                            @endphp
                            @if ($artist->records->count() >= 1)
                                @foreach ($artist->records as $record)
                                    <p class="uppercase text-gray-900 sm:text-sm">
                                        <span class="font-semibold pr-1">{{ $recordCount }}.</span>
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
                <tr class="bg-white border-b">
                    <td class="px-2 sm:px-6 py-4 align-top italic text-base sm:text-lg text-gray-900">
                        Här var det tomt...
                    </td>
                    <td class="px-2 sm:px-6 py-4 text-xs align-top">
                        <p class="uppercase text-gray-600 italic">...</p>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
