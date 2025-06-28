<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-gray-800 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="#" class="text-xl font-bold text-white">Admin Panel</a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-4 xl:space-x-6">
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                        <a href="{{ route('admin.causes.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Campaigns</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                        <a href="{{ route('admin.donations.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Donations</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                        <a href="{{ route('admin.projects.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Volunteer</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                        <a href="{{ route('admin.messages.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Messages</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                        <a href="{{ route('admin.admins.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Admins</a>
                    @endif
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-red-700 transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none focus:text-gray-300 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-gray-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @if(Auth::guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Dashboard</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                    <a href="{{ route('admin.causes.index') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Campaigns</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                    <a href="{{ route('admin.donations.index') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Donations</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Volunteer</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                    <a href="{{ route('admin.messages.index') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Messages</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-300 hover:bg-gray-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors">Admins</a>
                @endif
            </div>
            <div class="pt-4 pb-3 border-t border-gray-600">
                <div class="px-2">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left bg-red-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700 transition-colors">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mx-4 mt-4 rounded-lg mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
             <div class="bg-red-500 text-white p-4 mx-4 mt-4 rounded-lg mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if(menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    const isClickInsideNav = menuButton.contains(event.target) || mobileMenu.contains(event.target);
                    if (!isClickInsideNav && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });

                // Close mobile menu when window is resized to desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 1024) { // lg breakpoint
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>