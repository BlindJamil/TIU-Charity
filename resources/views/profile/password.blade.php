<!-- resources/views/profile/password.blade.php -->
@extends('profile.layout')

@section('profile-content')
<!-- Update Password Form Content -->
<div>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')
        
        <div>
            <label for="current_password" class="block text-sm font-medium text-white mb-1">Current Password</label>
            <input id="current_password" name="current_password" type="password" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-1">New Password</label>
            <input id="password" name="password" type="password" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            @error('password', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded transition duration-300">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection