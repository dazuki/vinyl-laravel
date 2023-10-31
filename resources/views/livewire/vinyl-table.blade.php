<div class="mx-auto max-w-screen-xl text-left">
    <div class="px-2">
        <input wire:model.live.debounce.500ms="search" type="text"
        class="p-2 mt-2 mb-2 w-full sm:w-1/4 border-2 border-slate-300 outline-none"
        placeholder="Sök artist..."
        autocomplete="off"
        required="">
    </div>
    <div class="relative overflow-x-auto">
    <table class="w-full mb-1 text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-slate-100">
            <tr>
                <th scope="col" class="px-2 sm:px-6 py-2 text-base">
                    Artister: <span class="font-medium">{{ $art_count }}</span>
                </th>
                <th scope="col" class="px-2 sm:px-6 py-2 text-base">
                    Vinyler: <span class="font-medium">{{ $records }}</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artists->get() as $artist)
            <tr wire:key="{{ $artist->id }}" class="bg-white border-b">
                <td class="px-2 sm:px-6 py-4 align-top font-semibold text-base sm:text-base text-gray-900">
                    <a href="/artist/{{ $artist->id }}" class="hover:text-blue-500">
                        {{ $artist->name }}
                    </a> <span class="text-green-600 font-medium">({{ $artist->records->count() }})</span>
                </td>
                <td class="px-2 sm:px-6 py-4 text-xs align-top">
                    @php
                        $recordCount = 1;
                    @endphp
                    @foreach ($artist->records as $record)
                        <p class="uppercase text-gray-900 hover:bg-slate-200">
                            <span class="font-semibold pr-1">{{ $recordCount }}.</span> {{ $record->record_name }}
                        </p>
                        @php
                            $recordCount++;
                        @endphp
                    @endforeach
                    @php
                        $recordCount = 1;
                    @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
