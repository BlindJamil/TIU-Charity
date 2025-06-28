@extends('admin.layout')

@section('title', 'Add New Admin')

@section('content')
<div class="py-6 sm:py-12 bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 md:p-8 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                    <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-0">Add New Admin</h1>
                    <a href="{{ route('admin.admins.index') }}" class="text-yellow-500 hover:text-yellow-300 text-sm">
                        &larr; Back to Admin List
                    </a>
                </div>

                <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input type="password" name="password" id="password" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-3">Assign Roles</label>
                        <div class="bg-gray-700 border border-gray-600 rounded-md p-4 max-h-64 overflow-y-auto">
                            @forelse ($roles as $role)
                                <label class="flex items-start mb-4 last:mb-0 cursor-pointer hover:bg-gray-650 p-2 rounded transition-colors">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                           class="mt-1 rounded bg-gray-800 border-gray-600 text-yellow-500 focus:ring-yellow-500 mr-3 flex-shrink-0"
                                           {{ (is_array(old('roles')) && in_array($role->id, old('roles'))) ? 'checked' : '' }}>
                                    <div class="flex-grow min-w-0">
                                        <span class="text-sm text-white font-medium block">{{ $role->display_name }}</span>
                                        <p class="text-xs text-gray-400 mt-1">{{ $role->description }}</p>
                                    </div>
                                </label>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-400 italic">No roles available.</p>
                                </div>
                            @endforelse
                        </div>
                        @error('roles')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-600">
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <button type="submit" class="w-full sm:flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Create Admin User
                            </button>
                            <a href="{{ route('admin.admins.index') }}" class="w-full sm:w-auto text-center bg-gray-600 hover:bg-gray-700 text-white py-3 px-4 rounded-lg transition duration-300">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection