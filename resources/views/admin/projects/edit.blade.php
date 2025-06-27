@extends('admin.layout')


@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Edit Volunteer Project</h1>
                    <a href="{{ route('admin.projects.index') }}" class="text-yellow-500 hover:text-yellow-300">
                        Back to Projects
                    </a>
                </div>
                
                <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-300">Project Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
                                       class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                          class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-300">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('start_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-300">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('end_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-300">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $project->location) }}" required
                                       class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="volunteers_needed" class="block text-sm font-medium text-gray-300">Volunteers Needed</label>
                                <input type="number" name="volunteers_needed" id="volunteers_needed" value="{{ old('volunteers_needed', $project->volunteers_needed) }}" required min="1"
                                       class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('volunteers_needed')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-300">Project Image</label>
                                
                                @if($project->image)
                                    <div class="mt-2 mb-4">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="h-32 w-auto object-cover rounded-md">
                                        <p class="text-xs text-gray-400 mt-1">Current image</p>
                                    </div>
                                @endif
                                
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-yellow-500 hover:file:bg-gray-500">
                                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image</p>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md">
                                Update Project
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Volunteer Applications Section -->
                <div class="mt-12">
                    <h2 class="text-xl font-bold mb-6">Volunteer Applications</h2>
                    
                    <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-600">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Volunteer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Message</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-700 divide-y divide-gray-600">
                                @forelse($project->volunteers as $volunteer)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">{{ $volunteer->user->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $volunteer->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white">{{ $volunteer->message ?: 'No message provided' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $volunteer->status == 'approved' ? 'bg-green-900 text-green-200' : 
                                                  ($volunteer->status == 'rejected' ? 'bg-red-900 text-red-200' : 
                                                  'bg-yellow-900 text-yellow-200') }}">
                                                {{ ucfirst($volunteer->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if(auth('admin')->user()->hasPermission('manage_volunteers'))
                                                @if($volunteer->status == 'pending')
                                                    <form action="{{ route('admin.volunteers.approve', $volunteer->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-400 hover:text-green-300 mr-3">Approve</button>
                                                    </form>
                                                    
                                                    <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-400 hover:text-red-300">Reject</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.volunteers.reset', $volunteer->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-yellow-400 hover:text-yellow-300">Reset to Pending</button>
                                                    </form>
                                                @endif
                                            @else
                                                @if($volunteer->status == 'pending')
                                                    <button disabled class="text-gray-500 cursor-not-allowed opacity-50 mr-3" title="You don't have permission to approve volunteers">Approve</button>
                                                    <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to reject volunteers">Reject</button>
                                                @else
                                                    <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to reset volunteer status">Reset to Pending</button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-400">
                                            No volunteer applications yet.
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