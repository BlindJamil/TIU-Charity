@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-200">Admin Dashboard</h1>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-8">
            <!-- Total Donations -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 sm:p-6 flex flex-col items-center border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-blue-500 bg-opacity-20 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-sm sm:text-lg font-semibold text-gray-300 text-center">Total Donations</h2>
                <p class="text-2xl sm:text-4xl font-bold text-blue-400 mt-1">{{ $donationCount }}</p>
            </div>

            <!-- Total Volunteers -->
            <div class="bg-gray-800 shadow-md rounded-lg p-4 sm:p-6 flex flex-col items-center border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-green-500 bg-opacity-20 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-1a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <h2 class="text-sm sm:text-lg font-semibold text-gray-300 text-center">Total Volunteers</h2>
                <p class="text-2xl sm:text-4xl font-bold text-green-400 mt-1">{{ $volunteerCount }}</p>
            </div>
        </div>

        <!-- Recent Campaigns -->
        <div class="bg-gray-800 shadow-md rounded-lg border border-gray-700 overflow-hidden">
            <div class="p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6 text-gray-300">Recent Campaigns</h2>
                
                <!-- Mobile Card View -->
                <div class="block sm:hidden space-y-4">
                    @foreach ($recentDonations as $donation)
                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium text-white">{{ $donation->name }}</h3>
                                <span class="text-blue-400 font-semibold text-sm">${{ $donation->amount }}</span>
                            </div>
                            <p class="text-gray-400 text-sm">
                                {{ $donation->created_at instanceof \DateTime ? $donation->created_at->format('d M Y') : $donation->created_at }}
                            </p>
                        </div>
                    @endforeach
                    @if($recentDonations->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400">No recent donations found.</p>
                        </div>
                    @endif
                </div>

                <!-- Desktop Table View -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-700 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="text-left p-3 border-b border-gray-600 text-gray-300 text-sm font-medium">Name</th>
                                <th class="text-left p-3 border-b border-gray-600 text-gray-300 text-sm font-medium">Amount</th>
                                <th class="text-left p-3 border-b border-gray-600 text-gray-300 text-sm font-medium">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentDonations as $donation)
                                <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors">
                                    <td class="p-3 text-white">{{ $donation->name }}</td>
                                    <td class="p-3 text-blue-400 font-semibold">${{ $donation->amount }}</td>
                                    <td class="p-3 text-gray-300">{{ $donation->created_at instanceof \DateTime ? $donation->created_at->format('d M Y') : $donation->created_at }}</td>
                                </tr>
                            @endforeach
                            @if($recentDonations->isEmpty())
                                <tr>
                                    <td colspan="3" class="p-6 text-center text-gray-400">
                                        No recent donations found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Contact Messages Card -->
        <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-gray-600 transition-colors mt-6 sm:mt-8">
            <div class="p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="h-12 w-12 sm:h-16 sm:w-16 bg-yellow-500 bg-opacity-20 rounded-full flex items-center justify-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Contact Messages</p>
                            <h3 class="text-xl sm:text-2xl font-bold text-white">{{ $contactMessagesCount }}</h3>
                        </div>
                    </div>
                    
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('admin.messages.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition duration-150 ease-in-out">
                            View All Messages
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection