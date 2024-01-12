@section('page-title')
    Lägg till Vinyl
@endsection
<div class="mx-auto max-w-screen-xl text-center pb-2">
    <div
        class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
        <h1 class="text-2xl mt-2 mb-4 text-center font-bold text-gray-900 sm:text-3xl">
            Ny Vinyl
        </h1>
        <form wire:submit="save">
            <p>
                <select wire:model="artist_id" name="artist_id" id="artist_id"
                    class="p-2 mt-2 mb-4 sm:w-2/6 border-2 border-slate-300 outline-none w-full sm:rounded-lg">
                    <option value="0" selected> -- Välj en Artist -- </option>
                    @foreach ($artists as $artist)
                        <option wire:key="{{ $artist->id }}" value="{{ $artist->id }}">
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
                @error('artist_id')
                <p class="px-2 pt-1 pb-1 text-red-500">Välj en Artist...</p>
            @enderror
            </p>
            <p>
                <label for="record_name" class="px-2">Skriv namn på Vinyl:</label>
            </p>
            <input wire:model="record_name" type="text" name="record_name" id="record_name"
                class="p-2 mt-2 w-full sm:w-2/6 border-2 border-slate-300 outline-none sm:rounded-lg"
                placeholder="Namn på vinyl här..." autocomplete="off">
            @error('record_name')
                <p class="px-2 pt-1 text-red-500">Tomt namn...</p>
            @enderror
            <p>
                <button type="submit" id="subBtn"
                    class="p-4 mt-2 font-semibold shadow-md w-full whitespace-nowrap sm:w-2/6 border-2 border-slate-300 outline-none rounded-lg bg-slate-100 hover:bg-slate-300"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="inline-block -mt-1 mr-2 w-7 h-7 text-green-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>Lägg till Vinyl
                </button>
            </p>
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
        </form>
    </div>
</div>
