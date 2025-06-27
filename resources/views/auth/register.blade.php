<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center px-6 md:px-0 bg-gray-950">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/img/Logo_of_Tishk_International_University.png') }}" alt="University Logo" class="h-28">
        </div>

        <!-- Register Box -->
        <div class="w-full max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
            <!-- Title -->
            <h2 class="text-center text-2xl font-bold text-yellow-500 mb-2">Create Account</h2>
            <p class="text-center text-gray-400 mb-6">Join us to make a difference</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                    <input id="name" 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <input id="email" 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm Password</label>
                    <input id="password_confirmation" 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Terms and Conditions Checkbox -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required class="rounded border-gray-600 text-yellow-500 focus:ring-yellow-500 bg-gray-700">
                        <span class="text-gray-400 text-sm pl-2">I agree to the <a href="{{ route('privacy.policy') }}" class="text-yellow-500 hover:underline">Privacy Policy</a></span>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-4 rounded-lg transition duration-200 ease-in-out mb-4">
                    Register
                </button>
                
                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-400 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-yellow-500 hover:underline font-medium">
                            Log in
                        </a>
                    </p>
                </div>
            </form>
        </div>
        
        <!-- Footer text -->
        <p class="mt-8 text-center text-xs text-gray-500">
            By registering, you're joining our community of volunteers dedicated to making a positive impact.
        </p>
    </div>
</x-guest-layout>