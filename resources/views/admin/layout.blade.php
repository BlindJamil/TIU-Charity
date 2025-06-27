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

                <div class="hidden md:flex items-center space-x-6">
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                        <a href="{{ route('admin.causes.index') }}" class="text-gray-300 hover:text-white">Campaigns</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                        <a href="{{ route('admin.donations.index') }}" class="text-gray-300 hover:text-white">Donations</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                        <a href="{{ route('admin.projects.index') }}" class="text-gray-300 hover:text-white">Volunteer</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                        <a href="{{ route('admin.messages.index') }}" class="text-gray-300 hover:text-white">Messages</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                        <a href="{{ route('admin.admins.index') }}" class="text-gray-300 hover:text-white">Admins</a>
                    @endif
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-red-700">
                            Log Out
                        </button>
                    </form>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @if(Auth::guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                    <a href="{{ route('admin.causes.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Campaigns</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                    <a href="{{ route('admin.donations.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Donations</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Volunteer</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                    <a href="{{ route('admin.messages.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Messages</a>
                @endif
                @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                    <a href="{{ route('admin.admins.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Admins</a>
                @endif
            </div>
            <div class="pt-4 pb-3 border-t border-gray-700">
                <div class="px-2">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left bg-red-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
             <div class="bg-red-500 text-white p-4 rounded-lg mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
             @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            if(menuButton) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>