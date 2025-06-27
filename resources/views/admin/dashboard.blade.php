@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')


<div class="p-6 bg-gray-900 min-h-screen text-white">
    <h1 class="text-3xl font-bold mb-6 text-gray-200">Admin Dashboard</h1>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Donations -->
        <div class="bg-gray-800 shadow-md rounded-lg p-6 flex flex-col items-center">
            <h2 class="text-lg font-semibold text-gray-300">Total Donations</h2>
            <p class="text-4xl font-bold text-blue-400">{{ $donationCount }}</p>
        </div>

        <!-- Total Volunteers -->
        <div class="bg-gray-800 shadow-md rounded-lg p-6 flex flex-col items-center">
            <h2 class="text-lg font-semibold text-gray-300">Total Volunteers</h2>
            <p class="text-4xl font-bold text-green-400">{{ $volunteerCount }}</p>
        </div>
    </div>

    <!-- Recent Campaigns -->
    <div class="mt-8 bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4 text-gray-300">Recent Campaigns</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-700">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="text-left p-3 border-b border-gray-600 text-gray-300">Name</th>
                        <th class="text-left p-3 border-b border-gray-600 text-gray-300">Amount</th>
                        <th class="text-left p-3 border-b border-gray-600 text-gray-300">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentDonations as $donation)
                        <tr class="border-b border-gray-700 hover:bg-gray-600 transition">
                            <td class="p-3">{{ $donation->name }}</td>
                            <td class="p-3 text-blue-400 font-semibold">${{ $donation->amount }}</td>
                            <td class="p-3">{{ $donation->created_at instanceof \DateTime ? $donation->created_at->format('d M Y') : $donation->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contact Messages Card -->
<div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 mt-6">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Contact Messages</p>
                <h3 class="text-2xl font-bold text-white">{{ $contactMessagesCount }}</h3>
            </div>
            <div class="h-16 w-16 bg-yellow-500 bg-opacity-20 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
        <div class="my-4">
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white text-sm font-medium rounded-md transition duration-150 ease-in-out">
                View All Messages
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
</div>

@endsection
