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
							<x-fas-user class="menu-btn-icon-user md:-mt-3 md:w-6 lg:-mt-3 lg:w-6 xl:-mt-6 xl:w-8" />
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
							<li><a class="menu-btn hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/create/vinyl"><x-fas-file-upload class="menu-btn-icon text-green-700" />Ny Vinyl</a></li>
							<li><a class="menu-btn hover:border-cyan-700 hover:bg-cyan-50 hover:text-cyan-700"
									href="/create/artist"><x-fas-folder-plus class="menu-btn-icon text-cyan-700" />Ny Artist</a></li>
							<li><a class="menu-btn hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-icon text-blue-700" />Excel
									(.xls)
								</a></li>
							<li><a class="menu-btn hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history"><x-fas-book class="menu-btn-icon text-yellow-700" />Historik</a>
							</li>
							<li><a class="menu-btn hover:border-red-700 hover:bg-red-50 hover:text-red-700"
									href="/logout"><x-fas-right-from-bracket class="menu-btn-icon text-red-700" />Logga Ut</a>
							</li>
						@else
							<li><a class="menu-btn hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700"
									href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-icon text-blue-700" />Excel
									(.xls)
								</a></li>
							<li><a class="menu-btn hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700"
									href="/history"><x-fas-book class="menu-btn-icon text-yellow-700" />Historik</a>
							</li>
							<li><a class="menu-btn hover:border-green-700 hover:bg-green-50 hover:text-green-700"
									href="/login"><x-fas-right-to-bracket class="menu-btn-icon text-green-700" />Logga In</a>
							</li>
						@endauth
					</ul>
				</div>
			</div>
			<div x-cloak x-show="open" class="lg:hidden">
				<ul id="burgerMenu" class="px-4 py-4 text-sm bg-white font-bold">
					{{-- Dropdown Menu --}}
					@auth
						<li><a class="menu-btn-dropdown hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/create/vinyl"><x-fas-file-upload class="menu-btn-dropdown-icon text-green-700" />Ny
								Vinyl</a></li>
						<li><a class="menu-btn-dropdown hover:border-cyan-700 hover:bg-cyan-50 hover:text-green-700 lg:hidden"
								href="/create/artist"><x-fas-folder-plus class="menu-btn-dropdown-icon text-cyan-700" />Ny
								Artist</a></li>
						<li><a class="menu-btn-dropdown hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-dropdown-icon text-blue-700" />Excel
								(.xls)
							</a></li>
						<li><a class="menu-btn-dropdown hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history"><x-fas-book class="menu-btn-dropdown-icon text-yellow-700" />Historik</a>
						</li>
						<li><a class="menu-btn-dropdown hover:border-red-700 hover:bg-red-50 hover:text-red-700 lg:hidden"
								href="/logout"><x-fas-right-from-bracket class="menu-btn-dropdown-icon text-red-700" />Logga Ut</a></li>
					@else
						<li><a class="menu-btn-dropdown hover:border-blue-700 hover:bg-blue-50 hover:text-blue-700 lg:hidden"
								href="/export/artist"><x-fas-cloud-arrow-down class="menu-btn-dropdown-icon text-blue-700" />Excel
								(.xls)
							</a></li>
						<li><a class="menu-btn-dropdown hover:border-yellow-700 hover:bg-yellow-50 hover:text-yellow-700 lg:hidden"
								href="/history"><x-fas-book class="menu-btn-dropdown-icon text-yellow-700" />Historik</a>
						</li>
						<li><a class="menu-btn-dropdown hover:border-green-700 hover:bg-green-50 hover:text-green-700 lg:hidden"
								href="/login"><x-fas-right-to-bracket class="menu-btn-dropdown-icon text-green-700" />Logga In</a>
						</li>
					@endauth
				</ul>
			</div>
		</div>
	</header>
</div>
