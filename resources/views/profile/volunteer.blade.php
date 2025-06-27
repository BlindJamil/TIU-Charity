<!-- resources/views/profile/volunteer.blade.php -->
@extends('profile.layout')

@section('profile-content')
@if(count($volunteerActivities) > 0)
    <!-- Volunteer Activities Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($volunteerActivities as $activity)
        <div class="bg-[#1a2340] rounded-lg border border-gray-700 overflow-hidden">
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h4 class="text-white font-medium">{{ $activity->title }}</h4>
                    @if($activity->status == 'approved')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Approved
                        </span>
                    @elseif($activity->status == 'pending')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif($activity->status == 'rejected')
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            Rejected
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ ucfirst($activity->status) }}
                        </span>
                    @endif
                </div>
                <p class="text-gray-400 text-sm mb-3">{{ Str::limit($activity->description, 100) }}</p>
                <div class="text-xs text-gray-500">
                    Applied on {{ \Carbon\Carbon::parse($activity->created_at)->format('M d, Y') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <!-- No Volunteer Activities -->
    <div class="text-center py-12">
        <div class="text-gray-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <h3 class="text-xl text-white font-medium mb-2">No volunteer activities yet</h3>
        <p class="text-gray-400 mb-6">You haven't volunteered for any projects yet. Explore opportunities to make a difference with your time and skills.</p>
        <a href="{{ route('volunteer') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded transition duration-300">
            Explore Volunteer Opportunities
        </a>
    </div>
@endif
@endsection