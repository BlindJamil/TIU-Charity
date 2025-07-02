@extends('admin.layout')

@section('title', 'User Management')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold mb-2 text-gray-200">User Management</h1>
                <p class="text-gray-400">Manage and monitor registered users</p>
            </div>
            <div class="mt-4 sm:mt-0 flex gap-3">
                <a href="{{ route('admin.users.export', request()->query()) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Users</p>
                        <p class="text-2xl font-semibold text-white">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">New This Month</p>
                        <p class="text-2xl font-semibold text-white">{{ number_format($newUsersThisMonth) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Donors</p>
                        <p class="text-2xl font-semibold text-white">{{ number_format($usersWithDonations) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Volunteers</p>
                        <p class="text-2xl font-semibold text-white">{{ number_format($usersWithVolunteerWork) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search Users</label>
                        <input type="text" name="search" id="search" value="{{ $search ?? '' }}" 
                               placeholder="Search by name, email, phone, city, student ID, or department..."
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <!-- Department Filter -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-300 mb-2">Department</label>
                        <select name="department" id="department" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- City Filter -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-300 mb-2">City</label>
                        <select name="city" id="city" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">All Cities</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Graduation Year Filter -->
                    <div>
                        <label for="graduation_year" class="block text-sm font-medium text-gray-300 mb-2">Graduation Year</label>
                        <select name="graduation_year" id="graduation_year" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="">All Years</option>
                            @foreach($graduationYears as $year)
                                <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Date From -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-300 mb-2">Registered From</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    
                    <!-- Date To -->
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-300 mb-2">Registered To</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button type="submit" 
                            class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                        Clear Filters
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-gray-800 shadow-md rounded-lg border border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-lg font-semibold text-white">
                    All Users 
                    @if($search || request()->hasAny(['department', 'city', 'graduation_year', 'date_from', 'date_to']))
                        <span class="text-gray-400">(Filtered Results)</span>
                    @endif
                </h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-left p-4 text-gray-300 font-medium">User</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Contact</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Student Info</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Activity</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Registered</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center flex-shrink-0">
                                        @if($user->profile_image)
                                            <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <span class="text-white font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-white font-medium">{{ $user->name }}</h3>
                                        <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div>
                                    <p class="text-white">{{ $user->phone ?: 'N/A' }}</p>
                                    <p class="text-gray-400 text-sm">{{ $user->city ?: 'City not provided' }}</p>
                                </div>
                            </td>
                            <td class="p-4">
                                <div>
                                    <p class="text-white">{{ $user->student_id ?: 'N/A' }}</p>
                                    <p class="text-gray-400 text-sm">{{ $user->department ?: 'Department not provided' }}</p>
                                    @if($user->graduation_year)
                                        <p class="text-gray-400 text-xs">Class of {{ $user->graduation_year }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-yellow-500 font-bold text-sm">{{ $user->donations_count }}</div>
                                        <div class="text-gray-400 text-xs">Donations</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-green-500 font-bold text-sm">{{ $user->volunteers_count }}</div>
                                        <div class="text-gray-400 text-xs">Volunteer</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="text-gray-300">{{ $user->created_at->format('M d, Y') }}</span>
                                <p class="text-gray-400 text-xs">{{ $user->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="p-4">
                                <a href="{{ route('admin.users.show', $user->id) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">No users found</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        @if($search || request()->hasAny(['department', 'city', 'graduation_year', 'date_from', 'date_to']))
                                            Try adjusting your search criteria or filters
                                        @else
                                            No users have registered yet
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($users->hasPages())
            <div class="p-6 border-t border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-400">
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                    </div>
                    <div class="flex-1 flex justify-center">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-gray-750 {
        background-color: rgba(31, 41, 55, 0.8);
    }
</style>
@endsection