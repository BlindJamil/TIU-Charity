<!-- resources/views/profile/dashboard.blade.php -->
@extends('profile.layout')

@section('profile-content')
<div class="text-gray-400 mb-4">
    Your profile overview and activity summary
</div>

<!-- Profile Completion Bar -->
<div class="mb-6">
    <div class="flex items-center justify-between mb-1">
        <span class="text-sm font-medium text-gray-200">Profile Completion</span>
        <span class="text-sm font-medium text-gray-300">{{ $profileCompletion }}%</span>
    </div>
    <div class="w-full bg-gray-700 rounded-full h-3.5">
        <div class="bg-yellow-400 h-3.5 rounded-full transition-all duration-500" style="width: {{ $profileCompletion }}%"></div>
    </div>
    @if($profileCompletion < 100)
        <div class="text-xs text-yellow-300 mt-2 flex items-center">
            <svg class="w-4 h-4 mr-1 text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/></svg>
            Complete your profile for a better experience.
        </div>
    @endif
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
        <p class="text-gray-400 mb-1">Campaigns Supported</p>
        <h3 class="text-2xl font-bold text-white mb-2">{{ $donatedCausesCount }}</h3>
        <a href="{{ route('cause') }}" class="text-yellow-500 hover:text-yellow-400 text-sm inline-flex items-center">
            Browse Campaigns
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