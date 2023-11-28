@section('page-title')
    Historik
@endsection
<div class="mx-auto max-w-screen-xl text-left">
    <div
        class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <p class="text-center">Totalt: {{ $vinyler->count() }}st</p>
        <p class="text-center text-sm pb-4">
            (Vinyler med okänt datum: {{ $vinyler_old->count() }}st)
            @foreach ($vinyler as $vinyl)
                <p class="text-center text-lg font-semibold">{{ mb_strtoupper($vinyl->record_name) }}</p>
                <p class="text-center">{{ mb_strtoupper($vinyl->artist->name) }}</p>
                <p class="text-center pb-4">{{ $vinyl->created_at }}</p>
            @endforeach
        </p>
        <p class="mt-6 mb-6 text-center">
            <a href="/"
                class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300"
                wire:navigate>
                « Tillbaka
            </a>
        </p>
    </div>
</div>
