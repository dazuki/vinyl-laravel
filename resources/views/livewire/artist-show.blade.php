<div class="mx-auto max-w-screen-xl text-left pb-2">
    <h1 class="text-2xl mt-2 text-center font-bold text-gray-900 sm:text-3xl">
        {{ $artist->name }}
        <button id="btnEdit" class="rounded-lg border-2 border-slate-300 px-2 py-1 hover:bg-slate-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
              </svg>              
        </button>
    </h1>
    <h2 class="mb-4 text-lg text-center font-semibold">{{ $artist->records->count() }} Vinyler</h2>
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
            class="p-2 mb-2 w-full border-2 border-t-0 border-slate-300 outline-none hover:bg-slate-300 hidden">
            Uppdatera Namn
        </button>
    </form>
    @php
        $count = 1;
    @endphp
    @foreach ($artist->records as $record)
        <p class="px-2 py-1 text-left font-medium uppercase border-b">
            <span class="font-bold text-slate-500">{{ $count }}.</span> {{ $record->record_name }}
        </p>
        @php
            $count++;
        @endphp
    @endforeach
        <p class="mt-6 mb-6 text-center">
            <a href="javascript:history.back()" class="rounded-lg border-2 border-slate-300 px-2 py-2 hover:bg-slate-300">
                « Tillbaka
            </a>
        </p>
    <script>
        const editBtn = document.querySelector("#btnEdit");
        const editField = document.querySelector("#artist_edit");
        const subBtn = document.querySelector("#subBtn");

        editBtn.addEventListener("click", () => {
            editField.classList.toggle("hidden");
            editBtn.classList.toggle("hidden");
            subBtn.classList.toggle("hidden");
        });
    </script>
</div>
