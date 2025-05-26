<div class="sticky top-0 z-50">
	<header class="w-full mx-auto max-w-7xl">
		<div x-data="{ open: false }">
			<div
				class="container flex items-center justify-between p-2 pl-2 mx-auto bg-white border-b-2 border-l-2 border-r-2 max-w-7xl border-slate-300 max-xl:border-l-0">
				<div class="flex justify-center text-xl font-bold text-gray-900 sm:text-2xl lg:text-3xl">
					<a href="/">
						<div class="inline-block">
							<img src="{{ asset("static/images/vinyl-laravel_logo2.png") }}"
								class="h-[24px] md:h-[32px] lg:h-[32px] xl:h-[48px]">
						</div>
						@auth
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
								class="items-center inline-block w-5 -mt-2 text-green-700 md:-mt-3 md:w-6 lg:-mt-3 lg:w-6 xl:-mt-6 xl:w-10">
								<path
									d="M13 14.0619V22H4C4 17.5817 7.58172 14 12 14C12.3387 14 12.6724 14.021 13 14.0619ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM17.7929 19.9142L21.3284 16.3787L22.7426 17.7929L17.7929 22.7426L14.2574 19.2071L15.6716 17.7929L17.7929 19.9142Z">
								</path>
							</svg>
						@endauth
					</a>
				</div>
				<button @click="open = !open" class="text-slate-700 lg:hidden">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="square" stroke-linejoin="square" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
				<div class="hidden lg:flex">
					<ul class="space-x-1 text-sm rock-font lg:flex">
						@auth
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/create/vinyl" wire:navigate><x-fas-file-upload
										class="inline-block text-green-700 h-6 w-6 pr-1 -mt-1" />Ny Vinyl</a></li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-cyan-700 hover:bg-cyan-50 hover:text-cyan-700"
									href="/create/artist" wire:navigate><x-fas-folder-plus
										class="inline-block text-cyan-700 h-6 w-6 pr-1 -mt-1" />Ny Artist</a></li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="inline-block text-blue-700 h-6 w-6 pr-1 -mt-1" />Excel
									(.xls)
								</a></li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history" wire:navigate><x-fas-book class="inline-block text-yellow-700 h-6 w-6 pr-1 -mt-1" />Historik</a>
							</li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-red-700 hover:bg-red-50 hover:text-red-700"
									href="/logout"><x-fas-right-from-bracket class="inline-block text-red-700 h-6 w-6 pr-1 -mt-1" />Logga Ut</a>
							</li>
						@else
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="inline-block text-blue-700 h-6 w-6 pr-1 -mt-1" />Excel
									(.xls)
								</a></li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history" wire:navigate><x-fas-book class="inline-block text-yellow-700 h-6 w-6 pr-1 -mt-1" />Historik</a>
							</li>
							<li><a
									class="p-2 text-gray-900 border-2 rounded-lg border-slate-300 bg-slate-100 hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/login"><x-fas-right-to-bracket class="inline-block text-green-700 h-6 w-6 pr-1 -mt-1" />Logga In</a>
							</li>
						@endauth
					</ul>
				</div>
			</div>
			<div x-cloak x-show="open" class="lg:hidden" x-transition>
				<ul id="burgerMenu" class="px-4 py-4 text-sm bg-white rock-font">
					@auth
						<li><a
								class="block p-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/create/vinyl" wire:navigate><x-fas-file-upload class="inline-block text-green-700 h-7 w-7 pr-2 -mt-1" />Ny
								Vinyl</a></li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-cyan-700 hover:bg-cyan-50 hover:text-green-700 lg:hidden"
								href="/create/artist" wire:navigate><x-fas-folder-plus class="inline-block text-cyan-700 h-7 w-7 pr-2 -mt-1" />Ny
								Artist</a></li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="inline-block text-blue-700 h-7 w-7 pr-2 -mt-1" />Excel
								(.xls)
							</a></li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history" wire:navigate><x-fas-book class="inline-block text-yellow-700 h-7 w-7 pr-2 -mt-1" />Historik</a>
						</li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-red-700 hover:bg-red-50 hover:text-red-700 lg:hidden"
								href="/logout" wire:navigate><x-fas-right-from-bracket
									class="inline-block text-red-700 h-7 w-7 pr-2 -mt-1" />Logga Ut</a></li>
					@else
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="inline-block text-blue-700 h-7 w-7 pr-2 -mt-1" />Excel
								(.xls)
							</a></li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history" wire:navigate><x-fas-book class="inline-block text-yellow-700 h-7 w-7 pr-2 -mt-1" />Historik</a>
						</li>
						<li><a
								class="block p-2 mt-2 text-lg text-left text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/login" wire:navigate><x-fas-right-to-bracket
									class="inline-block text-green-700 h-7 w-7 pr-2 -mt-1" />Logga In</a></li>
					@endauth
				</ul>
			</div>
		</div>
	</header>
</div>
