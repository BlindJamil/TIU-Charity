@extends('layouts.app')

@section('title', 'Campaign')

@section('content')

<style>
    body {
        background-color: var(--color-gray-900)
    }
    
    /* Enhanced progress bar styles */
    .progress-container {
        position: relative;
        width: 100%;
        height: 8px;
        background-color: #374151;
        border-radius: 9999px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        border-radius: 9999px;
        background: linear-gradient(90deg, #f59e0b 0%, #f97316 100%);
        transition: width 0.5s ease;
    }
    
    .progress-marker {
        position: absolute;
        top: 50%;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #f97316;
        border: 3px solid #1f2937;
        transform: translate(-50%, -50%);
        z-index: 10;
    }
    
    @media (min-width: 640px) {
        .progress-marker {
            width: 16px;
            height: 16px;
        }
    }
    
    .cause-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .cause-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    
    .donate-button {
        transition: all 0.3s ease;
    }
    
    .donate-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>

<!-- About Page Hero Section with improved overlay and spacing -->
<section class="relative bg-gray-900 text-white pt-24">
    <!-- Background Image with better overlay -->
    <div class="bg-cover bg-center h-96 relative" style="background-image: url('{{asset('assets/img/abou2.jpg')}}');">
        <!-- Dark overlay for better text visibility -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Text Overlay with improved typography and spacing -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 lg:px-0">
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">Donate With Us</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Our Campaigns</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Our mission is to empower communities, promote change, and inspire hope through meaningful initiatives and dedicated efforts.
                </p>
            </div>
        </div>
    </div>
</section>

<main class="container mx-auto max-w-[100%] py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <!-- Recent Campaigns Section -->
    <div class="text-center mb-12">
        <h2 class="text-white text-4xl font-bold">Recent Campaigns</h2>
        <p class="text-gray-400 mt-4 max-w-2xl mx-auto">
            Support our recent campaigns and help us respond to urgent needs in our communities.
        </p>
    </div>

    @if(count($recentCauses) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-[90%] sm:max-w-[80%] md:max-w-[60%] lg:max-w-[95%] xl:max-w-[85%] 2xl:max-w-[70%] mx-auto">
        <!-- Recent Donation Cards -->
        @foreach ($recentCauses as $cause)
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden cause-card">
            <div class="relative w-full overflow-hidden h-56 sm:h-64 md:h-72 lg:h-80">
                <img src="{{ asset('storage/' . $cause->image) }}" alt="{{ $cause->title }}"
                    class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                @if($cause->is_urgent)
                <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                    URGENT
                </div>
                @endif
            </div>
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <h2 class="text-white text-2xl font-bold mb-3">{{ $cause->title }}</h2>
                    <span class="bg-yellow-500 text-black text-xs font-bold px-2 py-1 rounded-full">{{ round(($cause->raised / $cause->goal) * 100) }}%</span>
                </div>
                <p class="text-gray-400 mb-6 line-clamp-3">{{ $cause->description }}</p>
                
                <!-- Enhanced Progress Bar -->
                <div class="mb-6">
                    <div class="progress-container">
                        <div class="progress-bar" style="width: {{ ($cause->raised / $cause->goal) * 100 }}%;"></div>
                        <div class="progress-marker" style="left: {{ ($cause->raised / $cause->goal) * 100 }}%;"></div>
                    </div>
                    
                    <div class="flex justify-between mt-3 text-sm">
                        <div>
                            <span class="text-gray-400">Raised:</span>
                            <span class="text-yellow-500 font-medium">${{ number_format($cause->raised, 0) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Goal:</span>
                            <span class="text-orange-500 font-medium">${{ number_format($cause->goal, 0) }}</span>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('donation.form', ['id' => $cause->id]) }}" method="GET">
                    <button type="submit" class="w-full bg-yellow-500 text-black px-4 py-3 rounded-md hover:bg-orange-600 transition font-bold donate-button flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Donate Now
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center text-gray-400 mb-16">
        <p>No recent campaigns currently available.</p>
    </div>
    @endif
    
    <!-- Donation Field Section -->
    <div class="text-center mb-12 mt-32">
        <h2 class="text-white text-4xl font-bold">Donation Field</h2>
        <p class="text-gray-400 mt-4 max-w-2xl mx-auto">
            Choose a cause to support and make a meaningful impact in the lives of those who need it most.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-[90%] sm:max-w-[80%] md:max-w-[60%] lg:max-w-[95%] xl:max-w-[85%] 2xl:max-w-[70%] mx-auto">
        <!-- Cause Cards -->
        @foreach ($generalCauses as $cause)
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden cause-card">
            <div class="w-full overflow-hidden h-56 sm:h-64 md:h-72 lg:h-80">
                <img src="{{ asset('storage/' . $cause->image) }}" alt="{{ $cause->title }}"
                    class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
            </div>
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <h2 class="text-white text-2xl font-bold mb-3">{{ $cause->title }}</h2>
                    <span class="bg-yellow-500 text-black text-xs font-bold px-2 py-1 rounded-full">{{ round(($cause->raised / $cause->goal) * 100) }}%</span>
                </div>
                <p class="text-gray-400 mb-6 line-clamp-3">{{ $cause->description }}</p>
                
                <!-- Enhanced Progress Bar -->
                <div class="mb-6">
                    <div class="progress-container">
                        <div class="progress-bar" style="width: {{ ($cause->raised / $cause->goal) * 100 }}%;"></div>
                        <div class="progress-marker" style="left: {{ ($cause->raised / $cause->goal) * 100 }}%;"></div>
                    </div>
                    
                    <div class="flex justify-between mt-3 text-sm">
                        <div>
                            <span class="text-gray-400">Raised:</span>
                            <span class="text-yellow-500 font-medium">${{ number_format($cause->raised, 0) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Goal:</span>
                            <span class="text-orange-500 font-medium">${{ number_format($cause->goal, 0) }}</span>
                        </div>
                    </div>
                </div>
                
                <form action="{{ route('donation.form', ['id' => $cause->id]) }}" method="GET">
                    <button type="submit" class="w-full bg-yellow-500 text-black px-4 py-3 rounded-md hover:bg-orange-600 transition font-bold donate-button flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Donate Now
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Call to Action Section -->
    <div class="mt-20 text-center">
        <h3 class="text-white text-2xl font-bold mb-4">Want to start your own fundraising campaign?</h3>
        <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
            Join us in making a difference by creating your own fundraising initiative for a cause you care about.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition donate-button">
            Contact Us to Get Started
        </a>
    </div>
</main>

@endsection