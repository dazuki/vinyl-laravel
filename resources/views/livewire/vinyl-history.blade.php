<div wire:init="init" class="mx-auto mt-4 max-w-screen-xl text-left">
	@section("page-title", "Historik")
	<div
		class="custom-shadow min-h-screen border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white pt-4 max-xl:border-l-0 max-xl:border-r-0 sm:px-4 xl:rounded-xl">
		<div class="flex items-center justify-center">
			<div class="relative w-full text-center max-sm:px-4 lg:w-1/2">
				<x-fas-compact-disc class="absolute bottom-3 left-3 w-8 text-slate-500 max-sm:left-8 max-sm:w-7"
					aria-labelledby="title desc" />
				<input wire:model.live.debounce.500ms="qhistory"
					name="qhistory"
					type="text"
					class="w-full border-4 border-slate-300 p-2 pl-12 text-2xl outline-none max-sm:text-xl"
					placeholder="Sök Historik..."
					autocomplete="off"
					required="">
			</div>
		</div>
		<div class="flex items-center justify-center">
			<div wire:loading class="py-8">
				<svg width="36"
					height="36"
					viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg">
					<path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25" />
					<path
						d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
						<animateTransform attributeName="transform"
							type="rotate"
							dur="0.75s"
							values="0 12 12;360 12 12"
							repeatCount="indefinite" />
					</path>
				</svg>
			</div>
		</div>
		@if ($loadData == true)
			<div>
				@auth
					<div class="flex flex-col items-center justify-center">
						<p class="flex w-full justify-center border-0 px-2 py-1 text-right text-xs text-red-800 lg:w-1/2 lg:text-sm">
							<span class="w-1/2">Vinyler Med Okänt Datum:</span><span
								class="w-1/2 px-2 text-left font-semibold">{{ $vinyler_old }}</span>
						</p>
						<p class="flex w-full justify-center px-2 py-1 text-right text-xs text-emerald-800 lg:w-1/2 lg:text-sm">
							<span class="w-1/2 text-gray-800">(Genomsnitt) Vinyler Per År:</span><span
								class="w-1/2 px-2 text-left font-semibold">{{ $vinyler_avg_year }}</span>
						</p>
						<p class="flex w-full justify-center px-2 py-1 text-right text-xs text-emerald-800 lg:w-1/2 lg:text-sm">
							<span class="w-1/2 text-gray-800">(Genomsnitt) Vinyler Per Månad:</span><span
								class="w-1/2 px-2 text-left font-semibold">{{ $vinyler_avg_month }}</span>
						</p>
					</div>
				@endauth
				@php
					$setDate = date("Y-m-d");
					$sameDay = 1;
				@endphp
				@foreach ($vinyler as $vinyl)
					@if ($setDate != date("Y-m-d", strtotime($vinyl["created_at"])) || $sameDay == 1)
						<div class="flex items-center justify-center">
							<div
								class="{{ $loop->first ? "mt-2 mb-4 " : "my-4 " }}w-full vinyl-table-bg flex items-center justify-between border-b-2 border-slate-300 py-1 text-center text-lg sm:rounded-xl lg:w-1/2 lg:py-2 lg:text-xl">
								<div class="w-1/3 font-semibold text-gray-500"></div>
								<div class="w-1/3 font-semibold">
									<p>{{ date("j/n", strtotime($vinyl["created_at"])) }}</p>
									<p class="text-gray-500">{{ $veckodagar[date("w", strtotime($vinyl["created_at"]))] }}</p>
								</div>
								<div class="w-1/3 pr-4 text-right text-sm text-gray-500">
									{{ date("Y", strtotime($vinyl["created_at"])) }}
								</div>
							</div>
						</div>
						@php
							$setDate = date("Y-m-d", strtotime($vinyl["created_at"]));
							$sameDay = 0;
						@endphp
					@endif
					<p class="rock-font text-center text-sm font-semibold lg:text-xl">
						<a class="hover:text-blue-800"
							href="/artist/{{ $vinyl["artist"]["id"] }}"
							wire:navigate>
							{{ mb_strtoupper($vinyl["record_name"]) }}
						</a>
					</p>
					<p class="mb-6 text-center text-xs text-slate-800 lg:text-sm">
						<span
							class="font-semibold text-gray-500">└&nbsp;&nbsp;{{ mb_strtoupper($vinyl["artist"]["name"]) }}&nbsp;&nbsp;┘</span>
					</p>
				@endforeach
			</div>
		@endif
	</div>
</div>
