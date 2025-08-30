<div class="mx-auto mt-4 max-w-screen-xl pb-2 text-center">
	@section("page-title", "Ny Artist")
	<div
		class="custom-shadow border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white px-4 pt-4 max-xl:border-l-0 max-xl:border-r-0 xl:rounded-xl">
		<h1 class="mb-4 mt-2 text-center text-2xl font-bold text-gray-900 sm:text-3xl">
			Ny Artist
		</h1>
		<form wire:submit="save">
			<p>
				<label for="name" class="px-2">Skriv namn på Artist:</label>
			</p>
			<input wire:model="name"
				type="text"
				name="name"
				id="name"
				class="mt-2 w-full border-2 border-slate-300 p-2 outline-none sm:w-2/6 sm:rounded-lg"
				placeholder="Namn på artist här..."
				autocomplete="off">
			@error("name")
				<p class="px-2 pt-1 font-semibold text-red-500">{{ $errors->first("name") }}</p>
			@enderror
			<p>
				<button type="submit"
					id="subBtn"
					class="mt-2 w-full whitespace-nowrap rounded-lg border-2 border-slate-300 bg-slate-100 p-4 font-semibold shadow-md outline-none hover:bg-slate-300 sm:w-2/6"><svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24"
						stroke-width="1.5"
						stroke="currentColor"
						class="-mt-1 mr-2 inline-block h-7 w-7 text-cyan-700">
						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
					</svg>Lägg till Artist
				</button>
			</p>
			<x-button-group />
		</form>
	</div>
</div>
