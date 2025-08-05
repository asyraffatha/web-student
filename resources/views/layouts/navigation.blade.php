<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    {{-- <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a> --}}
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/LogoTA.png') }}" alt="Logo Mathporia" class="h-20">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('dashboard')">
                        {{ __('home') }}
                    </x-nav-link>
                    
                    @if(Auth::user()->isSiswa())
                    <x-nav-link :href="route('gamification.dashboard')" :active="request()->routeIs('gamification.*')">
                        🏆 {{ __('Gamifikasi') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Gamification Stats (for students) -->
                @if(Auth::user()->isSiswa())
                <div class="flex items-center space-x-4 mr-4">
                    <!-- User Badge Display -->
                    <div class="relative group">
                        <div class="flex items-center space-x-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer">
                            <div class="relative">
                                <span class="text-2xl">🏅</span>
                                @if(Auth::user()->getEarnedBadges()->count() > 0)
                                <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ Auth::user()->getEarnedBadges()->count() }}
                                </div>
                                @endif
                            </div>
                            <div class="text-sm">
                                <div class="font-bold">{{ Auth::user()->getLevelTitle() }}</div>
                                <div class="text-xs opacity-90">Level {{ Auth::user()->getLevel() }}</div>
                            </div>
                        </div>
                        
                        <!-- Badge Tooltip -->
                        <div class="absolute right-0 top-full mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-3">
                                <div class="text-sm font-semibold text-gray-800 mb-2">🏆 Badge Collection</div>
                                @if(Auth::user()->getEarnedBadges()->count() > 0)
                                    <div class="space-y-2 max-h-32 overflow-y-auto">
                                        @foreach(Auth::user()->getEarnedBadges()->take(3) as $userBadge)
                                        <div class="flex items-center space-x-2 p-2 bg-yellow-50 rounded">
                                            <span class="text-lg">{{ $userBadge->badge->icon ?? '🏅' }}</span>
                                            <div class="flex-1">
                                                <div class="text-xs font-medium text-gray-800">{{ $userBadge->badge->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $userBadge->days_since_earned }} hari lalu</div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @if(Auth::user()->getEarnedBadges()->count() > 3)
                                        <div class="text-xs text-gray-500 text-center">+{{ Auth::user()->getEarnedBadges()->count() - 3 }} badge lainnya</div>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-xs text-gray-500 text-center py-2">Belum ada badge 😢</div>
                                @endif
                                <div class="mt-2 pt-2 border-t border-gray-200">
                                    <a href="{{ route('gamification.badges') }}" class="text-xs text-blue-600 hover:text-blue-800">Lihat semua badge →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Points & Experience Display -->
                    <div class="flex items-center space-x-3">
                        <!-- Points -->
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-3 py-2 rounded-lg shadow-lg">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl">⭐</span>
                                <div>
                                    <div class="text-sm font-bold">{{ number_format(Auth::user()->getTotalPoints()) }}</div>
                                    <div class="text-xs opacity-90">Poin</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Experience -->
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white px-3 py-2 rounded-lg shadow-lg">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl">📈</span>
                                <div>
                                    <div class="text-sm font-bold">{{ number_format(Auth::user()->userPoint?->experience ?? 0) }}</div>
                                    <div class="text-xs opacity-90">XP</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress to Next Level -->
                        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-2 rounded-lg shadow-lg">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl">📈</span>
                                <div>
                                    <div class="text-sm font-bold">{{ number_format(Auth::user()->getProgressToNextLevel(), 1) }}%</div>
                                    <div class="text-xs opacity-90">Progress</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->isSiswa())
                        <x-dropdown-link :href="route('gamification.dashboard')">
                            🏆 {{ __('Dashboard Gamifikasi') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('gamification.badges')">
                            🏅 {{ __('Lencana & Pencapaian') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('gamification.leaderboard')">
                            📊 {{ __('Papan Peringkat') }}
                        </x-dropdown-link>
                        <div class="border-t border-gray-200 my-1"></div>
                        @endif
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('siswa.dashboard')" :active="request()->routeIs('siswa.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if(Auth::user()->isSiswa())
            <x-responsive-nav-link :href="route('gamification.dashboard')" :active="request()->routeIs('gamification.*')">
                🏆 {{ __('Gamifikasi') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @if(Auth::user()->isSiswa())
                <div class="font-medium text-sm text-blue-600 mt-1">
                    ⭐ {{ Auth::user()->getTotalPoints() }} poin • Level {{ Auth::user()->getLevel() }}
                </div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->isSiswa())
                <x-responsive-nav-link :href="route('gamification.dashboard')">
                    🏆 {{ __('Dashboard Gamifikasi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gamification.badges')">
                    🏅 {{ __('Lencana & Pencapaian') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('gamification.leaderboard')">
                    📊 {{ __('Papan Peringkat') }}
                </x-responsive-nav-link>
                @endif
                
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
