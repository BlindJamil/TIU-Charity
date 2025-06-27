@extends('layouts.app')

@section('title', 'Your Donation Receipt')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black pt-44 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
            <div class="p-8 md:p-10" id="printable-receipt">
                <!-- Success Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                
                <!-- Receipt Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Cash Donation Receipt</h1>
                    <p class="text-gray-300 text-lg">
                        Thank you for your support of our mission!
                    </p>
                </div>
                
                <!-- Receipt Details -->
                <div class="bg-gray-700 rounded-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-medium text-white">Receipt Information</h2>
                        <span class="text-sm text-gray-400">{{ date('F j, Y', strtotime($donation->created_at)) }}</span>
                    </div>
                    
                    <div class="mb-6 border-b border-gray-600 pb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-sm">Receipt Number</p>
                                <p class="text-xl font-bold text-yellow-500">{{ $donation->transaction_id }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 text-sm">Status</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-900 text-yellow-200">
                                    Pending Payment
                                </span>
                            </div>
                            
                            <div class="col-span-2 mt-2">
                                <p class="text-gray-400 text-sm">Receipt Valid Until</p>
                                <p class="text-white font-medium">{{ date('F j, Y', strtotime($donation->receipt_expires_at)) }}</p>
                                <p class="text-xs text-yellow-200 mt-1">Please make your payment before this date</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-gray-400 text-sm">Donation Amount</p>
                            <p class="text-2xl font-bold text-yellow-500">${{ number_format($donation->amount, 2) }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Donation For</p>
                            <p class="text-white font-medium">{{ $donation->cause_title }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Donor Name</p>
                            <p class="text-white">{{ $donation->name ?? 'Anonymous' }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Payment Method</p>
                            <p class="text-white">Cash</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 p-5 rounded-lg border border-gray-600">
                        <h3 class="text-md font-medium text-white mb-3">Payment Instructions</h3>
                        <p class="text-gray-300 mb-3">Please follow these steps to complete your donation:</p>
                        <ol class="list-decimal text-gray-300 pl-5 space-y-2">
                            <li>Print or save this receipt</li>
                            <li>Visit our office at <strong class="text-white">Tishk International University Accounting room 140</strong></li>
                            <li>Present this receipt number to our donation desk</li>
                            <li>Make your cash payment</li>
                            <li>Receive your stamped receipt as confirmation</li>
                        </ol>
                        <div class="mt-4 p-3 bg-yellow-900 bg-opacity-50 rounded-lg">
                            <p class="text-yellow-200 flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Your donation is not complete until payment is made in person.
                            </p>
                            <p class="text-yellow-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                This receipt expires on {{ date('F j, Y', strtotime($donation->receipt_expires_at)) }}.
                            </p>
                        </div>
                    </div>
                </div>
                
                @if($donation->email)
                    <div class="text-center mb-8">
                        <p class="text-gray-300">
                            We've sent a copy of this receipt to <strong>{{ $donation->email }}</strong>. Please check your inbox.
                        </p>
                    </div>
                @endif
                
                <!-- Office Hours -->
                <div class="bg-gray-700 rounded-lg p-4 mb-8 flex items-center">
                    <div class="flex-shrink-0 mr-4 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-600 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-md font-medium text-white mb-1">Office Hours</h3>
                        <p class="text-gray-400 text-sm">Sunday - Thursday:</p>
                        <p class="text-white font-semibold">8:30 AM - 4:30 PM</p>
                        <p class="text-gray-300 text-xs mt-2">Our team is available to assist you during these hours at the university accounting office.</p>
                    </div>
                </div>
                
                <!-- Organization Info (Shows on print only) -->
                <div class="hidden print:block mt-8 text-center">
                    <p class="text-gray-400 text-sm">TIU Charity</p>
                    <p class="text-gray-400 text-sm">Tishk International University Accounting room 140</p>
                    <p class="text-gray-400 text-sm">Phone: +1 (123) 456-7890</p>
                </div>
            </div>
            
            <!-- Action Buttons (Hide when printing) -->
            <div class="p-8 md:px-10 md:pt-0 md:pb-8 print:hidden">
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <button onclick="window.print()" class="w-full bg-green-600 hover:bg-green-700 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        Print Receipt
                    </button>
                    <a href="{{ route('cause') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors">
                        See Other Causes
                    </a>
                    <a href="{{ route('home') }}" class="w-full bg-gray-700 hover:bg-gray-600 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors">
                        Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Stylesheet -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-receipt, #printable-receipt * {
            visibility: visible;
        }
        #printable-receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background-color: white !important;
            color: black !important;
            padding: 20px;
        }
        #printable-receipt h1, 
        #printable-receipt h2, 
        #printable-receipt h3, 
        #printable-receipt p, 
        #printable-receipt span {
            color: black !important;
        }
        #printable-receipt .bg-gray-700, 
        #printable-receipt .bg-gray-800, 
        #printable-receipt .bg-yellow-900 {
            background-color: white !important;
            border: 1px solid #ccc !important;
        }
        #printable-receipt .text-yellow-500,
        #printable-receipt .text-green-500 {
            color: black !important;
        }
        #printable-receipt .text-gray-300,
        #printable-receipt .text-gray-400,
        #printable-receipt .text-white {
            color: black !important;
        }
    }
</style>
@endsection