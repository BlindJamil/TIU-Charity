<!-- resources/views/profile/dashboard.blade.php -->
@extends('profile.layout')

@section('profile-content')
<div class="text-gray-400 mb-4">
    Your profile overview and activity summary
</div>

<div class="grid grid-cols-3 gap-6">
    <!-- Total Donated -->
    <div>
        <p class="text-gray-400 mb-1">Total Donated</p>
        <h3 class="text-2xl font-bold text-white mb-2">${{ number_format($totalDonated, 2) }}</h3>
        <a href="{{ route('profile.donations') }}" class="text-yellow-500 hover:text-yellow-400 text-sm inline-flex items-center">
            View Donations
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <!-- Causes Supported -->
    <div>
        <p class="text-gray-400 mb-1">Causes Supported</p>
        <h3 class="text-2xl font-bold text-white mb-2">{{ $donatedCausesCount }}</h3>
        <a href="{{ route('cause') }}" class="text-yellow-500 hover:text-yellow-400 text-sm inline-flex items-center">
            Browse Causes
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <!-- Volunteer Projects -->
    <div>
        <p class="text-gray-400 mb-1">Volunteer Projects</p>
        <h3 class="text-2xl font-bold text-white mb-2">{{ $volunteerProjectsCount }}</h3>
        <a href="{{ route('profile.volunteer') }}" class="text-yellow-500 hover:text-yellow-400 text-sm inline-flex items-center">
            View Activities
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
@endsection