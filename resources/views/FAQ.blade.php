@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black text-white t-20">
    <!-- About Page Hero Section with improved overlay and spacing -->
<section class="relative bg-gray-900 text-white pt-24">
    <!-- Background Image with better overlay -->
    <div class="bg-cover bg-center h-96 relative" style="background-image: url('{{asset('assets/img/abou2.jpg')}}');">
        <!-- Dark overlay for better text visibility -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Text Overlay with improved typography and spacing -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 lg:px-0">
                <span class="inline-block px-4 py-1 bg-yellow-500 text-black text-sm font-semibold rounded-full mb-4">FAQ</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">frequently asked questions</h1>
                <p class="text-lg text-gray-300 leading-relaxed max-w-3xl mx-auto">
                    Find answers to common questions about our services, policies, and more.
                </p>                
            </div>
        </div>
    </div>
</section>

    <div class="max-w-4xl mx-auto py-20 px-6">
        <!-- Search Bar -->
        <div class="mb-12">
            <div class="relative">
                <input type="text" id="faq-search" class="w-full bg-gray-800 border border-gray-700 rounded-lg py-3 px-5 pl-12 text-white focus:outline-none focus:border-yellow-500" placeholder="Search for questions...">
                <div class="absolute left-4 top-3.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="flex overflow-x-auto pb-4 mb-8 gap-4 hide-scroll">
            <button class="category-button active whitespace-nowrap px-5 py-2 rounded-full bg-yellow-500 text-black font-medium focus:outline-none" data-category="all">All Questions</button>
            <button class="category-button whitespace-nowrap px-5 py-2 rounded-full bg-gray-700 text-white font-medium focus:outline-none hover:bg-gray-600" data-category="general">General</button>
            <button class="category-button whitespace-nowrap px-5 py-2 rounded-full bg-gray-700 text-white font-medium focus:outline-none hover:bg-gray-600" data-category="donations">Donations</button>
            <button class="category-button whitespace-nowrap px-5 py-2 rounded-full bg-gray-700 text-white font-medium focus:outline-none hover:bg-gray-600" data-category="volunteering">Volunteering</button>
            <button class="category-button whitespace-nowrap px-5 py-2 rounded-full bg-gray-700 text-white font-medium focus:outline-none hover:bg-gray-600" data-category="impact">Our Impact</button>
        </div>

        <div class="space-y-6">
            <!-- General Questions -->
            <div class="faq-item" data-category="general">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">What is this charity about?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Our charity is dedicated to empowering communities, promoting positive change, and inspiring hope through meaningful initiatives. We focus on supporting education, healthcare, and sustainable development in underserved communities.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="general">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">How did your organization start?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Our organization was founded in 2017 by a group of passionate individuals who recognized the need for community-driven solutions to local challenges. What began as a small helpline has grown into a substantial charity with initiatives spanning education, healthcare, and community development.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="general">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">Is your organization registered as a nonprofit?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Yes, we are a registered nonprofit organization. All donations are tax-deductible to the full extent allowed by law. Our financial records and annual reports are available for public viewing to ensure complete transparency.
                    </p>
                </div>
            </div>

            <!-- Donation Questions -->
            <div class="faq-item" data-category="donations">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">How can I donate?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        You can donate by selecting a cause on our website, choosing a payment method (FIB or FastPay), and following the instructions on the donation page. You can also set up recurring donations to provide ongoing support to our projects.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="donations">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">Is my donation secure?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Yes, we use industry-standard encryption and secure payment gateways to process all donations. Your personal and financial information is protected and never shared with third parties.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="donations">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">How is my donation used?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Your donation directly supports the cause you select. At least 85% of all donations go directly to program services, with the remainder used for administration and fundraising efforts. We provide transparent reporting on our website and in our annual reports to show exactly how funds are utilized.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="donations">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">Can I get a receipt for my donation?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Yes, you will automatically receive a receipt via email after making a donation. If you need additional documentation for tax purposes, please contact us and we'll be happy to assist you.
                    </p>
                </div>
            </div>

            <!-- Volunteering Questions -->
            <div class="faq-item" data-category="volunteering">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">How do I become a volunteer?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        To become a volunteer, create an account on our website, visit the volunteer page, and apply for the current project. After submitting your application, our team will review it and get back to you regarding your approval status.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="volunteering">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">What skills are needed to volunteer?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        We welcome volunteers with diverse skills and experiences. Different projects may require different skills, but the most important qualities are commitment, reliability, and a passion for helping others. Specific skill requirements will be listed in each volunteer project description.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="volunteering">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">Is there a minimum time commitment for volunteers?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        Time commitments vary by project. Some projects may require a few hours, while others might need a commitment over several weeks or months. The time requirement will be clearly stated in each project description so you can find opportunities that fit your schedule.
                    </p>
                </div>
            </div>

            <!-- Impact Questions -->
            <div class="faq-item" data-category="impact">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">How do you measure the impact of your programs?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        We use a combination of quantitative and qualitative methods to measure our impact. This includes tracking the number of beneficiaries served, conducting surveys and interviews, and collecting case studies. We regularly publish impact reports that detail the outcomes and long-term effects of our programs.
                    </p>
                </div>
            </div>

            <div class="faq-item" data-category="impact">
                <button class="w-full text-left flex justify-between items-center p-5 bg-gray-800 rounded-lg hover:bg-gray-750 focus:outline-none faq-toggle">
                    <span class="font-semibold text-lg">What communities do you serve?</span>
                    <svg class="faq-icon w-5 h-5 text-yellow-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer hidden mt-2 p-5 bg-gray-750 rounded-lg">
                    <p class="text-gray-300">
                        We primarily serve underrepresented and vulnerable communities in both urban and rural areas. Our focus includes supporting education initiatives for children, providing resources for families in need, and developing sustainable community improvement projects.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }
    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .bg-gray-750 {
        background-color: rgba(31, 41, 55, 0.8);
    }
</style>
@endsection