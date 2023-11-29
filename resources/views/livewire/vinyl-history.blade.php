@section('page-title')
    Historik
@endsection
<div class="mx-auto max-w-screen-xl text-left">
    <div
        class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <p class="text-center text-lg">Totalt: {{ $vinyler->count() }}st</p>
        <p class="text-center text-sm pb-4">
            (Vinyler med okänt datum: {{ $vinyler_old->count() }}st)
        </p>
        @php
            $setDate = date('Y-m-d');
            $sameDay = 1;
        @endphp
        @foreach ($vinyler as $vinyl)
            @if ($setDate != date('Y-m-d', strtotime($vinyl->created_at)) || $sameDay == 1)
                <div class="gradient-2 border border-slate-300 text-center text-xl my-4 drop-shadow-md p-2">
                    {{ date('j/n - Y', strtotime($vinyl->created_at)) }}
                </div>
                @php
                    $setDate = date('Y-m-d', strtotime($vinyl->created_at));
                    $sameDay = 0;
                @endphp
            @endif
            <p class="text-left lg:text-center text-lg font-semibold">
                <a class="hover:text-blue-800" href="/artist/{{ $vinyl->artist->id }}" wire:navigate>
                    {{ mb_strtoupper($vinyl->record_name) }}
                </a>
            </p>
            <p class="text-left lg:text-center mb-4 border-b-2 pb-2 border-dashed border-slate-200">
                {{ mb_strtoupper($vinyl->artist->name) }}</p>
        @endforeach
        <p class="mt-6 mb-6 text-center">
            <a href="/"
                class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300"
                wire:navigate>
                « Tillbaka
            </a>
        </p>
    </div>
</div>
