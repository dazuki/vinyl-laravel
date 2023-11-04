@section('page-title')
    Lägg till Artist
@endsection
<div class="mx-auto max-w-screen-xl text-center pb-2">
    <div class="bg-white border-b-2 border-t-0 border-r-0 border-l-0 lg:border-t-2 lg:border-r-2 lg:border-l-2 border-slate-300 px-4 pt-4">
    <h1 class="text-2xl mt-2 mb-4 text-center font-bold text-gray-900 sm:text-3xl">
        Ny Artist
    </h1>
    <form wire:submit="save">
        <p>
            <label for="name" class="px-2">Skriv namn på Artist:</label>
        </p>
        <input
            wire:model="name"
            type="text"
            name="name"
            id="name"
            class="p-2 mt-2 w-full sm:w-2/6 border-2 border-slate-300 outline-none sm:rounded-lg"
            placeholder="Namn på artist här..."
            autocomplete="off">
            @error('name')
                <p class="px-2 pt-1 text-red-500">Tomt namn...</p>
            @enderror
        <p>
            <button
            type="submit" id="subBtn"
            class="p-4 mt-2 font-semibold shadow-md w-full whitespace-nowrap sm:w-2/6 border-2 border-slate-300 outline-none rounded-lg bg-slate-100 hover:bg-slate-300">
            Lägg till Artist
            </button>
        </p>
        <p class="mt-6 mb-6 text-center">
            <a href="/" class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300">
                « Tillbaka
            </a>
        </p>
    </form>
    </div>
</div>