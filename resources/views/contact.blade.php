@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gray-900 text-white pt-8 md:pt-12">
    <!-- Background Image with Overlay -->
    <div class="bg-cover bg-center h-72 relative" style="background-image: url('{{asset('assets/img/abou2.jpg')}}');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
        
        <!-- Text Overlay -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 lg:px-0">
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">Get In Touch</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Have questions or want to get involved? We're here to help.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-6">Let's Connect</h2>
                    <p class="text-gray-400 mb-8">
                        Whether you have questions about our initiatives, want to volunteer, or are interested in supporting our mission, we'd love to hear from you. Fill out the form or reach us through any of the contact methods below.
                    </p>
                </div>
                
                <!-- Contact Details -->
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-12 w-12 bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1">Our Address</h3>
                            <p class="text-gray-400">Tishk International University</p>
                            <p class="text-gray-400">Erbil, Kurdistan</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-12 w-12 bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1">Email Us</h3>
                            <p class="text-gray-400">info@tishk.edu.iq</p>
                            <p class="text-gray-400">contact@tishk.edu.iq</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-12 w-12 bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1">Call Us</h3>
                            <p class="text-gray-400">Mobile: +964 (750) 749-8920</p>
                            <p class="text-gray-400">Mobile: +964 (782) 441-2345</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-12 w-12 bg-gray-800 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-1">Working Hours</h3>
                            <p class="text-gray-400">Sunday - Thursday: 8:30 - 16:30</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
<div class="bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-700">
    <h2 class="text-2xl font-bold text-white mb-6">Send Us a Message</h2>
    
    @if(session('success'))
        <div class="bg-green-900 text-green-100 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Your Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="John Doe">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Your Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="john@example.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-300 mb-1">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                placeholder="How can we help you?">
            @error('subject')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="message" class="block text-sm font-medium text-gray-300 mb-1">Your Message</label>
            <textarea id="message" name="message" rows="5" required
                class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('message') border-red-500 @enderror"
                placeholder="Write your message here...">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="privacy" name="privacy" type="checkbox" required
                    class="h-4 w-4 bg-gray-700 border-gray-600 rounded text-yellow-500 focus:ring-yellow-500 @error('privacy') border-red-500 @enderror">
            </div>
            <div class="ml-3 text-sm">
                <label for="privacy" class="text-gray-400">I agree to the <a href="{{ route('privacy.policy') }}" class="text-yellow-500 hover:underline">Privacy Policy</a></label>
                @error('privacy')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <button type="submit" 
            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:-translate-y-1">
            Send Message
        </button>
    </form>
</div>
</section>

<!-- Map Section - Updated to Tishk International University in Erbil, Iraqi Kurdistan -->
<section class="py-12 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="rounded-xl overflow-hidden shadow-xl h-96">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12883.744236853316!2d43.94636660814284!3d36.168110546342625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40073d2c15034e2f%3A0x407f61799e38c2f3!2sTishk%20International%20University%20(TIU)!5e0!3m2!1sen!2siq!4v1741040442651!5m2!1sen!2siq" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<!-- FAQ Section - Always open without toggles -->
<section class="py-16 bg-gradient-to-r from-gray-800 via-gray-900 to-black">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Frequently Asked Questions</h2>
            <p class="text-gray-400">Find quick answers to common questions about contacting us.</p>
        </div>
        
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-3">How quickly will I receive a response?</h3>
                <p class="text-gray-400">
                    We strive to respond to all inquiries within 24-48 hours during business days. For urgent matters, please call our hotline number.
                </p>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-3">Can I visit your office in person?</h3>
                <p class="text-gray-400">
                    Yes, we welcome visitors during our regular business hours. However, we recommend scheduling an appointment in advance to ensure the relevant team members are available to assist you.
                </p>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-white mb-3">How can I volunteer for your organization?</h3>
                <p class="text-gray-400">
                    You can volunteer by filling out our contact form, specifying your interest in volunteering, or by visiting our <a href="{{ route('volunteer') }}" class="text-yellow-500 hover:underline">Volunteer page</a> for current opportunities.
                </p>
            </div>
        </div>
    </div>
</section>

<script>
    // Simple script to toggle FAQ answers
    document.addEventListener('DOMContentLoaded', function() {
        const faqButtons = document.querySelectorAll('.bg-gray-800.rounded-lg.overflow-hidden button');
        
        faqButtons.forEach(button => {
            button.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('svg');
                
                // Toggle answer visibility
                answer.classList.toggle('hidden');
                
                // Toggle icon rotation
                if (answer.classList.contains('hidden')) {
                    icon.classList.remove('transform', 'rotate-180');
                } else {
                    icon.classList.add('transform', 'rotate-180');
                }
            });
        });
    });
</script>
@endsection