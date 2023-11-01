<div class="mx-auto max-w-screen-xl text-left pb-2">
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
            class="p-2 mt-2 w-full sm:w-2/6 border-2 border-slate-300 outline-none sm:rounded-lg hover:bg-slate-300">
            Lägg till Artist
        </button>
    </form>
</div>