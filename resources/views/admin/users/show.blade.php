@extends('admin.layout')

@section('title', 'User Details')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white transition mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-200">User Details</h1>
            </div>
            <p class="text-gray-400">Complete profile and activity information for {{ $user->name }}</p>
        </div>

        <!-- User Profile Card -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8 border border-gray-700">
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    <div class="w-24 h-24 bg-gray-600 rounded-full flex items-center justify-center">
                        @if($user->profile_image)
                            <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover">
                        @else
                            <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                </div>
                
                <!-- Basic Info -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $user->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Email</p>
                            <p class="text-white">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Phone</p>
                            <p class="text-white">{{ $user->phone ?: 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Registration Date</p>
                            <p class="text-white">{{ $user->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Activity Statistics -->
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-2xl font-bold text-yellow-500">${{ number_format($totalDonated, 0) }}</div>
                        <div class="text-gray-400 text-sm">Total Donated</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-2xl font-bold text-green-500">{{ $completedVolunteerProjects }}</div>
                        <div class="text-gray-400 text-sm">Volunteer Projects</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-2xl font-bold text-blue-500">{{ $totalVolunteerHours }}</div>
                        <div class="text-gray-400 text-sm">Volunteer Hours</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Personal Information -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Personal Information
                </h3>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Full Name</p>
                            <p class="text-white font-medium">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Email Address</p>
                            <p class="text-white font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Phone Number</p>
                            <p class="text-white font-medium">{{ $user->phone ?: 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">City</p>
                            <p class="text-white font-medium">{{ $user->city ?: 'Not provided' }}</p>
                        </div>
                    </div>
                    
                    @if($user->address)
                    <div>
                        <p class="text-gray-400 text-sm">Address</p>
                        <p class="text-white font-medium">{{ $user->address }}</p>
                    </div>
                    @endif
                    
                    @if($user->emergency_contact || $user->emergency_phone)
                    <div class="border-t border-gray-700 pt-4 mt-4">
                        <h4 class="text-lg font-medium text-white mb-3">Emergency Contact</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-sm">Contact Name</p>
                                <p class="text-white font-medium">{{ $user->emergency_contact ?: 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Contact Phone</p>
                                <p class="text-white font-medium">{{ $user->emergency_phone ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Academic Information -->
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Academic Information
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm">Student ID</p>
                        <p class="text-white font-medium">{{ $user->student_id ?: 'Not provided' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400 text-sm">Department</p>
                        <p class="text-white font-medium">{{ $user->department ?: 'Not provided' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400 text-sm">Expected Graduation Year</p>
                        <p class="text-white font-medium">{{ $user->graduation_year ?: 'Not provided' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400 text-sm">Account Status</p>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-900 text-green-200">
                            Active User
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations History -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8 border border-gray-700">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Donation History
                </div>
                <span class="text-gray-400 text-sm">{{ $donations->count() }} total donations</span>
            </h3>
            
            @if($donations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-left p-3 text-gray-300 font-medium">Date</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Campaign</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Amount</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Payment Method</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($donations as $donation)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="p-3 text-white">{{ $donation->created_at->format('M d, Y') }}</td>
                            <td class="p-3">
                                <div>
                                    <p class="text-white font-medium">{{ $donation->cause->title ?? 'N/A' }}</p>
                                    @if($donation->message)
                                    <p class="text-gray-400 text-sm">{{ Str::limit($donation->message, 50) }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3">
                                <span class="text-yellow-500 font-bold">${{ number_format($donation->amount, 2) }}</span>
                            </td>
                            <td class="p-3 text-white">{{ ucfirst($donation->payment_method ?? 'Cash') }}</td>
                            <td class="p-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $donation->status === 'completed' ? 'bg-green-900 text-green-200' : 
                                       ($donation->status === 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-400">No donations found for this user.</p>
            </div>
            @endif
        </div>

        <!-- Volunteer Activities -->
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Volunteer Activities
                </div>
                <span class="text-gray-400 text-sm">{{ $volunteers->count() }} applications</span>
            </h3>
            
            @if($volunteers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-left p-3 text-gray-300 font-medium">Date Applied</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Project</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Message</th>
                            <th class="text-left p-3 text-gray-300 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($volunteers as $volunteer)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="p-3 text-white">{{ $volunteer->created_at->format('M d, Y') }}</td>
                            <td class="p-3">
                                <div>
                                    <p class="text-white font-medium">{{ $volunteer->project->title ?? 'N/A' }}</p>
                                    @if($volunteer->project)
                                    <p class="text-gray-400 text-sm">{{ $volunteer->project->location }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3">
                                @if($volunteer->message)
                                <p class="text-gray-300 text-sm">{{ Str::limit($volunteer->message, 60) }}</p>
                                @else
                                <span class="text-gray-500">No message</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $volunteer->status === 'approved' ? 'bg-green-900 text-green-200' : 
                                       ($volunteer->status === 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                    {{ ucfirst($volunteer->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-gray-400">No volunteer activities found for this user.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .bg-gray-750 {
        background-color: rgba(31, 41, 55, 0.8);
    }
</style>
@endsection