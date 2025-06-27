<!-- resources/views/profile/donations.blade.php -->
@extends('profile.layout')

@section('profile-content')
@if(count($donations) > 0)
    <!-- Donation History Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cause</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-[#171e37] divide-y divide-gray-700">
                @foreach($donations as $donation)
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ \Carbon\Carbon::parse($donation->created_at)->format('M d, Y') }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $donation->cause_title ?? 'General Donation' }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-yellow-500 font-medium">
                        ${{ number_format($donation->amount, 2) }}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                        @if(isset($donation->status))
                            @if($donation->status == 'completed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completed
                                </span>
                            @elseif($donation->status == 'pending')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            @endif
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <!-- No Donations -->
    <div class="text-center py-12">
        <div class="text-gray-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h3 class="text-xl text-white font-medium mb-2">No donations yet</h3>
        <p class="text-gray-400 mb-6">You haven't made any donations yet. Support a cause today to make a difference.</p>
        <a href="{{ route('cause') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded transition duration-300">
            Browse Causes
        </a>
    </div>
@endif
@endsection