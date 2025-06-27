<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center px-6 md:px-0 bg-gray-950">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/img/Logo_of_Tishk_International_University.png') }}" alt="University Logo" class="h-28">
        </div>

        <!-- Login Box -->
        <div class="w-full max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <!-- Title -->
            <h2 class="text-center text-2xl font-bold text-orange-400">Login</h2>
            <p class="text-center text-gray-400 mb-6">Sign in to continue</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="!text-gray-300" />

                    <x-text-input id="email" class="block mt-1 w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:outline-none focus:border-orange-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="!text-gray-300" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-700 text-white border border-gray-600 rounded-md p-3 focus:outline-none focus:border-orange-400"
                                    type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="flex items-center text-gray-300">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-500 text-orange-500 focus:ring-orange-400" name="remember">
                        <span class="ms-2 text-sm">Remember me</span>
                    </label>

                    <a class="text-sm text-orange-400 hover:underline" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none">
                        Log in
                    </button>
                </div>

                <!-- Register Redirect -->
                <p class="text-center text-gray-400 mt-4">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-orange-400 hover:underline">Register</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
