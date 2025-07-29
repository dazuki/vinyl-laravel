<div wire:init="init" class="mx-auto max-w-screen-xl text-left">
	@section("page-title", "Startsidan")
	@php
		$char = "";
	@endphp
	<div class="relative z-20 pt-4">
		<x-fas-compact-disc class="absolute bottom-2 left-4 w-8 text-slate-500 max-sm:left-4 max-sm:w-6"
			aria-labelledby="title desc" />
		<input wire:model.live.debounce.500ms="search"
			name="search"
			type="text"
			class="gradient-3 z-1 custom-shadow w-full border-l-4 border-r-4 border-t-4 border-slate-300 p-2 pl-14 text-2xl outline-none max-xl:border-l-0 max-xl:border-r-0 max-sm:pl-12 max-sm:text-base xl:rounded-t-xl"
			placeholder="Sök Artister/Vinyler..."
			autocomplete="off"
			required="">
	</div>
	@if ($loadData == true)
		<div class="relative z-10">
			<table
				class="custom-shadow w-full border-b-4 border-l-4 border-r-4 border-t-0 border-slate-300 text-left text-sm text-gray-500 max-xl:border-l-0 max-xl:border-r-0">
				<thead class="border-b-0 border-l-0 border-r-0 border-t-0 border-slate-300 bg-white text-xs text-slate-900">
					<tr>
						<th scope="col" class="w-1/2 whitespace-nowrap px-2 pb-2 pt-4 text-base antialiased sm:px-6 sm:text-xl">
							@if ($loadData == true)
								Artister: <span class="text-base font-semibold text-green-800 sm:text-xl">{{ $art_count }}</span>
							@endif
						</th>
						<th scope="col" class="w-1/2 whitespace-nowrap px-2 pb-2 pl-0 pt-4 text-base antialiased sm:text-xl">
							@if ($loadData == true)
								Vinyler: <span class="text-base font-semibold text-green-800 sm:text-xl">{{ $records }}</span>
							@endif
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="border-slate-300 bg-white hover:bg-slate-50">
						<td colspan="2" class="bg-white text-center">
							<div wire:loading class="inline-block px-2 py-4 align-top text-base text-gray-900 sm:px-6 sm:text-lg">
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
								<span class="sr-only">Laddar...</span>
							</div>
						</td>
					</tr>
					@if ($loadData == true)
						@if (!empty($search) && $artists->count() >= 1)
							<tr class="border-b border-dashed border-slate-300 bg-sky-50">
								<td colspan="2"
									class="border-t border-slate-300 px-2 py-2 text-left text-sm text-gray-900 sm:px-6 sm:text-base">
									<p>
										Sökord -> "<span class="font-semibold text-red-600">{{ mb_strtoupper($search) }}</span>"
									</p>
									<p><span
											class="{{ $searchCountArtist > 0 ? "font-semibold text-gray-900 underline " : "" }}underline-offset-2">{{ $searchCountArtist }}</span>
										Artist{{ $searchCountArtist == 1 ? "" : "er" }} och <span
											class="{{ $searchCountRecord > 0 ? "font-semibold text-gray-900 underline " : "" }}underline-offset-2">{{ $searchCountRecord }}</span>
										Vinyl{{ $searchCountRecord == 1 ? "" : "er" }}
										({{ $searchCountArtist + $searchCountRecord }} totalt)</p>
								</td>
							</tr>
						@endif

						{{-- <ARTISTER> --}}
						@if ($artists->count() >= 1)
							@foreach ($artists as $artist)
								@if (empty($char) || $char != mb_substr($artist->name, 0, 1))
									<tr wire:key="char-{{ $char }}" class="border-b-2 border-t-2 border-slate-300 bg-slate-200">
										<td colspan="2"
											class="rock-font p-2 py-0 text-left text-lg font-bold text-slate-500 sm:px-6 sm:text-xl lg:text-xl">
											{{ mb_substr($artist->name, 0, 1) }}</td>
									</tr>
								@endif
								@php
									$char = mb_substr($artist->name, 0, 1);
									$vinyler = $artist->records->count();
								@endphp
								<tr wire:key="artist-{{ $artist->id }}"
									class="transition-color {{ !$vinyler ? "bg-red-50 hover:bg-red-100" : "bg-slate-50 hover:bg-slate-200" }} border-b border-slate-300 duration-200">
									<td class="align-top text-2xl text-gray-700 sm:px-6 sm:text-2xl lg:text-3xl">
										<a href="/artist/{{ $artist->id }}"
											class="rock-font block border-white py-2 pl-2 antialiased hover:text-cyan-800 max-sm:pl-0 max-sm:text-center"
											wire:navigate>
											@if (!empty($search))
												@php
													$highlightArtist = explode(" ", mb_strtoupper($search));
													$replaceArtist = [];
													foreach ($highlightArtist as $wordsArtist) {
													    $replaceArtist[] =
													        '<span class="text-red-600 underline underline-offset-4">' . $wordsArtist . "</span>";
													}

													echo str_replace($highlightArtist, $replaceArtist, $artist->name, $count);
												@endphp
											@else
												{{ $artist->name }}
											@endif
										</a>
										@if ($vinyler == 0)
											<p class="py-2 pb-4 text-sm text-red-400 lg:text-base">
												<span class="font-semibold">{{ $vinyler }}</span>
												Vinyl{{ $vinyler == 1 ? "" : "er" }}
											</p>
										@else
											<p class="vinyler-text-color py-2 pb-4 text-sm max-sm:px-0 max-sm:text-center lg:text-base">
												<span class="font-semibold">{{ $vinyler }}</span>
												Vinyl{{ $vinyler == 1 ? "" : "er" }}
											</p>
										@endif
									</td>
									<td class="{{ !$vinyler ? "bg-red-50" : "bg-white" }} border-l border-slate-300 align-top text-xs">
										{{-- <VINYLER> --}}

										{{-- <BILD> --}}
										@if ($artist->discogs_image_url)
											<a href="{{ $artist->discogs_url }}" target="_BLANK">
												<img src="{{ $artist->discogs_image_url }}"
													class="m-2 h-36 border-2 border-slate-300 object-cover max-sm:max-w-[170px]"
													loading="lazy" />
											</a>
										@endif
										{{-- </BILD> --}}

										@if ($vinyler >= 1)
											@foreach ($artist->records as $record)
												@php
													$discogsURL =
													    "https://www.discogs.com/search/?q=" .
													    urlencode($artist["name"] . " " . $record["record_name"]) .
													    "&type=release&format_exact=Vinyl";
												@endphp
												<p class="inter-font uppercase text-gray-700 antialiased sm:text-sm">
													<a href={{ $discogsURL }}
														target="_BLANK"
														class="block border-slate-300 p-2 transition-all duration-100 hover:border-l-2 hover:bg-slate-200 hover:font-semibold">
														@if (!empty($search))
															@php
																$highlightVinyl = explode(" ", mb_strtoupper($search));
																$replaceVinyl = [];
																foreach ($highlightVinyl as $wordsVinyl) {
																    $replaceVinyl[] =
																        '<span class="font-semibold text-red-600 underline underline-offset-4">' .
																        $wordsVinyl .
																        "</span>";
																}

																echo "<span class='font-semibold'>" .
																    $loop->iteration .
																    ".</span>&nbsp;" .
																    str_replace($highlightVinyl, $replaceVinyl, mb_strtoupper($record->record_name), $count);
															@endphp
														@else
															@php
																echo "<span class='font-semibold'>" . $loop->iteration . ".</span>&nbsp;" . $record->record_name;
															@endphp
														@endif
													</a>
												</p>
											@endforeach
										@else
											<p class="p-2 uppercase italic text-red-600"></p>
										@endif
										{{-- </VINYLER> --}}

									</td>
								</tr>
							@endforeach
						@else
							@if ($artists->count() <= 0)
								<tr class="border-b border-slate-300 bg-white lg:border-l lg:border-r">
									<td colspan="2" class="px-2 py-4 text-center align-top text-base text-gray-900 sm:px-6 sm:text-lg">
										<p>Sökord gav inga träffar...</p>
										@auth
											<div class="mt-4 flex items-center justify-center">
												<a
													class="rounded-lg border-2 border-slate-300 bg-slate-100 p-2 text-center font-semibold text-gray-900 shadow-md hover:text-green-700 max-sm:w-full"
													href="/create/artist?name={{ mb_strtoupper($search) }}">
													<p>
														<svg xmlns="http://www.w3.org/2000/svg"
															fill="none"
															viewBox="0 0 24 24"
															stroke-width="1.5"
															stroke="currentColor"
															class="-mt-1 inline-block h-7 w-7 pr-1 text-cyan-700">
															<path stroke-linecap="round"
																stroke-linejoin="round"
																d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
														</svg>
														<span class="font-semibild">Ny Artist?
														</span><span class="font-normal text-green-700">{{ mb_strtoupper($search) }}</span>
													</p>
												</a>
											</div>
										@endauth
									</td>
								</tr>
							@endif
						@endif
					@endif
					{{-- </ARTISTER> --}}

				</tbody>
			</table>
			@if ($loadData == true)
				<div class="z-10 py-2 sm:py-0">
					{{ $artists->onEachSide(2)->links() }}</td>
				</div>
			@endif
		</div>
	@else
		<div
			class="items-top flex min-h-screen w-full justify-center border-b border-l border-r border-slate-300 bg-white px-2 py-4 align-top text-base text-gray-900 max-xl:border-l-0 max-xl:border-r-0">
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
			<span class="sr-only">Laddar...</span>
		</div>
	@endif
</div>
