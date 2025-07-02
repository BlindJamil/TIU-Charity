@extends('layouts.app')

@section('title', 'Our Achievements')

@section('content')

<style>
    .achievement-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .achievement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .progress-bar {
        background: linear-gradient(90deg, #f59e0b 0%, #f97316 100%);
        transition: width 0.5s ease;
    }
    
    .stat-counter {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .modal-overlay {
        backdrop-filter: blur(8px);
        background: rgba(0, 0, 0, 0.8);
    }
    
    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }
    
    .gallery-photo {
        aspect-ratio: 1;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    
    .gallery-photo:hover {
        transform: scale(1.05);
    }
</style>

<!-- Hero Section -->
<section class="relative bg-gray-900 text-white pt-8 md:pt-12">
    <div class="bg-cover bg-center h-96 relative" style="background-image: url('{{asset('assets/img/abou2.jpg')}}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 lg:px-0">
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">Our Impact</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Our Achievements</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    See how your donations create real change. Every dollar makes a difference in communities worldwide.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Overall Impact Stats -->
<section class="py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">Our Impact So Far</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Here's what we've accomplished together since we started our mission.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="text-4xl font-bold stat-counter mb-2">{{ $totalFunds }}</div>
                <p class="text-gray-300">Total Funds Used</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="text-4xl font-bold stat-counter mb-2">{{ $totalProjects }}</div>
                <p class="text-gray-300">Projects Completed</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="text-4xl font-bold stat-counter mb-2">{{ $totalPeopleHelped }}+</div>
                <p class="text-gray-300">People Helped</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="text-4xl font-bold stat-counter mb-2">{{ $totalVolunteers }}</div>
                <p class="text-gray-300">Volunteers</p>
            </div>
        </div>
    </div>
</section>

<!-- Completed Projects Section -->
<section class="py-20 bg-gray-900" x-data="{ selectedProject: null }">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white mb-4">Completed Projects</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">These are the projects we've successfully completed with your generous support.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($achievements as $achievement)
            <div class="achievement-card bg-gray-800 rounded-lg overflow-hidden shadow-lg border border-gray-700">
                <div class="relative h-48">
                    <img src="{{ is_array($achievement['main_image']) ? '' : $achievement['main_image'] }}" alt="{{ is_array($achievement['title']) ? implode(' ', $achievement['title']) : $achievement['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">COMPLETED</div>
                    <div class="absolute bottom-4 left-4 bg-black bg-opacity-70 text-white px-3 py-1 rounded-full text-sm">{{ is_array($achievement['category']) ? implode(' ', $achievement['category']) : $achievement['category'] }}</div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-3">{{ is_array($achievement['title']) ? implode(' ', $achievement['title']) : $achievement['title'] }}</h3>
                    <p class="text-gray-400 mb-4">{{ is_array($achievement['description']) ? implode(' ', $achievement['description']) : Str::limit($achievement['description'], 120) }}</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-400">Goal Achieved</span>
                            <span class="text-green-400 font-bold">100%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="progress-bar h-2 rounded-full w-full"></div>
                        </div>
                        <div class="flex justify-between text-sm mt-2">
                            <span class="text-yellow-500 font-medium">${{ number_format($achievement['amount'], 0) }}</span>
                            <span class="text-white font-medium">{{ is_array($achievement['completion_date']) ? implode(' ', $achievement['completion_date']) : $achievement['completion_date'] }}</span>
                        </div>
                    </div>
                    
                    <!-- Simple Impact Stats -->
                    <div class="grid grid-cols-2 gap-4 text-center mb-4">
                        <div class="bg-gray-700 rounded p-3">
                            <div class="text-yellow-500 font-bold">{{ is_array($achievement['impact_stat_1_value']) ? implode(' ', $achievement['impact_stat_1_value']) : $achievement['impact_stat_1_value'] }}</div>
                            <div class="text-gray-400 text-sm">{{ is_array($achievement['impact_stat_1_label']) ? implode(' ', $achievement['impact_stat_1_label']) : $achievement['impact_stat_1_label'] }}</div>
                        </div>
                        <div class="bg-gray-700 rounded p-3">
                            <div class="text-yellow-500 font-bold">{{ is_array($achievement['impact_stat_2_value']) ? implode(' ', $achievement['impact_stat_2_value']) : $achievement['impact_stat_2_value'] }}</div>
                            <div class="text-gray-400 text-sm">{{ is_array($achievement['impact_stat_2_label']) ? implode(' ', $achievement['impact_stat_2_label']) : $achievement['impact_stat_2_label'] }}</div>
                        </div>
                    </div>
                    
                    <!-- View Details Button -->
                    <button @click="selectedProject = {{ $loop->index }}" 
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-lg transition duration-300">
                        View Full Details
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg transition">
                Load More Projects
            </button>
        </div>
    </div>
    
    <!-- Project Detail Modal -->
    <div x-show="selectedProject !== null" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 z-50 overflow-y-auto modal-overlay" 
         style="display: none;" 
         @click.self="selectedProject = null">
        
        <div class="flex items-center justify-center min-h-screen p-4">
            <div x-show="selectedProject !== null" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 scale-90" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in duration-200" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-90" 
                 class="bg-gray-800 rounded-xl max-w-6xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-700">
                
                @foreach($achievements as $index => $achievement)
                <div x-show="selectedProject === {{ $index }}" class="relative">
                    <!-- Close Button -->
                    <button @click="selectedProject = null" 
                            class="absolute top-4 right-4 z-10 bg-black bg-opacity-50 text-white hover:text-gray-300 transition rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <!-- Hero Image -->
                    <div class="relative h-64 md:h-80 bg-gray-700 rounded-t-xl overflow-hidden">
                        <img src="{{ is_array($achievement['main_image']) ? '' : $achievement['main_image'] }}" alt="{{ is_array($achievement['title']) ? implode(' ', $achievement['title']) : $achievement['title'] }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end">
                            <div class="p-8 text-white">
                                <div class="inline-block px-3 py-1 bg-green-500 text-white rounded-full text-sm font-bold mb-4">COMPLETED</div>
                                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ is_array($achievement['title']) ? implode(' ', $achievement['title']) : $achievement['title'] }}</h1>
                                <p class="text-gray-200">{{ is_array($achievement['location']) ? implode(' ', $achievement['location']) : $achievement['location'] }} • {{ is_array($achievement['completion_date']) ? implode(' ', $achievement['completion_date']) : $achievement['completion_date'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <!-- Project Overview -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                            <div class="lg:col-span-2">
                                <h2 class="text-2xl font-bold text-white mb-4">Project Overview</h2>
                                <div class="text-gray-300 leading-relaxed space-y-4">
                                    {!! is_array($achievement['detailed_description']) ? implode(' ', $achievement['detailed_description']) : nl2br(e($achievement['detailed_description'])) !!}
                                </div>
                                
                                <h3 class="text-xl font-bold text-white mt-6 mb-4">What We Accomplished</h3>
                                <ul class="text-gray-300 space-y-2">
                                    @foreach($achievement['accomplishments'] as $accomplishment)
                                    <li class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mt-0.5 mr-3 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $accomplishment }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <!-- Impact Stats -->
                            <div>
                                <h3 class="text-xl font-bold text-white mb-4">Impact Metrics</h3>
                                <div class="space-y-4">
                                    @foreach($achievement['detailed_stats'] as $stat)
                                    <div class="bg-gray-700 rounded-lg p-4 text-center">
                                        <div class="text-yellow-500 font-bold text-2xl">{{ $stat['value'] }}</div>
                                        <div class="text-gray-300 text-sm">{{ $stat['label'] }}</div>
                                        @if(isset($stat['description']))
                                        <div class="text-gray-400 text-xs mt-1">{{ $stat['description'] }}</div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Financial Breakdown -->
                                <div class="mt-6">
                                    <h4 class="text-lg font-bold text-white mb-3">Financial Breakdown</h4>
                                    <div class="bg-gray-700 rounded-lg p-4">
                                        @foreach($achievement['financial_breakdown'] as $item)
                                        <div class="flex justify-between py-2 border-b border-gray-600 last:border-b-0">
                                            <span class="text-gray-300">{{ $item['category'] }}</span>
                                            <span class="text-yellow-500 font-medium">${{ number_format($item['amount'], 0) }}</span>
                                        </div>
                                        @endforeach
                                        <div class="flex justify-between py-2 mt-2 pt-2 border-t border-gray-600 font-bold">
                                            <span class="text-white">Total</span>
                                            <span class="text-yellow-500">${{ number_format($achievement['amount'], 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Photo Gallery -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-white mb-4">Project Gallery</h3>
                            <div class="photo-gallery">
                                @foreach($achievement['gallery_photos'] as $photo)
                                <div class="gallery-photo bg-gray-700 rounded-lg overflow-hidden">
                                    <img src="{{ $photo['url'] ?? $photo }}" alt="{{ $photo['caption'] ?? '' }}" class="w-full h-full object-cover">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Testimonials -->
                        @if(isset($achievement['testimonials']) && count($achievement['testimonials']) > 0)
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-white mb-4">Community Voices</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($achievement['testimonials'] as $testimonial)
                                <div class="bg-gray-700 rounded-lg p-6">
                                    <p class="text-gray-300 italic mb-4">"{{ $testimonial['quote'] }}"</p>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold mr-3">
                                            {{ substr($testimonial['name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">{{ $testimonial['name'] }}</div>
                                            <div class="text-gray-400 text-sm">{{ $testimonial['role'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Related Documents -->
                        {{-- Project Documents section removed as per user request --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Transparency Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white mb-4">Our Commitment to Transparency</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">We believe in complete transparency about how your donations are used.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Transparency Point 1 -->
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">100% Verification</h3>
                <p class="text-gray-400">Every project is verified and documented with photos, receipts, and impact reports.</p>
            </div>
            
            <!-- Transparency Point 2 -->
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Financial Reports</h3>
                <p class="text-gray-400">Detailed breakdown of how every dollar is spent, available for public review.</p>
            </div>
            
            <!-- Transparency Point 3 -->
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Regular Updates</h3>
                <p class="text-gray-400">Regular progress updates and follow-up reports on all completed projects.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="bg-gray-800 rounded-xl p-10 md:p-16 shadow-2xl border border-gray-700">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl text-white font-bold mb-6">Ready to Make the Next Impact?</h2>
                <p class="text-gray-300 max-w-2xl mx-auto mb-8">
                    Your contribution can help us complete more projects and reach even more people in need.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('cause') }}" class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-lg transition duration-300 transform hover:-translate-y-1">
                        Donate Now
                    </a>
                    <a href="{{ route('volunteer') }}" class="px-8 py-3 bg-transparent border-2 border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-black font-bold rounded-lg transition duration-300 transform hover:-translate-y-1">
                        Become a Volunteer
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection