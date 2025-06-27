@extends('admin.layout')

@section('title', 'Donation Details')

@section('content')
<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Cash Donation Details</h1>
                    <a href="{{ route('admin.donations.index') }}" class="text-yellow-500 hover:text-yellow-300">
                        Back to Donations
                    </a>
                </div>

                @if(session('success'))
                <div class="bg-green-900 text-green-200 p-4 rounded-lg mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Donation Information Card -->
                    <div class="lg:col-span-2 bg-gray-700 rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-white mb-1">Donation #{{ $donation->id }}</h2>
                                    <p class="text-sm text-gray-400">{{ date('F j, Y g:i A', strtotime($donation->created_at)) }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $donation->status == 'completed' ? 'bg-green-900 text-green-200' : 
                                       ($donation->status == 'pending' ? 'bg-yellow-900 text-yellow-200' : 'bg-red-900 text-red-200') }}">
                                    {{ ucfirst($donation->status ?? 'pending') }}
                                </span>
                            </div>

                            <div class="mt-6 border-t border-gray-600 pt-6">
                                <div class="mb-6 flex items-center">
                                    <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-green-500 bg-opacity-10 text-green-500 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm text-gray-400">Amount</p>
                                        <p class="text-2xl font-bold text-white">${{ number_format($donation->amount, 2) }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-4">
                                        <div>
                                            <h3 class="text-sm text-gray-400">Donor Information</h3>
                                            <p class="font-medium text-white">{{ $donation->name ?? 'Anonymous' }}</p>
                                            <p class="text-gray-300">{{ $donation->email ?? 'No email provided' }}</p>
                                            <p class="text-gray-300">{{ $donation->phone ?? 'No phone provided' }}</p>
                                        </div>

                                        <div>
                                            <h3 class="text-sm text-gray-400">Donation For</h3>
                                            <p class="font-medium text-white">{{ $donation->cause_title ?? 'General Donation' }}</p>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <h3 class="text-sm text-gray-400">Payment Method</h3>
                                            <p class="font-medium text-white">Cash</p>
                                            <p class="text-gray-300">Receipt Number: {{ $donation->transaction_id }}</p>
                                        </div>

                                        <div>
                                            <h3 class="text-sm text-gray-400">Receipt Generated</h3>
                                            <p class="text-gray-300">{{ date('F j, Y', strtotime($donation->created_at)) }}</p>
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-sm text-gray-400">Receipt Expires</h3>
                                            <p class="text-gray-300">{{ date('F j, Y', strtotime($donation->receipt_expires_at)) }}</p>
                                            @if(now() > $donation->receipt_expires_at && $donation->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900 text-red-200 mt-1">
                                                    Expired
                                                </span>
                                            @endif
                                        </div>
                                        
                                        @if($donation->status == 'completed' && $donation->completed_at)
                                        <div>
                                            <h3 class="text-sm text-gray-400">Payment Received</h3>
                                            <p class="text-gray-300">{{ date('F j, Y', strtotime($donation->completed_at)) }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @if($donation->message)
                                <div class="mt-6 p-4 bg-gray-800 rounded-lg">
                                    <h3 class="text-sm text-gray-400 mb-2">Donor Message</h3>
                                    <p class="text-white">{{ $donation->message }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar with Actions and Cash Processing -->
                    <div class="space-y-6">
                        <!-- Actions Card -->
                        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white mb-4">
                                    @if(auth('admin')->user()->hasPermission('manage_donations'))
                                        Update Cash Payment
                                    @else
                                        Payment Information
                                    @endif
                                </h2>
                                
                                @if(auth('admin')->user()->hasPermission('manage_donations'))
                                <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Payment Status</label>
                                        <select name="status" id="status" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                                            <option value="pending" {{ $donation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $donation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $donation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="admin_notes" class="block text-sm font-medium text-gray-300 mb-1">Payment Notes</label>
                                        <textarea name="admin_notes" id="admin_notes" rows="3" class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">{{ $donation->admin_notes ?? '' }}</textarea>
                                    </div>
                                    
                                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-lg transition-colors">
                                        Update Payment Status
                                    </button>
                                </form>
                                @else
                                    <!-- View-only information for users without manage permission -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-1">Payment Status</label>
                                            <div class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600">
                                                {{ ucfirst($donation->status) }}
                                            </div>
                                        </div>
                                        
                                        @if($donation->admin_notes)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-1">Payment Notes</label>
                                            <div class="w-full p-2 rounded-md bg-gray-800 text-white border border-gray-600">
                                                {{ $donation->admin_notes }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="mt-6 pt-6 border-t border-gray-600">
                                    <button onclick="printReceipt()" class="w-full flex items-center justify-center px-4 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                        Print Receipt
                                    </button>
                                    
                                    @if($donation->email && auth('admin')->user()->hasPermission('manage_donations'))
                                    <button onclick="sendThankYou('{{ $donation->id }}')" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-green-500 hover:bg-green-600 mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Send Thank You Email
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cash Payment Instructions -->
                        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white mb-4">Payment Processing</h2>
                                
                                <div class="space-y-4">
                                    <p class="text-gray-300 text-sm">Steps for processing cash donations:</p>
                                    
                                    <ol class="list-decimal pl-5 text-gray-300 space-y-2">
                                        <li>Verify the donor's receipt number</li>
                                        <li>Collect the cash amount</li>
                                        <li>Update the payment status to "Completed"</li>
                                        <li>Provide a stamped copy of the receipt</li>
                                        <li>Record the payment in the financial system</li>
                                    </ol>
                                    
                                    <div class="mt-4 p-3 bg-blue-900 bg-opacity-40 rounded-lg">
                                        <p class="text-blue-200 text-sm flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Always verify the donor's identity before marking a cash donation as completed.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Receipt for Printing -->
<div id="printable-admin-receipt" class="hidden">
    <div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; margin-bottom: 5px;">TIU Charity</h1>
            <p style="font-size: 16px; margin-bottom: 5px;">Cash Donation Receipt</p>
            <p style="font-size: 14px; color: #666;">Tishk International University Accounting room 140</p>
        </div>
        
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <div>
                    <p style="font-size: 14px; color: #666; margin-bottom: 3px;">Receipt Number</p>
                    <p style="font-size: 18px; font-weight: bold;">{{ $donation->transaction_id }}</p>
                </div>
                <div>
                    <p style="font-size: 14px; color: #666; margin-bottom: 3px;">Date</p>
                    <p>{{ date('F j, Y', strtotime($donation->created_at)) }}</p>
                </div>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <tr>
                    <td style="width: 30%; padding: 8px; border-bottom: 1px solid #eee;">Donor Name</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $donation->name ?? 'Anonymous' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">Donation For</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ $donation->cause_title }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">Amount</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee; font-weight: bold;">${{ number_format($donation->amount, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">Payment Method</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">Cash</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">Status</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ ucfirst($donation->status) }}</td>
                </tr>
            </table>
            
            @if($donation->message)
            <div style="margin-top: 15px;">
                <p style="font-size: 14px; color: #666; margin-bottom: 3px;">Donor Message</p>
                <p style="font-style: italic;">{{ $donation->message }}</p>
            </div>
            @endif
        </div>
        
        <div style="display: flex; justify-content: space-between; margin-top: 30px;">
            <div style="width: 45%; border-top: 1px solid #000;">
                <p style="text-align: center; font-size: 14px; margin-top: 5px;">Donor Signature</p>
            </div>
            <div style="width: 45%; border-top: 1px solid #000;">
                <p style="text-align: center; font-size: 14px; margin-top: 5px;">Official Signature</p>
            </div>
        </div>
        
        <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
            <p>Thank you for your generous support!</p>
            <p>This receipt is official proof of your donation.</p>
        </div>
    </div>
</div>

<script>
    // Function to print admin receipt
    function printReceipt() {
        const printContent = document.getElementById('printable-admin-receipt').innerHTML;
        const originalContent = document.body.innerHTML;
        
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        
        // Re-add event listeners after restoring content
        document.querySelector('button[onclick="printReceipt()"]').addEventListener('click', printReceipt);
        
        const thankYouBtn = document.querySelector('button[onclick^="sendThankYou"]');
        if (thankYouBtn) {
            const donationId = thankYouBtn.getAttribute('onclick').match(/'([^']+)'/)[1];
            thankYouBtn.addEventListener('click', () => sendThankYou(donationId));
        }
    }
    
    // Function to send thank you email
    function sendThankYou(donationId) {
        if(confirm('Send a thank you email to this donor?')) {
            fetch("{{ url('admin/donations/thank-you') }}/" + donationId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
</script>
@endsection