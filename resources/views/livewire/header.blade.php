<div class="sticky top-0 z-50">
	<header class="w-full mx-auto max-w-7xl">
		<div x-data="{ open: false }">
			<div
				class="container flex items-center justify-between custom-shadow pt-4 pb-2 px-2 sm:px-4 mx-auto gradient-3 border-b-4 border-l-4 border-r-4 max-w-7xl border-slate-300 max-xl:border-l-0 xl:rounded-b-xl">
				<div class="flex justify-center text-xl font-bold text-gray-900 sm:text-2xl lg:text-3xl">
					<a href="/">
						<div class="inline-block">
							<img src="{{ asset("static/images/vinyl-laravel_logo2.webp") }}"
								class="h-[32px] md:h-[38px] lg:h-[42px] xl:h-[48px]">
						</div>
						@auth
							<x-fas-key class="menu-btn-icon-user opacity-70 md:-mt-5 md:w-6 lg:-mt-6 lg:w-7 xl:-mt-7 xl:w-8" />
						@endauth
					</a>
				</div>
				<button @click="open = ! open" class="text-slate-700 lg:hidden">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="square" stroke-linejoin="square" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
				</button>
				<div class="hidden lg:flex">
					<ul class="space-x-1 text-sm font-bold lg:flex">
						{{-- LG+ Menu --}}
						@auth
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/create/vinyl" wire:navigate.hover
									wire:current="underline underline-offset-4 decoration-2"><x-fas-file-upload
										class="menu-btn-icon text-green-800" />Ny Vinyl</a>
							</li>
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-cyan-700 hover:bg-cyan-50 hover:text-cyan-700"
									href="/create/artist" wire:navigate.hover
									wire:current="underline underline-offset-4 decoration-2"><x-fas-folder-plus
										class="menu-btn-icon text-cyan-800" />Ny Artist</a>
							</li>
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-icon text-blue-800" />Excel
									(.xls)
								</a></li>
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history" wire:navigate.hover wire:current="underline underline-offset-4 decoration-2"><x-fas-book
										class="menu-btn-icon text-yellow-800" />Historik</a>
							</li>
							<li><a class="menu-btn custom-shadow-2 bg-red-50 hover:border-red-700 hover:bg-red-50 hover:text-red-700"
									href="/logout"><x-fas-right-from-bracket class="menu-btn-icon text-red-800" />Logga Ut</a>
							</li>
						@else
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-icon text-blue-800" />Excel
									(.xls)
								</a></li>
							<li><a class="menu-btn custom-shadow-2 bg-white hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history" wire:navigate.hover wire:current="underline underline-offset-4 decoration-2"><x-fas-book
										class="menu-btn-icon text-yellow-800" />Historik</a>
							</li>
							<li><a class="menu-btn custom-shadow-2 bg-green-50 hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/login"><x-fas-right-to-bracket class="menu-btn-icon text-green-800" />Logga In</a>
							</li>
						@endauth
					</ul>
				</div>
			</div>
			<div x-cloak x-show="open" class="lg:hidden">
				<ul id="burgerMenu" class="px-4 py-4 text-sm bg-white font-bold custom-shadow">
					{{-- Dropdown Menu --}}
					@auth
						<li><a class="menu-btn-dropdown hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/create/vinyl" wire:navigate wire:current="underline underline-offset-4 decoration-2"><x-fas-file-upload
									class="menu-btn-dropdown-icon text-green-800" />NY VINYL</a></li>
						<li><a class="menu-btn-dropdown hover:border-cyan-700 hover:bg-cyan-50 hover:text-green-700 lg:hidden"
								href="/create/artist" wire:navigate wire:current="underline underline-offset-4 decoration-2"><x-fas-folder-plus
									class="menu-btn-dropdown-icon text-cyan-800" />NY
								ARTIST</a></li>
						<li><a class="menu-btn-dropdown hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-dropdown-icon text-blue-800" />EXCEL
								(.xls)
							</a></li>
						<li><a class="menu-btn-dropdown hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history" wire:navigate wire:current="underline underline-offset-4 decoration-2"><x-fas-book
									class="menu-btn-dropdown-icon text-yellow-800" />HISTORIK</a>
						</li>
						<li><a class="menu-btn-dropdown bg-red-50 hover:border-red-700 hover:bg-red-50 hover:text-red-700 lg:hidden"
								href="/logout"><x-fas-right-from-bracket class="menu-btn-dropdown-icon text-red-800" />LOGGA UT</a></li>
					@else
						<li><a class="menu-btn-dropdown hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-dropdown-icon text-blue-800" />EXCEL
								(.xls)
							</a></li>
						<li><a class="menu-btn-dropdown hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history" wire:navigate wire:current="underline underline-offset-4 decoration-2"><x-fas-book
									class="menu-btn-dropdown-icon text-yellow-800" />HISTORIK</a>
						</li>
						<li><a
								class="menu-btn-dropdown bg-green-50 hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/login"><x-fas-right-to-bracket class="menu-btn-dropdown-icon text-green-800" />LOGGA IN</a>
						</li>
					@endauth
				</ul>
			</div>
		</div>
	</header>
</div>
