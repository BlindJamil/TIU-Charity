@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Hero Section with Two Options - Improved Consistency -->
<section class="pt-16 bg-cover bg-center min-h-screen flex items-center justify-center relative" style="background-image: url('{{ asset('assets/img/Home-Hero.jpg') }}');">
  <!-- Dark Overlay -->
  <div class="absolute inset-0 bg-black bg-opacity-70"></div>
  
  <div class="relative z-10 text-center px-4 py-20 max-w-6xl mx-auto">
      <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white leading-tight">Together for a Better Future</h1>
      <p class="text-xl md:text-2xl mb-12 text-gray-300 max-w-3xl mx-auto">Choose how you want to make a difference today. Every contribution, whether time or resources, helps us create lasting positive change.</p>
      
      <!-- Two Option Cards - Made Consistent -->
      <div class="flex flex-col md:flex-row justify-center gap-8 mt-8">
          <!-- Donate Option -->
          <div class="bg-gray-900 bg-opacity-80 p-8 rounded-xl shadow-xl border border-gray-700 flex flex-col items-center max-w-md w-full md:w-1/2 transition-transform hover:transform hover:scale-105">
              <div class="rounded-full bg-yellow-500 p-5 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
              </div>
              <h2 class="text-3xl font-bold text-white mb-4">Donate Now</h2>
              <p class="text-gray-300 mb-8 text-center flex-grow">Your financial support enables us to fund critical projects and provide resources where they're needed most.</p>
              <a href="{{ route('cause') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 px-8 rounded-lg shadow-lg transition duration-300 w-full text-center">
                  Make a Donation
              </a>
          </div>
          
          <!-- Volunteer Option -->
          <div class="bg-gray-900 bg-opacity-80 p-8 rounded-xl shadow-xl border border-gray-700 flex flex-col items-center max-w-md w-full md:w-1/2 transition-transform hover:transform hover:scale-105">
              <div class="rounded-full bg-yellow-500 p-5 mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
              </div>
              <h2 class="text-3xl font-bold text-white mb-4">Volunteer</h2>
              <p class="text-gray-300 mb-8 text-center flex-grow">Contribute your time and skills to help others. Join our community of volunteers making a direct impact.</p>
              <a href="{{ route('volunteer') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 px-8 rounded-lg shadow-lg transition duration-300 w-full text-center">
                  Become a Volunteer
              </a>
          </div>
      </div>
      
      <!-- Stats Counter -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 max-w-4xl mx-auto bg-gray-900 bg-opacity-70 rounded-lg px-4 py-8 border border-gray-700">
          <div class="text-center">
              <p class="text-3xl font-bold text-yellow-500 mb-1">$50K+</p>
              <p class="text-sm text-gray-300">Funds Raised</p>
          </div>
          <div class="text-center">
              <p class="text-3xl font-bold text-yellow-500 mb-1">200+</p>
              <p class="text-sm text-gray-300">Volunteers</p>
          </div>
          <div class="text-center">
              <p class="text-3xl font-bold text-yellow-500 mb-1">50+</p>
              <p class="text-sm text-gray-300">Projects</p>
          </div>
          <div class="text-center">
              <p class="text-3xl font-bold text-yellow-500 mb-1">100+</p>
              <p class="text-sm text-gray-300">Communities Helped</p>
          </div>
      </div>
  </div>
</section>



@endsection