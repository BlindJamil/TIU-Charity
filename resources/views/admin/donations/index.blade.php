@extends('admin.layout')

@section('title', 'Manage Donations')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Manage Cash Donations</h1>
                    <div class="flex space-x-2">
                        @if(auth('admin')->user()->hasPermission('manage_donations'))
                        <a href="{{ route('admin.donations.export') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Export CSV
                            </span>
                        </a>
                        @else
                        <button disabled class="bg-gray-700 text-gray-500 px-4 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to export data">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Export CSV
                            </span>
                        </button>
                        @endif
                        <a href="#" id="toggleFilters" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filters
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Success message -->
                @if(session('success'))
                <div class="bg-green-900 text-green-200 p-4 mb-6 rounded-md shadow-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Filters Panel (hidden by default) -->
                <div id="filtersPanel" class="bg-gray-700 rounded-lg p-4 mb-6 {{ request()->anyFilled(['date_range', 'status', 'cause_id', 'min_amount', 'max_amount', 'payment_method']) ? '' : 'hidden' }}">
                    <form action="{{ route('admin.donations.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Date Range</label>
                            <select name="date_range" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                <option value="">All Time</option>
                                <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                                <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                                <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select name="status" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Cause</label>
                            <select name="cause_id" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                <option value="">All Causes</option>
                                @foreach($causes as $cause)
                                    <option value="{{ $cause->id }}" {{ request('cause_id') == $cause->id ? 'selected' : '' }}>{{ $cause->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Amount</label>
                            <div class="flex space-x-2">
                                <input type="number" name="min_amount" placeholder="Min" value="{{ request('min_amount') }}" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                <input type="number" name="max_amount" placeholder="Max" value="{{ request('max_amount') }}" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Payment Method</label>
                            <select name="payment_method" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                <option value="">All Methods</option>
                                <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="mobile_payment" {{ request('payment_method') == 'mobile_payment' ? 'selected' : '' }}>Mobile Payment</option>
                            </select>
                        </div>

                        <div class="md:col-span-4 flex justify-end space-x-3">
                            <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">Clear</a>
                            <button type="submit" class="px-4 py-2 bg-yellow-500 text-black rounded-md hover:bg-yellow-600">Apply Filters</button>
                        </div>
                    </form>
                </div>

                <!-- Donation Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-gray-700 rounded-lg p-4 shadow-md border border-gray-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Total Donations</p>
                                <p class="text-xl font-bold text-white">{{ $totalDonations }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-700 rounded-lg p-4 shadow-md border border-gray-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-20 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Total Amount</p>
                                <p class="text-xl font-bold text-white">${{ number_format($totalAmount, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-700 rounded-lg p-4 shadow-md border border-gray-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Average Donation</p>
                                <p class="text-xl font-bold text-white">${{ number_format($averageDonation, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-700 rounded-lg p-4 shadow-md border border-gray-600">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-500 bg-opacity-20 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Latest Donation</p>
                                {{ $latestDonation ? \Carbon\Carbon::parse($latestDonation->created_at)->diffForHumans() : 'No donations yet' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700 rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Donor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cause</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Receipt #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-700 divide-y divide-gray-600">
                            @forelse($donations as $donation)
                                <tr class="hover:bg-gray-650 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-white">{{ $donation->name ?? 'Anonymous' }}</div>
                                        <div class="text-sm text-gray-400">{{ $donation->email ?? 'No email provided' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-white">
                                            {{ $donation->cause_title ?? 'Unknown Cause' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-green-400">${{ number_format($donation->amount, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ $donation->transaction_id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $donation->status == 'completed' ? 'bg-green-900 text-green-200' : 
                                              ($donation->status == 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-white">{{ date('M d, Y', strtotime($donation->created_at)) }}</div>
                                        <div class="text-sm text-gray-400">{{ date('h:i A', strtotime($donation->created_at)) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.donations.show', $donation->id) }}" class="text-blue-400 hover:text-blue-300">
                                                <span class="sr-only">View</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            
                                            @if($donation->status == 'pending')
                                                @if(auth('admin')->user()->hasPermission('manage_donations'))
                                                <button type="button" 
                                                       class="text-green-400 hover:text-green-300 status-btn" 
                                                       data-donation-id="{{ $donation->id }}" 
                                                       data-status="completed"
                                                       title="Mark as completed">
                                                    <span class="sr-only">Complete</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                                
                                                <button type="button" 
                                                       class="text-red-400 hover:text-red-300 status-btn" 
                                                       data-donation-id="{{ $donation->id }}" 
                                                       data-status="cancelled"
                                                       title="Mark as cancelled">
                                                    <span class="sr-only">Cancel</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                                @else
                                                <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to manage donations">
                                                    <span class="sr-only">Complete</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                                
                                                <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to manage donations">
                                                    <span class="sr-only">Cancel</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                                @endif
                                            @endif
                                            
                                            @if($donation->email)
                                                @if(auth('admin')->user()->hasPermission('manage_donations'))
                                                <button type="button" onclick="sendThankYou('{{ $donation->id }}')" class="text-yellow-400 hover:text-yellow-300" title="Send thank you email">
                                                    <span class="sr-only">Thank You Email</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </button>
                                                @else
                                                <button disabled class="text-gray-500 cursor-not-allowed opacity-50" title="You don't have permission to send emails">
                                                    <span class="sr-only">Thank You Email</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </button>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-400">
                                        No donations found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $donations->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
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
        const button = document.querySelector(`button[data-donation-id="${donationId}"][data-status="${newStatus}"]`);
        if (button) {
            // Save original button content
            const originalContent = button.innerHTML;
            // Show loading spinner with Tailwind classes
            button.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            button.disabled = true;
        }
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Make sure the URL is correct
        fetch('/admin/donation-details/' + donationId, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                status: newStatus
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Server returned ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Show small success message
            const successToast = document.createElement('div');
            successToast.className = 'fixed bottom-4 right-4 bg-green-800 text-green-100 px-4 py-2 rounded shadow-lg z-50';
            successToast.textContent = `Status updated: ${ucfirst(newStatus)}`;
            document.body.appendChild(successToast);
            
            // Update the UI to reflect the change
            const row = button.closest('tr');
            if (row) {
                // Update the status cell (5th column - 0-indexed would be 4)
                const statusCell = row.querySelector('td:nth-child(5) span');
                if (statusCell) {
                    // Update text
                    statusCell.textContent = ucfirst(newStatus);
                    
                    // Remove all existing status classes
                    statusCell.classList.remove('bg-green-900', 'text-green-200', 'bg-yellow-900', 'text-yellow-200', 'bg-red-900', 'text-red-200');
                    
                    // Add appropriate classes based on new status
                    if (newStatus === 'completed') {
                        statusCell.classList.add('bg-green-900', 'text-green-200');
                    } else if (newStatus === 'pending') {
                        statusCell.classList.add('bg-yellow-900', 'text-yellow-200');
                    } else {
                        statusCell.classList.add('bg-red-900', 'text-red-200');
                    }
                }
                
                // Hide the buttons since the status is now changed
                row.querySelectorAll('.status-btn').forEach(btn => {
                    btn.style.display = 'none';
                });
            }
            
            // Reload the page after 1 second to refresh any UI elements
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Show error message
            const errorToast = document.createElement('div');
            errorToast.className = 'fixed bottom-4 right-4 bg-red-800 text-red-100 px-4 py-2 rounded shadow-lg z-50';
            errorToast.textContent = 'Failed to update status';
            document.body.appendChild(errorToast);
            setTimeout(() => errorToast.remove(), 3000);
            
            // Reset button state if there was an error
            if (button) {
                button.disabled = false;
                button.innerHTML = button.getAttribute('data-original-text') || originalContent;
            }
        });
    }

    // Helper function to capitalize first letter
    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Function to send thank you email
    function sendThankYou(donationId) {
        // Create a loading indicator
        const loadingToast = document.createElement('div');
        loadingToast.className = 'fixed bottom-4 right-4 bg-blue-800 text-blue-100 px-4 py-2 rounded shadow-lg z-50 flex items-center';
        loadingToast.innerHTML = `
            <svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Sending email...
        `;
        document.body.appendChild(loadingToast);
        
        fetch("/admin/donation-details/thank-you/" + donationId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading toast
            loadingToast.remove();
            
            // Show result toast
            const resultToast = document.createElement('div');
            if(data.success) {
                resultToast.className = 'fixed bottom-4 right-4 bg-green-800 text-green-100 px-4 py-2 rounded shadow-lg z-50';
                resultToast.textContent = 'Thank you email sent';
            } else {
                resultToast.className = 'fixed bottom-4 right-4 bg-red-800 text-red-100 px-4 py-2 rounded shadow-lg z-50';
                resultToast.textContent = data.message || 'Failed to send email';
            }
            document.body.appendChild(resultToast);
            setTimeout(() => resultToast.remove(), 3000);
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Remove loading toast
            loadingToast.remove();
            
            // Show error toast
            const errorToast = document.createElement('div');
            errorToast.className = 'fixed bottom-4 right-4 bg-red-800 text-red-100 px-4 py-2 rounded shadow-lg z-50';
            errorToast.textContent = 'Failed to send email';
            document.body.appendChild(errorToast);
            setTimeout(() => errorToast.remove(), 3000);
        });
    }
</script>
@endsection