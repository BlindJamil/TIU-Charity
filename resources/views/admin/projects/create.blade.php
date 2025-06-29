@extends('admin.layout')

@section('content')
<div class="py-6 sm:py-12 bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                    <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-0">Create Volunteer Project</h1>
                    <a href="{{ route('admin.projects.index') }}" class="text-yellow-500 hover:text-yellow-300 text-sm">
                        ← Back to Projects
                    </a>
                </div>
                
                <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                            <div class="lg:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Project Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="lg:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                          class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-300 mb-2">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('start_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-300 mb-2">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('end_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="volunteers_needed" class="block text-sm font-medium text-gray-300 mb-2">Volunteers Needed</label>
                                <input type="number" name="volunteers_needed" id="volunteers_needed" value="{{ old('volunteers_needed') }}" required min="1"
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('volunteers_needed')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-300 mb-2">Department</label>
                                <input type="text" name="department" id="department" value="{{ old('department') }}"
                                       class="w-full border border-gray-600 rounded-md shadow-sm py-2 px-3 bg-gray-700 text-white focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                @error('department')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="lg:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Project Image</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-yellow-500 hover:file:bg-gray-500">
                                <p class="text-xs text-gray-400 mt-1">Recommended size: 800x600 pixels</p>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6 flex flex-col sm:flex-row sm:justify-between">
                            <button type="submit" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-6 py-2 rounded-md transition-colors">
                                Create Project
                            </button>
                            <a href="{{ route('admin.projects.index') }}" class="w-full sm:w-auto mt-3 sm:mt-0 text-center bg-gray-600 hover:bg-gray-500 text-white px-6 py-2 rounded-md transition-colors">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection