<!-- resources/views/profile/delete.blade.php -->
@extends('profile.layout')

@section('profile-content')
<div class="bg-red-900 bg-opacity-10 p-4 rounded-lg mb-6 border border-red-800">
    <p class="text-gray-300">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before 
        deleting your account, please download any data or information that you wish to retain.
    </p>
</div>

<form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
    @csrf
    @method('delete')
    
    <div>
        <label for="password" class="block text-sm font-medium text-white mb-1">Password</label>
        <input id="password" name="password" type="password" 
            class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" 
            placeholder="Enter your password to confirm">
        @error('password', 'userDeletion')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mt-6">
        <button type="submit" 
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-300">
            Delete Account
        </button>
    </div>
</form>
@endsection