@extends('admin.layout')

@section('title', 'Manage Donations')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Manage Cash Donations</h1>
                    <p class="text-gray-400 mt-1">Track and manage all cash donation transactions</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-2">
                    @if(auth('admin')->user()->hasPermission('manage_donations'))
                        <a href="{{ route('admin.donations.export') }}" 
                           class="inline-flex items-center justify-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export CSV
                        </a>
                    @else
                        <button disabled 
                                class="inline-flex items-center justify-center px-4 py-2 bg-gray-700 text-gray-500 rounded-lg text-sm font-medium cursor-not-allowed opacity-50" 
                                title="You don't have permission to export data">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export CSV
                        </button>
                    @endif
                    
                    <button id="toggleFilters" 
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Filters Panel -->
        <div id="filtersPanel" class="bg-gray-800 rounded-lg p-4 sm:p-6 mb-6 border border-gray-700 {{ request()->anyFilled(['date_range', 'status', 'cause_id', 'min_amount', 'max_amount', 'payment_method']) ? '' : 'hidden' }}">
            <form action="{{ route('admin.donations.index') }}" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-4">
                    <!-- Date Range -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Date Range</label>
                        <select name="date_range" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Time</option>
                            <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                            <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                            <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select name="status" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <!-- Cause -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Campaign</label>
                        <select name="cause_id" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Campaigns</option>
                            @foreach($causes as $cause)
                                <option value="{{ $cause->id }}" {{ request('cause_id') == $cause->id ? 'selected' : '' }}>{{ $cause->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                        <select name="payment_method" class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            <option value="">All Methods</option>
                            <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="mobile_payment" {{ request('payment_method') == 'mobile_payment' ? 'selected' : '' }}>Mobile Payment</option>
                        </select>
                    </div>
                </div>

                <!-- Amount Range -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Amount Range</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="min_amount" placeholder="Min Amount" value="{{ request('min_amount') }}" 
                                   class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent placeholder-gray-400">
                            <input type="number" name="max_amount" placeholder="Max Amount" value="{{ request('max_amount') }}" 
                                   class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Filter Actions -->
                    <div class="sm:col-span-2 flex flex-col sm:flex-row justify-end gap-2">
                        <a href="{{ route('admin.donations.index') }}" 
                           class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg text-sm font-medium transition-colors text-center">
                            Clear Filters
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black rounded-lg text-sm font-medium transition-colors">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <!-- Total Donations -->
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-full bg-blue-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Donations</p>
                        <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalDonations }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-full bg-green-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Amount</p>
                        <p class="text-xl sm:text-2xl font-bold text-white">${{ number_format($totalAmount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Average Donation -->
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-full bg-yellow-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Average Donation</p>
                        <p class="text-xl sm:text-2xl font-bold text-white">${{ number_format($averageDonation, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Latest Donation -->
            <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 hover:border-gray-600 transition-colors">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 rounded-full bg-purple-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Latest Donation</p>
                        <p class="text-sm text-white">
                            {{ $latestDonation ? \Carbon\Carbon::parse($latestDonation->created_at)->diffForHumans() : 'No donations yet' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Cards View -->
        <div class="block lg:hidden space-y-4">
            @forelse($donations as $donation)
                <div class="bg-gray-800 rounded-lg p-4 sm:p-6 border border-gray-700 hover:border-gray-600 transition-colors">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="font-medium text-white text-lg">{{ $donation->name ?? 'Anonymous' }}</h3>
                            <p class="text-sm text-gray-400 mt-1">{{ $donation->email ?? 'No email provided' }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap ml-4
                            {{ $donation->status == 'completed' ? 'bg-green-900 text-green-200' : 
                              ($donation->status == 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                            {{ ucfirst($donation->status) }}
                        </span>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Amount:</span>
                            <span class="text-green-400 font-semibold">${{ number_format($donation->amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Campaign:</span>
                            <span class="text-white text-right">{{ Str::limit($donation->cause_title ?? 'Unknown Cause', 25) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Receipt #:</span>
                            <span class="text-white font-mono text-sm">{{ $donation->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Date:</span>
                            <span class="text-white">{{ date('M d, Y', strtotime($donation->created_at)) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-700">
                        <a href="{{ route('admin.donations.show', $donation->id) }}" 
                           class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            View Details
                        </a>
                        
                        @if($donation->status == 'pending' && auth('admin')->user()->hasPermission('manage_donations'))
                            <button type="button" 
                                   class="flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors status-btn" 
                                   data-donation-id="{{ $donation->id }}" 
                                   data-status="completed">
                                Complete
                            </button>
                            
                            <button type="button" 
                                   class="flex-1 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors status-btn" 
                                   data-donation-id="{{ $donation->id }}" 
                                   data-status="cancelled">
                                Cancel
                            </button>
                        @endif
                        
                        @if($donation->email && auth('admin')->user()->hasPermission('manage_donations'))
                            <button type="button" onclick="sendThankYou('{{ $donation->id }}')" 
                                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors mt-2">
                                Send Thank You Email
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="text-gray-400 text-lg">No donations found.</p>
                    <p class="text-gray-500 text-sm mt-1">Try adjusting your filters or check back later.</p>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-x-auto max-w-full">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Donor</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Campaign</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Amount</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Receipt #</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Status</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Date</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($donations as $donation)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-4 py-4 max-w-xs truncate">
                                    <div>
                                        <div class="text-sm font-medium text-white truncate">{{ $donation->name ?? 'Anonymous' }}</div>
                                        <div class="text-sm text-gray-400 truncate">{{ $donation->email ?? 'No email provided' }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 max-w-xs truncate">
                                    <div class="text-sm text-white truncate" title="{{ $donation->cause_title ?? 'Unknown Cause' }}">
                                        {{ $donation->cause_title ?? 'Unknown Cause' }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-green-400">${{ number_format($donation->amount, 2) }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white font-mono">{{ $donation->transaction_id }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $donation->status == 'completed' ? 'bg-green-900 text-green-200' : 
                                          ($donation->status == 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white">{{ date('M d, Y', strtotime($donation->created_at)) }}</div>
                                    <div class="text-sm text-gray-400">{{ date('h:i A', strtotime($donation->created_at)) }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center space-x-2 min-w-[70px]">
                                        <!-- View Icon -->
                                        <a href="{{ route('admin.donations.show', $donation->id) }}"
                                           class="text-blue-400 hover:text-blue-300 transition-colors p-1 rounded"
                                           title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @if($donation->status == 'pending' && auth('admin')->user()->hasPermission('manage_donations'))
                                            <!-- Dropdown for Accept/Cancel -->
                                            <div x-data="{ open: false }" class="relative">
                                                <button @click="open = !open" @keydown.escape="open = false" type="button"
                                                    class="text-gray-400 hover:text-gray-200 transition-colors p-1 rounded focus:outline-none"
                                                    title="More actions">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <circle cx="5" cy="12" r="1.5"/>
                                                        <circle cx="12" cy="12" r="1.5"/>
                                                        <circle cx="19" cy="12" r="1.5"/>
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false" class="absolute right-0 z-20 mt-2 w-40 bg-gray-800 border border-gray-700 rounded-lg shadow-lg py-1"
                                                    x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                                                    <button type="button"
                                                        class="flex w-full items-center px-4 py-2 text-sm text-green-400 hover:bg-gray-700 hover:text-green-300 status-btn"
                                                        data-donation-id="{{ $donation->id }}"
                                                        data-status="completed">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Accept
                                                    </button>
                                                    <button type="button"
                                                        class="flex w-full items-center px-4 py-2 text-sm text-red-400 hover:bg-gray-700 hover:text-red-300 status-btn"
                                                        data-donation-id="{{ $donation->id }}"
                                                        data-status="cancelled">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif(($donation->status == 'completed' || $donation->status == 'cancelled') && $donation->email && auth('admin')->user()->hasPermission('manage_donations'))
                                            <!-- Email Icon: Thank You for completed, Apology for cancelled -->
                                            <button type="button"
                                                onclick="sendStatusEmail('{{ $donation->id }}', '{{ $donation->status }}')"
                                                class="text-yellow-400 hover:text-yellow-300 transition-colors p-1 rounded"
                                                title="{{ $donation->status == 'completed' ? 'Send Thank You Email' : 'Send Apology Email' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-gray-400 text-lg">No donations found.</p>
                                    <p class="text-gray-500 text-sm mt-1">Try adjusting your filters or check back later.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($donations->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-gray-800 rounded-lg border border-gray-700 p-4">
                    {{ $donations->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // Toggle filters panel
    document.getElementById('toggleFilters').addEventListener('click', function(e) {
        e.preventDefault();
        const filtersPanel = document.getElementById('filtersPanel');
        filtersPanel.classList.toggle('hidden');
    });

    // Add event listeners for status buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Make sure we have the CSRF token in meta tag
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (!metaToken) {
            // Add CSRF token meta tag if it doesn't exist
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = '{{ csrf_token() }}';
            document.head.appendChild(meta);
        }
    
        // Attach click handlers to all status buttons
        const statusButtons = document.querySelectorAll('.status-btn');
        statusButtons.forEach(button => {
            // Store original text for resetting later
            button.setAttribute('data-original-text', button.innerHTML);
            
            // Add click handler
            button.addEventListener('click', function() {
                const donationId = this.getAttribute('data-donation-id');
                const newStatus = this.getAttribute('data-status');
                
                if (donationId && newStatus) {
                    updateDonationStatus(donationId, newStatus);
                }
            });
        });
    });

    // Function to update donation status via AJAX
    function updateDonationStatus(donationId, newStatus) {
        console.log('Updating donation', donationId, 'to status', newStatus);
        
        // Find button element for visual feedback
        const button = document.querySelector(`[data-donation-id="${donationId}"][data-status="${newStatus}"]`);
        const originalText = button.getAttribute('data-original-text');
        
        // Show loading state
        button.innerHTML = '<svg class="animate-spin h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        button.disabled = true;
        
        // Make AJAX request
        fetch(`/admin/donations/${donationId}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload the page to show updated status
                window.location.reload();
            } else {
                // Reset button and show error
                button.innerHTML = originalText;
                button.disabled = false;
                alert('Error: ' + (data.message || 'Failed to update status'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            button.innerHTML = originalText;
            button.disabled = false;
            alert('An error occurred while updating the status.');
        });
    }
    
    // Function to send thank you email
    function sendThankYou(donationId) {
        if(confirm('Send a thank you email to this donor?')) {
            fetch(`/admin/donations/thank-you/${donationId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Thank you email sent successfully!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending the thank you email.');
            });
        }
    }

    // Add this function for status-based email sending
    function sendStatusEmail(donationId, status) {
        let url, label;
        if (status === 'completed') {
            url = `/admin/donation-details/thank-you/${donationId}`;
            label = 'Thank You';
        } else if (status === 'cancelled') {
            url = `/admin/donation-details/apology/${donationId}`;
            label = 'Apology';
        } else {
            return;
        }
        if (confirm(`Send ${label} email to this donor?`)) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`${label} email sent successfully!`);
                } else {
                    alert('Error: ' + (data.message || 'Failed to send email'));
                }
            })
            .catch(error => {
                alert('An error occurred while sending the email.');
            });
        }
    }
</script>
@endsection