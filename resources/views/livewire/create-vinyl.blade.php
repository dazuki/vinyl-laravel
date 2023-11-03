<div class="mx-auto max-w-screen-xl text-left pb-2 px-2">
    <h1 class="text-2xl mt-2 mb-4 text-center font-bold text-gray-900 sm:text-3xl">
        Ny Vinyl
    </h1>
    <form wire:submit="save">
        <p>
        <select wire:model="artist_id"
        name="artist_id"
        id="artist_id"
        class="p-2 mt-2 mb-4 border-2 border-slate-300 outline-none w-full sm:rounded-lg">
            <option value="0" selected> -- Välj en Artist -- </option>
            @foreach ($artists as $artist)
                <option wire:key="{{ $artist->id }}"
                    value="{{ $artist->id }}">
                    {{ $artist->name }}
                </option>
            @endforeach
        </select>
        @error('artist_id')
            <p class="px-2 pt-1 pb-1 text-red-500">Välj en Artist...</p>
        @enderror
        </p>

        <label for="record_name" class="px-2">Skriv namn på Vinyl:</label>
        <input
            wire:model="record_name"
            type="text"
            name="record_name"
            id="record_name"
            class="p-2 mt-2 w-full sm:w-5/6 border-2 border-slate-300 outline-none sm:rounded-lg"
            placeholder="Namn på vinyl här..."
            autocomplete="off">
            @error('record_name')
                <p class="px-2 pt-1 text-red-500">Tomt namn...</p>
            @enderror
        <button
            type="submit" id="subBtn"
            class="p-4 mt-2 font-semibold shadow-md w-full whitespace-nowrap sm:w-2/6 border-2 border-slate-300 outline-none rounded-lg bg-slate-100 hover:bg-slate-300">
            Lägg till Vinyl
        </button>
        <p class="mt-6 mb-6 text-center">
            <a href="/" class="rounded-lg border-2 border-slate-300 px-2 py-2 hover:bg-slate-300">
                « Tillbaka
            </a>
        </p>
    </form>
</div>
