@section('page-title')
    Historik
@endsection
<div wire:init="init" class="mx-auto max-w-screen-xl text-left mt-4">
    <div
        class="bg-white rounded-lg shadow-xl border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <div class="flex justify-center items-center">
            <div wire:loading class="py-8">
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
        </div>
        @if ($loadData == true)
            <div class="flex justify-center items-center">
                <p
                    class="bg-slate-100 text-center rounded-md border-2 border-red-300 py-1 text-red-800 text-xs lg:text-sm w-full lg:w-1/2">
                    Vinyler Med Okänt Datum: <span class="font-semibold">{{ $vinyler_old }}</span>
                </p>
            </div>
            @php
                $setDate = date('Y-m-d');
                $sameDay = 1;
            @endphp
            @foreach ($vinyler as $vinyl)
                @if ($setDate != date('Y-m-d', strtotime($vinyl->created_at)) || $sameDay == 1)
                    <div class="flex justify-center items-center">
                        <div
                            class="bg-slate-100 rounded-lg border-2 border-slate-300 text-center text-lg lg:text-xl my-4 py-1 lg:py-2 w-full lg:w-1/2">
                            <p class="font-semibold">{{ date('j/n', strtotime($vinyl->created_at)) }}</p>
                            <p class="text-xs lg:text-sm font-semibold text-gray-500">
                                {{ date('Y', strtotime($vinyl->created_at)) }}</p>
                        </div>
                    </div>
                    @php
                        $setDate = date('Y-m-d', strtotime($vinyl->created_at));
                        $sameDay = 0;
                    @endphp
                @endif
                <p class="text-center text-sm lg:text-lg font-semibold rock-font">
                    <a class="hover:text-blue-800" href="/artist/{{ $vinyl->artist->id }}" wire:navigate>
                        {{ mb_strtoupper($vinyl->record_name) }}
                    </a>
                </p>
                <p class="text-center mb-6 text-xs lg:text-sm text-slate-800">
                    <span
                        class="text-gray-500 font-semibold">└&nbsp;&nbsp;{{ mb_strtoupper($vinyl->artist->name) }}&nbsp;&nbsp;┘</span>
                </p>
            @endforeach
        @endif
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
</div>
