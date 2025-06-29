@extends('admin.layout')

@section('content')
<div class="py-6 sm:py-12 bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
                    <h1 class="text-xl sm:text-2xl font-bold">Manage Volunteer Projects</h1>
                    @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                        <a href="{{ route('admin.projects.create') }}" class="w-full sm:w-auto text-center bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded font-medium">
                            Create New Project
                        </a>
                    @else
                        <button disabled class="w-full sm:w-auto bg-gray-600 text-gray-400 px-4 py-2 rounded cursor-not-allowed opacity-50" title="You don't have permission to create projects">
                            Create New Project
                        </button>
                    @endif
                </div>

                <!-- Success message -->
                @if(session('success'))
                <div class="bg-gray-800 border-l-4 border-yellow-500 text-white p-4 mb-6 rounded-md shadow-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Professional Filter Section -->
                <div class="bg-gray-700 rounded-lg shadow-lg p-4 sm:p-6 mb-6">
                    <form method="GET" action="{{ route('admin.projects.index') }}" id="filterForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                            <!-- Search Input -->
                            <div class="md:col-span-2 lg:col-span-2 xl:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-300 mb-2">Search</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           id="search" 
                                           value="{{ request('search') }}" 
                                           placeholder="Search by title, location or description..."
                                           class="w-full pl-10 pr-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Department Filter -->
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-300 mb-2">Department</label>
                                <select name="department" 
                                        id="department" 
                                        class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <option value="">All Departments</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                            {{ $dept }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="project_status" class="block text-sm font-medium text-gray-300 mb-2">Project Status</label>
                                <select name="project_status" 
                                        id="project_status" 
                                        class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <option value="">All Status</option>
                                    <option value="upcoming" {{ request('project_status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="ongoing" {{ request('project_status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ request('project_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <!-- Date Range Filter -->
                            <div>
                                <label for="date_range" class="block text-sm font-medium text-gray-300 mb-2">Date Range</label>
                                <select name="date_range" 
                                        id="date_range" 
                                        class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <option value="">All Time</option>
                                    <option value="this_week" {{ request('date_range') == 'this_week' ? 'selected' : '' }}>This Week</option>
                                    <option value="this_month" {{ request('date_range') == 'this_month' ? 'selected' : '' }}>This Month</option>
                                    <option value="next_month" {{ request('date_range') == 'next_month' ? 'selected' : '' }}>Next Month</option>
                                    <option value="last_month" {{ request('date_range') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="flex flex-col sm:flex-row gap-2 mt-4">
                            <button type="submit" 
                                    class="w-full sm:w-auto px-4 py-2 bg-yellow-500 text-black rounded-md hover:bg-yellow-600 transition font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                            @if(request()->hasAny(['search', 'department', 'project_status', 'date_range']))
                                <a href="{{ route('admin.projects.index') }}" 
                                   class="w-full sm:w-auto text-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 transition">
                                    Clear Filters
                                </a>
                            @endif
                        </div>

                        <!-- Active Filters Display -->
                        @if(request()->hasAny(['search', 'department', 'project_status', 'date_range']))
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="text-sm text-gray-400">Active filters:</span>
                                @if(request('search'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-600 text-yellow-400">
                                        Search: {{ request('search') }}
                                        <a href="{{ route('admin.projects.index', array_diff_key(request()->all(), ['search' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(request('department'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-600 text-yellow-400">
                                        Department: {{ request('department') }}
                                        <a href="{{ route('admin.projects.index', array_diff_key(request()->all(), ['department' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(request('project_status'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-600 text-yellow-400">
                                        Status: {{ ucfirst(str_replace('_', ' ', request('project_status'))) }}
                                        <a href="{{ route('admin.projects.index', array_diff_key(request()->all(), ['project_status' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
                                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                                @if(request('date_range'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-600 text-yellow-400">
                                        Date: {{ ucfirst(str_replace('_', ' ', request('date_range'))) }}
                                        <a href="{{ route('admin.projects.index', array_diff_key(request()->all(), ['date_range' => ''])) }}" class="ml-2 text-gray-400 hover:text-white">
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
                    Showing {{ $projects->count() }} {{ Str::plural('project', $projects->count()) }}
                </div>

                <!-- Mobile Cards View -->
                <div class="block xl:hidden space-y-4">
                    @forelse($projects as $project)
                        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <div class="p-4">
                                <!-- Project Header -->
                                <div class="flex items-start space-x-3 mb-4">
                                    <div class="h-12 w-12 flex-shrink-0">
                                        @if($project->image)
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ asset('storage/' . $project->image) }}" 
                                                 alt="{{ $project->title }}"
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/img/donation1.jpg') }}';">
                                        @else
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ asset('assets/img/donation1.jpg') }}" 
                                                 alt="{{ $project->title }}">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-medium text-white truncate">{{ $project->title }}</h3>
                                        <p class="text-sm text-gray-400">{{ $project->location }}</p>
                                    </div>
                                </div>

                                <!-- Project Details Grid -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-400">Department</p>
                                        <p class="text-sm text-white">{{ $project->department ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400">Volunteers</p>
                                        <p class="text-sm text-white">{{ $project->volunteers->count() ?? 0 }} / {{ $project->volunteers_needed }}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-xs text-gray-400">Dates</p>
                                        <p class="text-sm text-white">
                                            {{ date('M d, Y', strtotime($project->start_date)) }} - {{ date('M d, Y', strtotime($project->end_date)) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                        <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                           class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-2 rounded text-sm font-medium transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this project?')"
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium transition">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded text-sm cursor-not-allowed opacity-50">Edit</button>
                                        <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded text-sm cursor-not-allowed opacity-50">Delete</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-700 rounded-lg p-8 text-center">
                            <p class="text-gray-400 mb-4">No projects found.</p>
                            @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                <a href="{{ route('admin.projects.create') }}" class="text-yellow-500 hover:text-yellow-300">Create one</a>.
                            @else
                                <span class="text-gray-500">Create one</span>.
                            @endif
                        </div>
                    @endforelse
                </div>

                <!-- Desktop Table View -->
                <div class="hidden xl:block bg-gray-700 rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Department</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Volunteers</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-600">
                                @forelse($projects as $project)
                                    <tr class="hover:bg-gray-650 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    @if($project->image)
                                                        <img class="h-10 w-10 rounded-full object-cover" 
                                                             src="{{ asset('storage/' . $project->image) }}" 
                                                             alt="{{ $project->title }}"
                                                             onerror="this.onerror=null; this.src='{{ asset('assets/img/donation1.jpg') }}';">
                                                    @else
                                                        <img class="h-10 w-10 rounded-full object-cover" 
                                                             src="{{ asset('assets/img/donation1.jpg') }}" 
                                                             alt="{{ $project->title }}">
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $project->title }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $project->department ?: '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">{{ date('M d, Y', strtotime($project->start_date)) }}</div>
                                            <div class="text-sm text-gray-400">to {{ date('M d, Y', strtotime($project->end_date)) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">{{ $project->location }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-white">{{ $project->volunteers->count() ?? 0 }} / {{ $project->volunteers_needed }}</div>
                                            <div class="w-full bg-gray-600 rounded-full h-2 mt-1">
                                                <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ min(100, ($project->volunteers->count() / $project->volunteers_needed) * 100) }}%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                                    <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                                       class="text-yellow-500 hover:text-yellow-300 transition">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-500 hover:text-red-300 transition" 
                                                                onclick="return confirm('Are you sure you want to delete this project?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <button disabled class="text-gray-500 cursor-not-allowed opacity-50">Edit</button>
                                                    <button disabled class="text-gray-500 cursor-not-allowed opacity-50">Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-400">
                                            No projects found.
                                            @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                                <a href="{{ route('admin.projects.create') }}" class="text-yellow-500 hover:text-yellow-300 ml-1">Create one</a>.
                                            @else
                                                <span class="text-gray-500">Create one</span>.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection