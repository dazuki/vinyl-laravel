<div class="mx-auto max-w-screen-xl text-left pb-2 px-2">
    <h1 class="text-2xl mt-2 mb-4 text-center font-bold text-gray-900 sm:text-3xl">
        Ny Artist
    </h1>
    <form wire:submit="save">
        <label for="name" class="px-2">Skriv namn på Artist:</label>
        <input
            wire:model="name"
            type="text"
            name="name"
            id="name"
            class="p-2 mt-2 w-full sm:w-5/6 border-2 border-slate-300 outline-none sm:rounded-lg"
            placeholder="Namn på artist här..."
            autocomplete="off">
            @error('name')
                <p class="px-2 pt-1 text-red-500">Tomt namn...</p>
            @enderror
        <button
            type="submit" id="subBtn"
            class="p-4 mt-2 font-semibold shadow-md w-full whitespace-nowrap sm:w-2/6 border-2 border-slate-300 outline-none rounded-lg bg-slate-100 hover:bg-slate-300">
            Lägg till Artist
        </button>
        <p class="mt-6 mb-6 text-center">
            <a href="/" class="rounded-lg border-2 border-slate-300 bg-slate-100 shadow-md px-2 py-2 hover:bg-slate-300">
                « Tillbaka
            </a>
        </p>
    </form>
</div>