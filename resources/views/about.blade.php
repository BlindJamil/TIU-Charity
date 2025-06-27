@extends('layouts.app')

@section('title', 'About Us')

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
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">Our Story</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">About Us</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Our mission is to empower communities, promote change, and inspire hope through meaningful initiatives and dedicated efforts.
                </p>
            </div>
        </div>
    </div>
</section>
  
<!-- Mission & Vision Section with improved layout -->
<section id="about" class="py-20 md:py-32 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16">
        <!-- Mission Section with better spacing and image treatment -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mb-20">
            <div class="order-2 lg:order-1">
                <span class="text-yellow-500 font-bold uppercase tracking-wider">Our Purpose</span>
                <h2 class="text-3xl md:text-4xl text-white font-bold mt-2 mb-6">Our Mission</h2>
                <p class="text-gray-400 text-lg mb-6 leading-relaxed">
                    Our central goal is to create enduring and positive change in the lives of street youths, working children, and those at risk through innovative approaches and sustainable programs. We strive to build a foundation of support that addresses immediate needs while fostering long-term development and opportunity.
                </p>
                <div class="flex flex-wrap gap-4 mt-6">
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Community Development</span>
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Education Access</span>
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Health Initiatives</span>
                </div>
            </div>
            <div class="order-1 lg:order-2 transform lg:translate-x-10">
                <div class="w-full h-80 md:h-96 rounded-lg overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="{{ asset('assets/img/donation1.jpg') }}" alt="Our Mission" class="w-full h-full object-cover object-center">
                </div>
            </div>
        </div>

        <!-- Vision Section with better spacing and image treatment -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center mt-10">
            <div class="transform lg:-translate-x-10">
                <div class="w-full h-80 md:h-96 rounded-lg overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="{{ asset('assets/img/donation3.jpg') }}" alt="Our Vision" class="w-full h-full object-cover object-center">
                </div>
            </div>
            <div>
                <span class="text-yellow-500 font-bold uppercase tracking-wider">Our Aspiration</span>
                <h2 class="text-3xl md:text-4xl text-white font-bold mt-2 mb-6">Our Vision</h2>
                <p class="text-gray-400 text-lg mb-6 leading-relaxed">
                    We envision a world where every child and young person has access to the resources, support, and opportunities they need to thrive and reach their full potential. Our vision is to create self-sustaining communities where education, health, and economic empowerment work together to break cycles of poverty and create lasting positive change.
                </p>
                <div class="flex flex-wrap gap-4 mt-6">
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Global Impact</span>
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Sustainable Solutions</span>
                    <span class="px-4 py-2 bg-gray-800 rounded-full text-sm text-gray-300">Equal Opportunity</span>
                </div>
            </div>
        </div>
    </div>
</section>
 
<!-- Stats Section - NEW -->
<section class="py-16 bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-yellow-500 font-bold uppercase tracking-wider">Our Impact</span>
            <h2 class="text-3xl md:text-4xl text-white font-bold mt-2">Making A Difference</h2>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-gray-900 rounded-lg p-8 text-center transform hover:-translate-y-2 transition duration-300">
                <span class="text-4xl font-extrabold text-yellow-500 block mb-2">50K+</span>
                <p class="text-lg text-white">People Helped</p>
            </div>
            <div class="bg-gray-900 rounded-lg p-8 text-center transform hover:-translate-y-2 transition duration-300">
                <span class="text-4xl font-extrabold text-yellow-500 block mb-2">200+</span>
                <p class="text-lg text-white">Volunteers</p>
            </div>
            <div class="bg-gray-900 rounded-lg p-8 text-center transform hover:-translate-y-2 transition duration-300">
                <span class="text-4xl font-extrabold text-yellow-500 block mb-2">50+</span>
                <p class="text-lg text-white">Projects</p>
            </div>
            <div class="bg-gray-900 rounded-lg p-8 text-center transform hover:-translate-y-2 transition duration-300">
                <span class="text-4xl font-extrabold text-yellow-500 block mb-2">20+</span>
                <p class="text-lg text-white">Countries</p>
            </div>
        </div>
    </div>
</section>

<!-- History Timeline with improved visual design - dots positioned properly -->
<section id="history" class="py-20 md:py-24 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <span class="text-yellow-500 font-bold uppercase tracking-wider">Our Journey</span>
            <h2 class="text-3xl md:text-4xl text-white font-bold mt-2">Our History</h2>
            <p class="mt-4 text-gray-400 max-w-2xl mx-auto">Follow our journey from a small local initiative to an organization making a meaningful impact around the world.</p>
        </div>
        
        <div class="relative">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative">
                <!-- Event 1 -->
                <div class="bg-gray-800 rounded-xl p-6 relative shadow-lg border border-gray-700 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <span class="inline-block px-3 py-1 bg-gray-700 text-yellow-500 rounded-full text-sm font-semibold mb-4">2017</span>
                    <h3 class="text-xl font-bold text-white mb-3">Helpline Established</h3>
                    <p class="text-gray-400">
                        We started to help individuals and causes in our local neighborhood by establishing our first helpline, connecting people in need with essential resources and support.
                    </p>
                </div>
                
                <!-- Event 2 -->
                <div class="bg-gray-800 rounded-xl p-6 relative shadow-lg border border-gray-700 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <span class="inline-block px-3 py-1 bg-gray-700 text-yellow-500 rounded-full text-sm font-semibold mb-4">2019</span>
                    <h3 class="text-xl font-bold text-white mb-3">Community Owned</h3>
                    <p class="text-gray-400">
                        Our initiatives gained significant support from the local community, fostering a sense of shared ownership and allowing us to expand our impact and reach more people in need.
                    </p>
                </div>
                
                <!-- Event 3 -->
                <div class="bg-gray-800 rounded-xl p-6 relative shadow-lg border border-gray-700 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <span class="inline-block px-3 py-1 bg-gray-700 text-yellow-500 rounded-full text-sm font-semibold mb-4">2021</span>
                    <h3 class="text-xl font-bold text-white mb-3">Charity of the Year</h3>
                    <p class="text-gray-400">
                        Recognized as Charity of the Year for our relentless commitment to helping others and innovative approach to community development programs.
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 relative mt-8 md:mt-16">
                <!-- Event 4 -->
                <div class="bg-gray-800 rounded-xl p-6 relative shadow-lg border border-gray-700 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <span class="inline-block px-3 py-1 bg-gray-700 text-yellow-500 rounded-full text-sm font-semibold mb-4">2020</span>
                    <h3 class="text-xl font-bold text-white mb-3">Fully Granted</h3>
                    <p class="text-gray-400">
                        Secured full grants to expand our efforts and reach more individuals in need, establishing partnerships with major donors and foundations to support our mission.
                    </p>
                </div>
                
                <!-- Event 5 -->
                <div class="bg-gray-800 rounded-xl p-6 relative shadow-lg border border-gray-700 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <span class="inline-block px-3 py-1 bg-gray-700 text-yellow-500 rounded-full text-sm font-semibold mb-4">2023</span>
                    <h3 class="text-xl font-bold text-white mb-3">Global Expansion</h3>
                    <p class="text-gray-400">
                        Expanded our initiatives across international borders, bringing our vision to communities in need around the world through coordinated partnerships and programs.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section - NEW -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6 lg:px-16">
        <div class="text-center mb-16">
            <span class="text-yellow-500 font-bold uppercase tracking-wider">Meet Our Team</span>
            <h2 class="text-3xl md:text-4xl text-white font-bold mt-2 mb-4">The People Behind Our Mission</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Our dedicated team of professionals work tirelessly to make our vision a reality.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg group">
                <div class="relative overflow-hidden h-72">
                    <img src="{{ asset('assets/img/2c1072de-73a2-4a16-a552-79825a915ce9.jpg') }}" alt="Team Member" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition duration-300"></div>
                </div>
                
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-white mb-1">Blind Jamil Sabri</h3>
                    <p class="text-yellow-500 mb-4">Lead Programmer</p>
                    <p class="text-gray-400 text-sm mb-4">A talented programmer who overcame visual impairment to become an inspiration in tech accessibility and inclusive development.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fillRule="evenodd" clipRule="evenodd"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Repeat for team members 2-4 -->
            <!-- Team Member 2 -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg group">
                <div class="relative overflow-hidden h-72">
                    <img src="{{ asset('assets/img/rshrsh.jpg') }}" alt="Team Member" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-white mb-1">Rashwan A. Abduljabar</h3>
                    <p class="text-yellow-500 mb-4">Team Leader & Manager</p>
                    <p class="text-gray-400 text-sm mb-4">A visionary leader with extensive experience in project management and team coordination, driving our initiatives forward with strategic insight and dedication.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fillRule="evenodd" clipRule="evenodd"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional team members would be added here -->
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg group">
                <div class="relative overflow-hidden h-72">
                    <img src="{{ asset('assets/img/download.jpg') }}" alt="Team Member" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-white mb-1">Avin Sabri</h3>
                    <p class="text-yellow-500 mb-4">Designer</p>
                    <p class="text-gray-400 text-sm mb-4">A creative designer with a keen eye for aesthetics and user experience, bringing innovative design solutions to our digital presence and brand identity.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fillRule="evenodd" clipRule="evenodd"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg group">
                <div class="relative overflow-hidden h-72">
                    <img src="{{ asset('assets/img/profile_photo-400x400.jpg') }}" alt="Team Member" class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition duration-300"></div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-white mb-1">Dr. Hala Najwan</h3>
                    <p class="text-yellow-500 mb-4">Project Supervisor</p>
                    <p class="text-gray-400 text-sm mb-4">An experienced academic supervisor and mentor with expertise in project management and research methodology, providing valuable guidance and oversight to ensure project success.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fillRule="evenodd" clipRule="evenodd"></path></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-yellow-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black relative overflow-hidden">
    <div class="container mx-auto px-6 lg:px-16 relative z-10">
        <div class="bg-gray-800 rounded-xl p-10 md:p-16 shadow-2xl border border-gray-700">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl text-white font-bold mb-6">Join Our Mission Today</h2>
                <p class="text-gray-300 max-w-2xl mx-auto mb-8">
                    Together, we can make a real difference in the lives of those who need it most. Join us in our mission to create a better, more equitable world.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('volunteer') }}" class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-lg transition duration-300 transform hover:-translate-y-1">
                        Become a Volunteer
                    </a>
                    <a href="{{ route('cause') }}" class="px-8 py-3 bg-transparent border-2 border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-black font-bold rounded-lg transition duration-300 transform hover:-translate-y-1">
                        Donate Now
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Abstract Shape -->
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-yellow-500 rounded-full opacity-10"></div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-yellow-500 rounded-full opacity-10"></div>
</section>

@endsection