<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gray-900 text-white">
    <nav class="bg-gray-800 shadow-md sticky top-0 z-30">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-baseline">
                    <a href="#" class="text-xl font-bold text-yellow-400 tracking-wide flex items-baseline">
                        @if(Auth::guard('admin')->check())
                            <span>{{ Auth::guard('admin')->user()->name }}</span>
                            <span class="ml-1 text-xs text-gray-400 align-baseline">admin</span>
                        @else
                            <span>Admin</span>
                        @endif
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <div class="admin-inline-nav hidden xl:flex flex-wrap items-center space-x-2 xl:space-x-4 overflow-x-auto max-w-full">
                    @if(Auth::guard('admin')->check())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link whitespace-nowrap">Dashboard</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                        <a href="{{ route('admin.causes.index') }}" class="nav-link whitespace-nowrap">Campaigns</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                        <a href="{{ route('admin.donations.index') }}" class="nav-link whitespace-nowrap">Donations</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                        <a href="{{ route('admin.projects.index') }}" class="nav-link whitespace-nowrap">Volunteer</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                        <a href="{{ route('admin.messages.index') }}" class="nav-link whitespace-nowrap">Messages</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                        <a href="{{ route('admin.admins.index') }}" class="nav-link whitespace-nowrap">Admins</a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link whitespace-nowrap">Users</a>
                    @endif
                    @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_campaigns'))
                        <a href="{{ route('admin.achievements.index') }}" class="nav-link whitespace-nowrap">Achievements</a>
                    @endif
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-red-700 transition-colors whitespace-nowrap">
                            Log Out
                        </button>
                    </form>
                </div>
                <!-- Mobile menu button -->
                <div class="block xl:hidden relative">
                    <button id="mobile-menu-button" class="text-white focus:outline-none focus:text-gray-300 p-2" aria-label="Open navigation menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Panel -->
                    <div id="mobile-menu-dropdown" class="absolute right-0 mt-2 w-56 bg-gray-900 border border-gray-700 rounded-lg shadow-lg z-50 hidden">
                        <div class="py-2">
                            @if(Auth::guard('admin')->check())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Dashboard</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_campaigns'))
                                <a href="{{ route('admin.causes.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Campaigns</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_donations'))
                                <a href="{{ route('admin.donations.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Donations</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_volunteers'))
                                <a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Volunteer</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('view_messages'))
                                <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Messages</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_admins'))
                                <a href="{{ route('admin.admins.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Admins</a>
                                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Users</a>
                            @endif
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->hasPermission('manage_campaigns'))
                                <a href="{{ route('admin.achievements.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-yellow-400 rounded transition">Achievements</a>
                            @endif
                        </div>
                        <div class="border-t border-gray-700 px-4 py-2">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left bg-red-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-700 transition-colors">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8">
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

    <footer class="bg-gray-800 text-gray-400 text-center py-4 mt-auto shadow-inner">
        <div class="container mx-auto">
            &copy; {{ date('Y') }} TIU Charity Admin Panel. All rights reserved.
        </div>
    </footer>

    <style>
        .nav-link {
            @apply text-gray-300 hover:text-yellow-400 px-3 py-2 rounded-md text-sm font-medium transition-colors;
        }
        .mobile-nav-link {
            @apply text-gray-300 hover:bg-gray-600 hover:text-yellow-400 block px-3 py-2 rounded-md text-base font-medium transition-colors;
        }
        @media (max-width: 1279px) {
            .admin-inline-nav { display: none !important; }
        }
        @media (min-width: 1280px) {
            .admin-inline-nav { display: flex !important; }
        }
        #mobile-menu-dropdown {
            min-width: 200px;
            background: #181f2a;
            border-radius: 0.75rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid #232b3b;
            padding: 0.5rem 0;
        }
        #mobile-menu-dropdown a, #mobile-menu-dropdown button {
            width: 100%;
            text-align: left;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
        }
        #mobile-menu-dropdown a:last-child, #mobile-menu-dropdown button:last-child {
            margin-bottom: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const dropdown = document.getElementById('mobile-menu-dropdown');

            function closeDropdown() {
                dropdown.classList.add('hidden');
            }
            function openDropdown() {
                dropdown.classList.remove('hidden');
            }

            if(menuButton && dropdown) {
                menuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!dropdown.contains(event.target) && !menuButton.contains(event.target)) {
                        closeDropdown();
                    }
                });
                // Close dropdown when a link is clicked
                dropdown.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', closeDropdown);
                });
            }
            // Responsive: close dropdown on resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeDropdown();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>
</html>