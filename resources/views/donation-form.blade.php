@extends('layouts.app')

@section('title', 'Donate to ' . $cause->title)

@section('content')
<div class="donation-container min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black pt-44 pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Cause Information -->
                <div class="relative">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $cause->image) }}');">
                        <div class="absolute inset-0 bg-black opacity-60"></div>
                    </div>
                    
                    <div class="relative p-8 md:p-10 h-full flex flex-col justify-between">
                        <div>
                            <span class="bg-yellow-500 text-black px-4 py-1 rounded-full text-sm font-bold">Cash Donation</span>
                            <h1 class="text-3xl font-bold mt-4 text-white">{{ $cause->title }}</h1>
                            <p class="mt-4 text-gray-300">{{ $cause->description }}</p>
                        </div>
                        
                        <div class="mt-6">
                            <div class="mb-2 flex justify-between text-sm">
                                <span class="text-white">Progress</span>
                                <span class="text-yellow-500 font-medium">{{ round(($cause->raised / $cause->goal) * 100) }}%</span>
                            </div>
                            <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full" style="width: {{ ($cause->raised / $cause->goal) * 100 }}%"></div>
                            </div>
                            <div class="flex justify-between mt-2 text-sm">
                                <div>
                                    <span class="text-gray-400">Raised:</span>
                                    <span class="text-white font-medium">${{ number_format($cause->raised, 0) }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Goal:</span>
                                    <span class="text-white font-medium">${{ number_format($cause->goal, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Donation Form -->
                <div class="p-8 md:p-10 bg-gray-800">
                    <h2 class="text-2xl font-semibold text-white mb-6">Make Your Cash Donation</h2>
                    
                    @if($errors->any())
                        <div class="bg-red-900 text-red-200 p-4 rounded-lg mb-6">
                            <p class="font-medium">Please correct the following errors:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('donate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        
                        <!-- Donation Amount -->
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Select Amount</label>
                            <div class="grid grid-cols-3 gap-3 mb-3">
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$10</button>
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$25</button>
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$50</button>
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$100</button>
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$250</button>
                                <button type="button" class="amount-btn px-4 py-3 border-2 border-gray-600 rounded-lg text-white hover:border-yellow-500 hover:bg-gray-700 transition-colors">$500</button>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">$</span>
                                <input type="number" name="amount" id="custom-amount" value="{{ old('amount') }}" placeholder="Custom Amount" step="0.01" min="1" required
                                    class="w-full pl-8 p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">
                            </div>
                        </div>
                        
                        <!-- Donor Information -->
<div class="mb-6">
    <h3 class="text-lg font-medium text-white mb-3">Your Information</h3>
    
    <div class="mb-4">
        <label for="name" class="block text-gray-300 mb-2">Your Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $userData['name'] ?? '') }}" placeholder="John Doe"
            class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-yellow-500" required>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="email" class="block text-gray-300 mb-2">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $userData['email'] ?? '') }}" placeholder="your@email.com"
                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-yellow-500" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone" class="block text-gray-300 mb-2">Phone Number</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone', $userData['phone'] ?? '') }}" placeholder="Your phone number"
                class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-yellow-500" required>
            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div>
        <label for="message" class="block text-gray-300 mb-2">Message (Optional)</label>
        <textarea name="message" id="message" rows="3" placeholder="Share why you're supporting this cause..."
            class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-yellow-500">{{ old('message') }}</textarea>
        @error('message')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
                        
                        <!-- Cash Payment Information Box -->
                        <div class="mb-6 bg-gray-700 p-4 rounded-lg border border-gray-600">
                            <h3 class="text-lg font-medium text-white mb-2">Cash Payment Information</h3>
                            <p class="text-gray-300 text-sm mb-3">
                                After submitting this form, you will receive a receipt with instructions on how to make your cash donation at our office.
                            </p>
                            <div class="flex items-center text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">Please bring your receipt to complete the donation process.</span>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="terms_agreed" id="terms_agreed" required
                                        class="h-4 w-4 rounded bg-gray-700 border-gray-600 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms_agreed" class="text-gray-300">I agree to the <a href="#" class="text-yellow-500 hover:text-yellow-400">terms and conditions</a> and <a href="#" class="text-yellow-500 hover:text-yellow-400">privacy policy</a>.</label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-4 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                            Generate Receipt for Cash Donation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for amount buttons
    document.addEventListener('DOMContentLoaded', function() {
        const amountBtns = document.querySelectorAll('.amount-btn');
        const customAmountInput = document.getElementById('custom-amount');
        
        // Set active state and update custom amount input
        amountBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active state from all buttons
                amountBtns.forEach(b => {
                    b.classList.remove('bg-yellow-500', 'border-yellow-500', 'text-black');
                    b.classList.add('border-gray-600', 'text-white');
                });
                
                // Add active state to clicked button
                this.classList.remove('border-gray-600', 'text-white');
                this.classList.add('bg-yellow-500', 'border-yellow-500', 'text-black');
                
                // Set amount value in the input
                const amount = this.textContent.replace('$', '');
                customAmountInput.value = amount;
            });
        });
        
        // Toggle anonymous donation
const anonymousCheckbox = document.getElementById('anonymous');
const nameInput = document.getElementById('name');

anonymousCheckbox.addEventListener('change', function() {
    if (this.checked) {
        nameInput.disabled = false; // Keep enabled for form submission
        nameInput.value = ''; // Clear the value
        nameInput.classList.add('bg-gray-600', 'opacity-50');
        nameInput.readOnly = true; // Make it read-only instead of disabled
    } else {
        nameInput.disabled = false;
        nameInput.readOnly = false;
        nameInput.classList.remove('bg-gray-600', 'opacity-50');
    }
});
    });
</script>
@endsection