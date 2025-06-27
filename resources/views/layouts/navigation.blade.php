<nav id="header" class="bg-gray-900 text-white fixed w-full top-0 z-50 transition-transform duration-300" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="block w-20">
                    <img src="{{ asset('assets/img/Logo_of_Tishk_International_University.png') }}" alt="TIU Logo" class="h-auto w-full">
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-white hover:text-yellow-500 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:space-x-6">
                <a href="{{ route('home') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('home') ? 'text-yellow-500' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('about') ? 'text-yellow-500' : '' }}">About</a>
                <a href="{{ route('cause') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('cause') ? 'text-yellow-500' : '' }}">Campaign</a>
                <a href="{{ route('volunteer') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('volunteer') ? 'text-yellow-500' : '' }}">Volunteer</a>
                <a href="{{ route('FAQ') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('FAQ') ? 'text-yellow-500' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-yellow-500 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out {{ request()->routeIs('contact') ? 'text-yellow-500' : '' }}">Contact</a>
                
                @auth
                <!-- User Dropdown - Desktop -->
                <div class="relative ml-3" x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false">
                    <button @click="open = !open" class="flex items-center text-yellow-500 hover:text-yellow-400 focus:outline-none">
                        <span class="font-medium text-sm">{{ Auth::user()->name }}</span>
                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                             :class="{'transform rotate-180': open}">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-150" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95" 
                         class="absolute right-0 w-48 mt-2 py-2 bg-gray-800 rounded-md shadow-xl z-50" 
                         style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <!-- Login Link -->
                <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-400 px-3 py-2 rounded-md text-sm font-medium">Sign In</a>
                @endauth
            </div>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="lg:hidden transition-all duration-300 ease-in-out" 
             style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 mt-3 border-t border-gray-700">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('home') ? 'bg-gray-800 text-yellow-500' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('about') ? 'bg-gray-800 text-yellow-500' : '' }}">About</a>
                <a href="{{ route('cause') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('cause') ? 'bg-gray-800 text-yellow-500' : '' }}">Campaign</a>
                <a href="{{ route('volunteer') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('volunteer') ? 'bg-gray-800 text-yellow-500' : '' }}">Volunteer</a>
                <a href="{{ route('FAQ') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('FAQ') ? 'bg-gray-800 text-yellow-500' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800 {{ request()->routeIs('contact') ? 'bg-gray-800 text-yellow-500' : '' }}">Contact</a>
                
                @auth
                <!-- Profile & Logout - Mobile -->
                <div class="border-t border-gray-700 pt-4 pb-3">
                    <div class="px-3">
                        <p class="text-base font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-white hover:text-yellow-500 hover:bg-gray-800">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <!-- Login Link - Mobile -->
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-yellow-500 hover:text-yellow-400 hover:bg-gray-800">Sign In</a>
                @endauth
            </div>
        </div>
    </div>
</nav>