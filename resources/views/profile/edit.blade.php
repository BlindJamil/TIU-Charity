<!-- resources/views/profile/edit.blade.php -->
@extends('profile.layout')

@section('profile-content')
<!-- Profile Information Form Content -->
<div>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        
        <div>
            <label for="name" class="block text-sm font-medium text-white mb-1">Name</label>
            <input id="name" name="name" type="text" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" 
                value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
            <input id="email" name="email" type="email" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" 
                value="{{ old('email', $user->email) }}">
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded transition duration-300">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection