<!-- resources/views/profile/layout.blade.php -->
@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="bg-gray-900 min-h-screen pt-24 pb-20">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left Column -->
            <div class="md:w-80">
                <!-- Profile Card -->
                <div class="bg-gray-800 rounded-lg shadow-lg mb-6 overflow-hidden p-6">
                    <div class="flex flex-col items-center">
                        <!-- Profile Image -->
                        <div class="relative mb-2 group">
                            <!-- Profile Image Display -->
                            @if($user->profile_image)
                                <div class="w-32 h-32 rounded-full border-4 border-yellow-500 overflow-hidden group relative">
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('profile-image-upload').click()">
                                        <span class="text-white text-xs font-medium">Change Photo</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-32 h-32 bg-yellow-500 rounded-full flex items-center justify-center text-4xl font-bold text-black group relative">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-full cursor-pointer" onclick="document.getElementById('profile-image-upload').click()">
                                        <span class="text-white text-xs font-medium">Add Photo</span>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Hidden File Input -->
                            <form id="profile-image-form" action="{{ route('profile.update-image') }}" method="POST" enctype="multipart/form-data" class="hidden">
                                @csrf
                                <input type="file" id="profile-image-upload" name="profile_image" onchange="document.getElementById('profile-image-form').submit()">
                            </form>
                        </div>
                        
                        <!-- Remove Photo -->
                        @if($user->profile_image)
                            <form action="{{ route('profile.remove-image') }}" method="POST" class="mb-4">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-400 hover:text-red-500 text-sm flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Remove Photo
                                </button>
                            </form>
                        @endif
                        
                        <h2 class="text-xl font-bold text-white mb-1">{{ $user->name }}</h2>
                        <p class="text-gray-400 text-sm mb-4">{{ $user->email }}</p>
                        <p class="text-gray-500 text-xs">Member since {{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="px-4 py-3 bg-gray-800 border-b border-gray-700">
                        <h3 class="text-lg font-semibold text-white">Account Settings</h3>
                    </div>
                    
                    <div class="py-2">
                        <a href="{{ route('profile.dashboard') }}" class="flex items-center px-4 py-3 {{ $activeTab == 'dashboard' ? 'bg-yellow-500 bg-opacity-10 border-l-4 border-yellow-500 text-yellow-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ $activeTab == 'dashboard' ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 {{ $activeTab == 'information' ? 'bg-yellow-500 bg-opacity-10 border-l-4 border-yellow-500 text-yellow-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ $activeTab == 'information' ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Information
                        </a>
                        
                        <a href="{{ route('profile.password.edit') }}" class="flex items-center px-4 py-3 {{ $activeTab == 'password' ? 'bg-yellow-500 bg-opacity-10 border-l-4 border-yellow-500 text-yellow-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ $activeTab == 'password' ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Update Password
                        </a>
                        
                        <a href="{{ route('profile.donations') }}" class="flex items-center px-4 py-3 {{ $activeTab == 'donations' ? 'bg-yellow-500 bg-opacity-10 border-l-4 border-yellow-500 text-yellow-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ $activeTab == 'donations' ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Donation History
                        </a>
                        
                        <a href="{{ route('profile.volunteer') }}" class="flex items-center px-4 py-3 {{ $activeTab == 'volunteer' ? 'bg-yellow-500 bg-opacity-10 border-l-4 border-yellow-500 text-yellow-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ $activeTab == 'volunteer' ? 'text-yellow-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Volunteer Activities
                        </a>
                        
                        <div class="border-t border-gray-700 mt-2 pt-2">
                            <a href="{{ route('profile.delete') }}" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-900 hover:bg-opacity-20 hover:text-red-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content Column -->
            <div class="md:flex-1">
                <!-- Content Area -->
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="px-6 py-4 bg-gray-900 border-b border-gray-700">
                        <h2 class="text-xl font-semibold text-white">
                            @if($activeTab == 'dashboard')
                                Dashboard
                            @elseif($activeTab == 'information')
                                Profile Information
                            @elseif($activeTab == 'password')
                                Update Password
                            @elseif($activeTab == 'donations')
                                Donation History
                            @elseif($activeTab == 'volunteer')
                                Volunteer Activities
                            @elseif($activeTab == 'delete')
                                Delete Account
                            @endif
                        </h2>
                    </div>
                    
                    <!-- Content Section - SIMPLIFIED to remove duplicate header -->
                    <div class="p-6">
                        @yield('profile-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection