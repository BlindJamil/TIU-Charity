@extends('layouts.app')

@section('title', 'Thank You for Your Donation')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
            <div class="p-8 md:p-10">
                <!-- Success Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                
                <!-- Thank You Message -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-4">Thank You for Your Donation!</h1>
                    <p class="text-gray-300 text-lg">
                        Your support makes a real difference in helping us achieve our mission.
                    </p>
                </div>
                
                <!-- Donation Details -->
                <div class="bg-gray-700 rounded-lg p-6 mb-8">
                    <h2 class="text-lg font-medium text-white mb-4">Donation Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Donation Amount</p>
                            <p class="text-2xl font-bold text-yellow-500">${{ number_format($donation->amount, 2) }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Donation For</p>
                            <p class="text-white font-medium">{{ $donation->cause_title }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Date</p>
                            <p class="text-white">{{ date('F j, Y', strtotime($donation->created_at)) }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-sm">Payment Method</p>
                            <p class="text-white">{{ ucfirst($donation->payment_method) }}</p>
                        </div>
                    </div>
                    
                    @if($donation->status == 'pending')
                        <div class="mt-6 p-4 bg-yellow-900 text-yellow-200 rounded-lg">
                            <p class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Your donation is being processed. We'll send you a confirmation email once completed.
                            </p>
                        </div>
                    @endif
                </div>
                
                @if($donation->email)
                    <div class="text-center mb-8">
                        <p class="text-gray-300">
                            We've sent a receipt to <strong>{{ $donation->email }}</strong>. Please check your inbox.
                        </p>
                    </div>
                @endif
                
                <!-- Share Section -->
                <div class="text-center mb-8">
                    <h3 class="text-lg font-medium text-white mb-4">Spread the Word</h3>
                    <p class="text-gray-300 mb-4">
                        Help us reach more people by sharing this cause.
                    </p>
                    
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white h-10 w-10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="bg-blue-400 hover:bg-blue-500 text-white h-10 w-10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="bg-green-600 hover:bg-green-700 text-white h-10 w-10 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Call to Action Buttons -->
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
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
@endsection