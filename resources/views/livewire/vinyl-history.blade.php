@section('page-title')
    Historik
@endsection
<div wire:init="init" class="max-w-screen-xl mx-auto mt-4 text-left">
    <div
        class="px-4 pt-4 bg-white border-t-0 border-b-2 border-l-0 border-r-0 rounded-lg shadow-xl lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300">
        <div class="flex items-center justify-center">
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
            <div wire:transition.opacity>
                <div class="flex items-center justify-center">
                    <p
                        class="w-full py-1 text-xs text-center text-red-800 border-2 border-red-300 rounded-md bg-slate-100 lg:text-sm lg:w-1/2">
                        Vinyler Med Okänt Datum: <span class="font-semibold">{{ $vinyler_old }}</span>
                    </p>
                </div>
                @php
                    $setDate = date('Y-m-d');
                    $sameDay = 1;
                @endphp
                @foreach ($vinyler as $vinyl)
                    @if ($setDate != date('Y-m-d', strtotime($vinyl->created_at)) || $sameDay == 1)
                        <div class="flex items-center justify-center">
                            <div
                                class="w-full py-1 my-4 text-lg text-center border-2 rounded-lg bg-slate-100 border-slate-300 lg:text-xl lg:py-2 lg:w-1/2">
                                <p class="font-semibold">{{ date('j/n', strtotime($vinyl->created_at)) }}</p>
                                <p class="text-xs font-semibold text-gray-500 lg:text-sm">
                                    {{ date('Y', strtotime($vinyl->created_at)) }}</p>
                            </div>
                        </div>
                        @php
                            $setDate = date('Y-m-d', strtotime($vinyl->created_at));
                            $sameDay = 0;
                        @endphp
                    @endif
                    <p class="text-sm font-semibold text-center lg:text-lg rock-font">
                        <a class="hover:text-blue-800" href="/artist/{{ $vinyl->artist->id }}" wire:navigate>
                            {{ mb_strtoupper($vinyl->record_name) }}
                        </a>
                    </p>
                    <p class="mb-6 text-xs text-center lg:text-sm text-slate-800">
                        <span
                            class="font-semibold text-gray-500">└&nbsp;&nbsp;{{ mb_strtoupper($vinyl->artist->name) }}&nbsp;&nbsp;┘</span>
                    </p>
                @endforeach
            </div>
        @endif
        {{-- <p class="mt-6 mb-6 text-center">
            <a href="/"
                class="px-2 py-2 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:bg-slate-300"
                wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="inline-block w-5 h-5 mr-1 -mt-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>Startsidan
            </a>
        </p> --}}
    </div>
</div>
