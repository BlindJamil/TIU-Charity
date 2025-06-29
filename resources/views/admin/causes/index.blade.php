@extends('admin.layout')

@section('title', 'Manage Campaigns')

@section('content')
<div class="bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-2xl sm:text-3xl font-bold">Manage Campaigns</h1>
            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                <a href="{{ route('admin.causes.create') }}" class="w-full sm:w-auto text-center bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                    + Add New Campaign
                </a>
            @else
                <button disabled class="w-full sm:w-auto bg-gray-600 text-gray-400 px-4 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to create campaigns">
                    + Add New Campaign
                </button>
            @endif
        </div>

        <!-- Professional Filter Section -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-4 sm:p-6 mb-6">
            <form method="GET" action="{{ route('admin.causes.index') }}" id="filterForm">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search</label>
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by title or description..."
                                   class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Department Filter -->
                    <div class="lg:w-64">
                        <label for="department" class="block text-sm font-medium text-gray-300 mb-2">Department</label>
                        <select name="department" 
                                id="department" 
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type Filter -->
                    <div class="lg:w-48">
                        <label for="type" class="block text-sm font-medium text-gray-300 mb-2">Campaign Type</label>
                        <select name="type" 
                                id="type" 
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Types</option>
                            <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General</option>
                            <option value="recent" {{ request('type') == 'recent' ? 'selected' : '' }}>Recent</option>
                            <option value="urgent" {{ request('type') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="lg:w-48">
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select name="status" 
                                id="status" 
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        </select>
                    </div>

                    <!-- Filter Actions -->
                    <div class="flex items-end gap-2">
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-500 text-black rounded-md hover:bg-yellow-600 transition font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter
                        </button>
                        @if(request()->hasAny(['search', 'department', 'type', 'status']))
                            <a href="{{ route('admin.causes.index') }}" 
                               class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Active Filters Display -->
                @if(request()->hasAny(['search', 'department', 'type', 'status']))
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="text-sm text-gray-400">Active filters:</span>
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-yellow-400">
                                Search: {{ request('search') }}
                                <a href="{{ route('admin.causes.index', array_diff_key(request()->all(), ['search' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('department'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-yellow-400">
                                Department: {{ request('department') }}
                                <a href="{{ route('admin.causes.index', array_diff_key(request()->all(), ['department' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('type'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-yellow-400">
                                Type: {{ ucfirst(request('type')) }}
                                <a href="{{ route('admin.causes.index', array_diff_key(request()->all(), ['type' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </span>
                        @endif
                        @if(request('status'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-700 text-yellow-400">
                                Status: {{ ucfirst(request('status')) }}
                                <a href="{{ route('admin.causes.index', array_diff_key(request()->all(), ['status' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Results count -->
        <div class="mb-4 text-sm text-gray-400">
            Showing {{ $causes->count() }} {{ Str::plural('campaign', $causes->count()) }}
        </div>

        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <!-- Mobile Cards View -->
            <div class="block lg:hidden">
                @foreach ($causes as $cause)
                    <div class="border-b border-gray-700 last:border-b-0">
                        <div class="p-4 sm:p-6">
                            <div class="flex items-start space-x-4">
                                <div class="h-16 w-16 sm:h-20 sm:w-20 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $cause->image) }}" alt="Campaign Image" class="w-full h-full rounded-md object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-medium text-white truncate">{{ $cause->title }}</h3>
                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm text-orange-400">Goal: ${{ number_format($cause->goal, 2) }}</p>
                                        <p class="text-sm text-yellow-400">Raised: ${{ number_format($cause->raised, 2) }}</p>
                                    </div>
                                    <div class="mt-3 flex flex-wrap gap-1">
                                        @if($cause->is_recent)
                                            <span class="inline-flex items-center bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
                                                Recent
                                            </span>
                                        @endif
                                        
                                        @if($cause->is_urgent)
                                            <span class="inline-flex items-center bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                                Urgent
                                            </span>
                                        @endif
                                        
                                        @if(!$cause->is_recent && !$cause->is_urgent)
                                            <span class="inline-flex items-center bg-gray-600 text-white px-2 py-1 rounded-full text-xs">
                                                General
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                    <a href="{{ route('admin.causes.edit', $cause->id) }}" class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition">Edit</a>
                                    <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to edit campaigns">Edit</button>
                                    <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to delete campaigns">Delete</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if($causes->isEmpty())
                    <div class="p-6 text-center">
                        <p class="text-gray-400 mb-4">No campaigns found.</p>
                        @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                            <a href="{{ route('admin.causes.create') }}" class="text-green-500 hover:text-green-400 font-medium">Create your first campaign</a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Image</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Title</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Department</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Goal Amount</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Raised</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($causes as $cause)
                                <tr class="border-b border-gray-600 hover:bg-gray-700 transition-colors">
                                    <td class="p-3">
                                        <img src="{{ asset('storage/' . $cause->image) }}" alt="Campaign Image" class="w-16 h-16 rounded-md object-cover">
                                    </td>
                                    <td class="p-3 text-white">{{ $cause->title }}</td>
                                    <td class="p-3 text-white">{{ $cause->department }}</td>
                                    <td class="p-3 text-orange-400 font-semibold">${{ number_format($cause->goal, 2) }}</td>
                                    <td class="p-3 text-yellow-400 font-semibold">${{ number_format($cause->raised, 2) }}</td>
                                    <td class="p-3">
                                        <div class="flex flex-wrap gap-1">
                                            @if($cause->is_recent)
                                                <span class="inline-flex items-center bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
                                                    Recent
                                                </span>
                                            @endif
                                            
                                            @if($cause->is_urgent)
                                                <span class="inline-flex items-center bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                                    Urgent
                                                </span>
                                            @endif
                                            
                                            @if(!$cause->is_recent && !$cause->is_urgent)
                                                <span class="inline-flex items-center bg-gray-600 text-white px-2 py-1 rounded-full text-xs">
                                                    General
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex space-x-2">
                                            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                                <a href="{{ route('admin.causes.edit', $cause->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition text-sm">Edit</a>
                                                <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="bg-gray-600 text-gray-400 px-3 py-1 rounded-md cursor-not-allowed opacity-50 text-sm" title="You don't have permission to edit campaigns">Edit</button>
                                                <button disabled class="bg-gray-600 text-gray-400 px-3 py-1 rounded-md cursor-not-allowed opacity-50 text-sm" title="You don't have permission to delete campaigns">Delete</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($causes->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400 mb-4">No campaigns found.</p>
                            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                <a href="{{ route('admin.causes.create') }}" class="text-green-500 hover:text-green-400 font-medium">Create your first campaign</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection