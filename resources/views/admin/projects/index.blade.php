@extends('admin.layout')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Manage Volunteer Projects</h1>
                    @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                        <a href="{{ route('admin.projects.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded">
                            Create New Project
                        </a>
                    @else
                        <button disabled class="bg-gray-600 text-gray-400 px-4 py-2 rounded cursor-not-allowed opacity-50" title="You don't have permission to create projects">
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

                <div class="bg-gray-700 rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Dates</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Volunteers</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-700 divide-y divide-gray-600">
                            @forelse($projects as $project)
                                <tr>
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
                                                @if($project->image)
                                                    <div class="text-xs text-gray-400">Image: {{ $project->image }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ date('M d, Y', strtotime($project->start_date)) }}</div>
                                        <div class="text-sm text-gray-400">to {{ date('M d, Y', strtotime($project->end_date)) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $project->location }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $project->volunteers->count() ?? 0 }} / {{ $project->volunteers_needed }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-yellow-500 hover:text-yellow-300 mr-4">Edit</a>
                                            
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                            </form>
                                        @else
                                            <button disabled class="text-gray-500 cursor-not-allowed opacity-50 mr-4" title="You don't have permission to edit projects">Edit</button>
                                            <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to delete projects">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-400">
                                        No projects found. <a href="{{ route('admin.projects.create') }}" class="text-yellow-500 hover:text-yellow-300">Create one</a>.
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
@endsection