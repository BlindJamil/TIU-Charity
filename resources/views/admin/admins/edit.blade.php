@extends('admin.layout')

@section('title', 'Edit Admin User')

@section('content')
<div class="py-6 sm:py-12 bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 md:p-8 text-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-6">
                    <div class="mb-4 sm:mb-0">
                        <h1 class="text-xl sm:text-2xl font-bold">Edit Admin</h1>
                        <p class="text-gray-400 text-sm mt-1">{{ $admin->name }}</p>
                    </div>
                    <a href="{{ route('admin.admins.index') }}" class="text-yellow-500 hover:text-yellow-300 text-sm">
                        &larr; Back to Admin List
                    </a>
                </div>

                @if(session('error'))
                    <div class="bg-red-900 text-red-200 p-4 mb-6 rounded-md shadow-md flex items-start">
                        <svg class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">New Password (Optional)</label>
                            <input type="password" name="password" id="password"
                                    placeholder="Leave blank to keep current password"
                                    class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Confirm if changing password"
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
                                           {{ in_array($role->id, old('roles', $assignedRoleIds)) ? 'checked' : '' }}
                                           {{ ($role->name === 'super_admin' && $admin->id === auth('admin')->id()) ? 'onclick="return false;"' : '' }}>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-white font-medium">{{ $role->display_name }}</span>
                                            @if ($role->name === 'super_admin' && $admin->id === auth('admin')->id())
                                                <span class="text-xs text-gray-500 italic ml-2 flex-shrink-0">(Cannot unassign from self)</span>
                                            @endif
                                        </div>
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
                        @error('roles.*')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-600">
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <button type="submit" class="w-full sm:flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Update Admin User
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