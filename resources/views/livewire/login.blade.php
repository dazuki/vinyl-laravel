@section('page-title')
    Inloggad
@endsection
<div class="mx-auto max-w-screen-xl text-left">
    <div
        class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <p class="pt-4 text-lg font-semibold text-green-600 text-center">
            Du är inloggad!
        </p>
        <p class="mt-6 mb-6 text-center">
            <a href="/"
                class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300"
                wire:navigate><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="inline-block -mt-2 mr-1 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>Startsidan
            </a>
        </p>
    </div>
</div>
