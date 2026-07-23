<nav x-data="{ open: false }" class="bg-white border-b border-green-100 shadow-sm relative z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo BDE -->
                <div class="shrink-0 flex items-center">
                    <!-- Charṭ: l-Lien dyal l-Logo kay-tbedel 3la 7sab chkon li connecté -->
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br {{ Auth::user()->role === 'admin' ? 'from-gray-900 to-black border border-amber-500/50' : 'from-green-500 to-green-700' }} rounded-lg flex items-center justify-center shadow-md transform transition group-hover:rotate-3">
                            <span class="text-white font-extrabold text-xs tracking-wider {{ Auth::user()->role === 'admin' ? 'text-amber-400' : '' }}">BDE</span>
                        </div>
                        <span class="font-extrabold text-xl text-gray-900 tracking-tight">
                            Events<span class="{{ Auth::user()->role === 'admin' ? 'text-amber-500' : 'text-green-600' }} text-2xl">.</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role === 'admin')
                        <!-- Lien dyal l-Admin -->
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="hover:text-amber-600 transition font-bold border-amber-500">
                            {{ __('Dashboard VIP') }}
                        </x-nav-link>
                        <!-- T9der tzid hna liens khrin dyal l-Admin bhal "Gérer les utilisateurs" -->
                    @else
                        <!-- Lien dyal l-Étudiant -->
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-green-600 transition font-medium border-green-500">
                            {{ __('Mon Espace') }}
                        </x-nav-link>
                        <x-nav-link :href="route('reservations.store')" :active="request()->routeIs('reservations.store')" class="hover:text-green-600 transition font-medium border-green-500">
                            {{ __('Mon Ticket') }}
                        </x-nav-link>
                       
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">

                        @if(Auth::user()->role === 'admin')
                            <!-- VIP ADMIN BUTTON (Fakhamat) -->
                            <button class="inline-flex items-center px-4 py-2 border border-amber-500/50 rounded-full text-sm leading-4 font-bold text-amber-400 bg-gradient-to-r from-gray-900 to-black hover:from-black hover:to-gray-900 hover:shadow-lg hover:shadow-amber-500/20 focus:outline-none transition-all ease-in-out duration-300 transform hover:scale-105 group">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-400 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-11.622 9-11.622z"></path>
                                    </svg>
                                    <div class="flex flex-col text-left">
                                        <span class="text-[9px] uppercase tracking-[0.2em] text-amber-500 font-black leading-none mb-0.5">Bureau BDE</span>
                                        <span class="text-white leading-none tracking-wide">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @else
                            <!-- STANDARD STUDENT BUTTON -->
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-gray-700 bg-white hover:text-green-600 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endif

                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->role === 'admin')
                            <div class="block px-4 py-2 text-xs text-amber-600 font-black uppercase tracking-widest bg-amber-50/50 border-b border-amber-100">
                                Espace Privé
                            </div>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')" class="{{ Auth::user()->role === 'admin' ? 'hover:bg-amber-50 hover:text-amber-700' : 'hover:bg-green-50 hover:text-green-700' }}">
                            {{ __('Mon Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="hover:bg-red-50 hover:text-red-600">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Menu dyal T-tilifon) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-green-600 hover:bg-green-50 focus:outline-none focus:bg-green-50 focus:text-green-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-b border-green-100 pb-4">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="focus:text-amber-600 focus:border-amber-500 hover:bg-amber-50 hover:text-amber-700 font-bold">
                    {{ __('Dashboard VIP') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="focus:text-green-600 focus:border-green-500 hover:bg-green-50 hover:text-green-700">
                    {{ __('Mon Espace') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 border-t border-gray-200">

            @if(Auth::user()->role === 'admin')
                <!-- VIP Mobile Header -->
                <div class="mx-4 px-4 py-3 bg-gradient-to-r from-gray-900 to-black rounded-xl shadow-lg border border-amber-500/30 flex items-center gap-3 mt-2">
                    <div class="bg-amber-500/20 p-2 rounded-full">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-11.622 9-11.622z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-black text-base text-white tracking-wide">{{ Auth::user()->name }}</div>
                        <div class="font-bold text-[10px] text-amber-500 uppercase tracking-widest">Administrateur BDE</div>
                    </div>
                </div>
            @else
                <!-- Standard Mobile Header -->
                <div class="px-4">
                    <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-green-600">{{ Auth::user()->email }}</div>
                </div>
            @endif

            <div class="mt-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="hover:bg-green-50 hover:text-green-700">
                    {{ __('Mon Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="hover:bg-red-50 hover:text-red-600 font-bold text-red-500">
                        {{ __('Se déconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
