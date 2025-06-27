@extends('layouts.app')

@section('title', 'Volunteer')

@section('content')
<!-- About Page Hero Section with improved overlay and spacing -->
<section class="relative bg-gray-900 text-white pt-24">
    <!-- Background Image with better overlay -->
    <div class="bg-cover bg-center h-96 relative" style="background-image: url('{{asset('assets/img/abou2.jpg')}}');">
        <!-- Dark overlay for better text visibility -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Text Overlay with improved typography and spacing -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 lg:px-0">
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">Join Us</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Volunteer</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                  Join our community of volunteers and help make a difference in people's lives.
                </p>                
            </div>
        </div>
    </div>
</section>

<!-- Why Volunteer Section - MOVED UP -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white">Why Volunteer With Us?</h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Join our community of dedicated volunteers who are making a real difference.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Reason 1 -->
            <div class="bg-gray-800 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Make an Impact</h3>
                <p class="text-gray-400">Your contribution directly helps those in need and creates positive change in communities.</p>
            </div>
            
            <!-- Reason 2 -->
            <div class="bg-gray-800 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Build Connections</h3>
                <p class="text-gray-400">Meet like-minded individuals who share your passion for making a difference.</p>
            </div>
            
            <!-- Reason 3 -->
            <div class="bg-gray-800 p-8 rounded-lg text-center">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Gain Experience</h3>
                <p class="text-gray-400">Develop new skills and gain valuable experience that enhances both personal and professional growth.</p>
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Process Section - MOVED UP -->
<section class="py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white">How to Get Involved</h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Becoming a volunteer is easy! Follow these simple steps to start making a difference.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="bg-gray-800 p-6 rounded-lg text-center relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-xl">1</div>
                <h3 class="text-xl font-bold text-white mb-4 mt-3">Sign Up</h3>
                <p class="text-gray-400">Create an account to access volunteer opportunities.</p>
            </div>
            
            <!-- Step 2 -->
            <div class="bg-gray-800 p-6 rounded-lg text-center relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-xl">2</div>
                <h3 class="text-xl font-bold text-white mb-4 mt-3">Browse Projects</h3>
                <p class="text-gray-400">Explore available volunteer projects that match your interests.</p>
            </div>
            
            <!-- Step 3 -->
            <div class="bg-gray-800 p-6 rounded-lg text-center relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-xl">3</div>
                <h3 class="text-xl font-bold text-white mb-4 mt-3">Apply</h3>
                <p class="text-gray-400">Submit your application for the project you're interested in.</p>
            </div>
            
            <!-- Step 4 -->
            <div class="bg-gray-800 p-6 rounded-lg text-center relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold text-xl">4</div>
                <h3 class="text-xl font-bold text-white mb-4 mt-3">Start Helping</h3>
                <p class="text-gray-400">Once approved, you'll be ready to make a meaningful impact.</p>
            </div>
        </div>
    </div>
</section>

<!-- Project Display Section -->
<section class="py-24 bg-gradient-to-b from-gray-900 to-gray-800" id="current-project">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-2">Current Projects</h2>
            <div class="w-20 h-1 bg-yellow-500 mx-auto mb-6"></div>
            <p class="text-gray-300 max-w-2xl mx-auto text-lg">Check out our volunteer opportunities and join us in making a difference.</p>
        </div>
        
        @if(count($projects) > 0)
            <div class="space-y-12">
                @foreach($projects as $project)
                    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-700">
                        <div class="flex flex-col lg:flex-row">
                            <!-- Project Image with fixed height and consistent aspect ratio -->
                            <div class="lg:w-1/2 relative">
                                <div class="h-full">
                                    <div class="h-64 sm:h-80 lg:h-full w-full">
                                        <img 
                                            src="{{ $project->image ? asset('storage/' . $project->image) : asset('assets/img/donation1.jpg') }}" 
                                            alt="{{ $project->title }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                </div>
                                <!-- Overlay badge for volunteers count -->
                                <div class="absolute top-4 right-4 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full text-sm font-medium">
                                    {{ $volunteerData[$project->id]['count'] }} / {{ $project->volunteers_needed }} Volunteers
                                </div>
                            </div>
                            
                            <!-- Project Details -->
                            <div class="lg:w-1/2 p-6 sm:p-8 lg:p-10">
                                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-4">{{ $project->title }}</h1>
                                <p class="text-gray-300 mb-8 leading-relaxed">{{ $project->description }}</p>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-yellow-500 font-semibold text-sm uppercase tracking-wider">Location</h3>
                                            <p class="text-white mt-1">{{ $project->location }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-yellow-500 font-semibold text-sm uppercase tracking-wider">Date</h3>
                                            <p class="text-white mt-1">{{ date('M d, Y', strtotime($project->start_date)) }} - {{ date('M d, Y', strtotime($project->end_date)) }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-yellow-500 font-semibold text-sm uppercase tracking-wider">Volunteers Needed</h3>
                                            <p class="text-white mt-1">{{ $project->volunteers_needed }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-yellow-500 font-semibold text-sm uppercase tracking-wider">Status</h3>
                                            <div class="mt-1">
                                                <div class="w-full bg-gray-700 rounded-full h-2.5 mt-2">
                                                    <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ ($volunteerData[$project->id]['count'] / $project->volunteers_needed) * 100 }}%"></div>
                                                </div>
                                                <p class="text-white text-sm mt-1">{{ $volunteerData[$project->id]['count'] }} registered of {{ $project->volunteers_needed }} needed</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @auth
                                    @if($volunteerData[$project->id]['hasVolunteered'])
                                        <div class="bg-gray-700 rounded-xl p-5 text-center">
                                            <div class="flex items-center justify-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <p class="font-medium text-white">You have already volunteered for this project!</p>
                                            </div>
                                            <div class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-800">
                                                <span class="text-sm mr-2">Status:</span>
                                                <span class="text-sm font-bold {{ $volunteerData[$project->id]['status'] == 'approved' ? 'text-green-400' : ($volunteerData[$project->id]['status'] == 'rejected' ? 'text-red-400' : 'text-yellow-400') }}">
                                                    {{ ucfirst($volunteerData[$project->id]['status']) }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <form action="{{ route('volunteer.store') }}" method="POST" class="mt-8">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                            
                                            <div class="mb-5">
                                                <label for="message_{{ $project->id }}" class="block text-white text-sm font-medium mb-2">Message (Optional)</label>
                                                <textarea 
                                                    name="message" 
                                                    id="message_{{ $project->id }}" 
                                                    rows="3" 
                                                    class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition"
                                                    placeholder="Share why you're interested in volunteering for this project..."
                                                ></textarea>
                                            </div>
                                            
                                            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                                </svg>
                                                Volunteer Now
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="bg-gray-700 p-6 rounded-xl text-center mt-8">
                                        <div class="mb-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-yellow-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            <p class="text-white text-lg mb-4">Please sign in to volunteer for this project</p>
                                        </div>
                                        <a href="{{ route('login') }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            Sign In
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-10 text-center max-w-3xl mx-auto border border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">No active volunteering projects</h2>
                <div class="w-16 h-1 bg-yellow-500 mx-auto mb-6"></div>
                <p class="text-gray-300 mb-8 max-w-lg mx-auto">Check back soon for new opportunities to volunteer and make a difference in our community.</p>
                <a href="#" class="inline-flex items-center bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Homepage
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Ready to Make a Difference?</h2>
        <p class="text-gray-400 mb-8 max-w-2xl mx-auto">Join our team of dedicated volunteers and help us create positive change in our community.</p>
        
        @if(count($projects) > 0)
            @auth
                @if(!$hasVolunteeredForAny)
                    <a href="#current-project" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-lg transition">
                        Volunteer Now
                    </a>
                @else
                    <div class="text-white">Thanks for volunteering with us!</div>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-lg transition">
                    Sign In to Volunteer
                </a>
            @endauth
        @else
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-lg transition">
                Sign Up for Updates
            </a>
        @endif
    </div>
</section>
@endsection