<div class="mx-auto px-2 max-w-screen-xl text-left pb-2">
    <h1 class="text-2xl mt-2 text-center font-bold text-gray-900 sm:text-3xl">
        {{ $artist->name }}
        @auth
        <p>
            <button id="btnEdit" class="rounded-lg border-2 border-slate-300 px-2 py-1 hover:bg-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                </svg>              
            </button>
            <button id="btnDel"
            onclick="confirm('Vill du ta bort artist {{$artist->name}}?') || event.stopImmediatePropagation()" wire:click="delete({{$artist->id}})"
            class="rounded-lg border-2 border-red-300 px-2 py-1 hover:bg-red-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
            </svg>
            </button>
        </p>
        @endauth
    </h1>
    <h2 class="mb-4 text-lg text-center font-semibold">{{ $artist->records->count() }} Vinyler</h2>
    @if (session('status'))
        <p class="mb-4 px-2 pt-1 text-lg font-semibold text-center">{{ session('status') }}</p>
    @endif
    @error('name')
        <p class="mb-4 px-2 pt-1 text-lg font-semibold text-center text-red-500">Namn kan inte vara tomt...</p>
    @enderror
    @auth
    <form wire:submit="save">
        <input
            wire:model="name"
            type="text"
            id="artist_edit"
            class="p-2 mt-2 w-full border-2 border-slate-300 outline-none hidden"
            placeholder="Skriv nytt namn här..."
            autocomplete="off">
        <button
            type="submit" id="subBtn"
            class="p-4 mt-2 mb-2 shadow-md rounded-lg bg-slate-100 font-semibold w-full border-2 border-slate-300 outline-none hover:bg-slate-300 hidden">
            Uppdatera Namn
        </button>
    </form>
    <button
        id="cancelBtn"
        class="p-2 mb-2 rounded-lg w-full items-center border-2 bg-red-100 border-red-300 outline-none hover:bg-red-300 hidden">        
        Avbryt
    </button>
    @endauth
    @php
        $count = 1;
    @endphp
    @foreach ($artist->records as $record)
        <p wire:key="{{ $record->id }}" class="px-2 py-1 text-left font-medium uppercase border-b">
            <span class="font-bold text-slate-500">{{ $count }}.
                @auth
                <button
                    onclick="confirm('Vill du ta bort vinylen {{$record->record_name}}?') || event.stopImmediatePropagation()" wire:click="recordDelete({{$record->id}})"
                    class="border-0 text-red-500 px-2 py-1 hover:bg-red-300">X</button>
                @endauth
                </span> {{ $record->record_name }}
        </p>
        @php
            $count++;
        @endphp
    @endforeach
    @auth
    <div class="mt-4 flex justify-center w-full">
        <a class="text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 shadow-md font-semibold bg-slate-100 w-full text-center" href="/create/vinyl?artist_id={{ $artist->id }}">Ny Vinyl</a>
    </div>
    @endauth
        <p class="mt-6 mb-6 text-center">
            <a href="/" class="rounded-lg border-2 border-slate-300 px-2 py-2 hover:bg-slate-300">
                « Tillbaka
            </a>
        </p>
    <script>
        const editBtn = document.querySelector("#btnEdit");
        const editField = document.querySelector("#artist_edit");
        const subBtn = document.querySelector("#subBtn");
        const cancelBtn = document.querySelector("#cancelBtn");
        const btnDel = document.querySelector("#btnDel");

        editBtn.addEventListener("click", () => {
            editField.classList.toggle("hidden");
            editBtn.classList.toggle("hidden");
            subBtn.classList.toggle("hidden");
            cancelBtn.classList.toggle("hidden");
            btnDel.classList.toggle("hidden");
        });

        cancelBtn.addEventListener("click", () => {
            editField.classList.toggle("hidden");
            editBtn.classList.toggle("hidden");
            subBtn.classList.toggle("hidden");
            cancelBtn.classList.toggle("hidden");
            btnDel.classList.toggle("hidden");
        });
    </script>
</div>
