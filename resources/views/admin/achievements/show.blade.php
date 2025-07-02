@extends('admin.layout')

@section('title', 'Achievement Details')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.achievements.index') }}" class="text-gray-400 hover:text-white transition mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-200 inline">Achievement Details</h1>
            </div>
            <div>
                <a href="{{ route('admin.achievements.edit', $achievement) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-lg transition">Edit</a>
            </div>
        </div>

        <!-- Main Image -->
        <div class="mb-8">
            <img src="{{ $achievement->main_image_url }}" alt="Main image" class="w-full h-64 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-bold text-white mb-2">{{ $achievement->title }}</h2>
            <div class="flex flex-wrap gap-2 mb-2">
                <span class="inline-block bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs font-medium">{{ $achievement->category }}</span>
                <span class="inline-block bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs font-medium">{{ $achievement->location }}</span>
                <span class="inline-block bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-xs font-medium">{{ $achievement->formatted_completion_date }}</span>
                @if($achievement->is_featured)
                    <span class="inline-block bg-yellow-700 text-yellow-200 px-3 py-1 rounded-full text-xs font-medium">Featured</span>
                @endif
                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $achievement->status === 'active' ? 'bg-green-900 text-green-200' : 'bg-red-900 text-red-200' }}">{{ ucfirst($achievement->status) }}</span>
            </div>
            <div class="text-lg text-yellow-400 font-bold mb-2">${{ number_format($achievement->amount, 0) }}</div>
            <div class="text-gray-300 mb-4">{{ $achievement->description }}</div>
        </div>

        <!-- Detailed Description -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Detailed Description</h3>
            <div class="text-gray-300 leading-relaxed">{!! nl2br(e($achievement->detailed_description)) !!}</div>
        </div>

        <!-- Impact Stats -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Impact Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="text-yellow-500 font-bold text-2xl">{{ $achievement->impact_stat_1_value }}</div>
                    <div class="text-gray-300 text-sm">{{ $achievement->impact_stat_1_label }}</div>
                </div>
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="text-yellow-500 font-bold text-2xl">{{ $achievement->impact_stat_2_value }}</div>
                    <div class="text-gray-300 text-sm">{{ $achievement->impact_stat_2_label }}</div>
                </div>
            </div>
            @if($achievement->detailed_stats)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($achievement->detailed_stats as $stat)
                <div class="bg-gray-700 rounded-lg p-4 mb-2">
                    <div class="text-yellow-500 font-bold text-lg">{{ $stat['value'] ?? '' }}</div>
                    <div class="text-gray-300 text-sm">{{ $stat['label'] ?? '' }}</div>
                    @if(!empty($stat['description']))
                        <div class="text-gray-400 text-xs mt-1">{{ $stat['description'] }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Financial Breakdown -->
        @if($achievement->financial_breakdown)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Financial Breakdown</h3>
            <div class="bg-gray-800 rounded-lg p-4">
                @foreach($achievement->financial_breakdown as $item)
                <div class="flex justify-between py-2 border-b border-gray-700 last:border-b-0">
                    <span class="text-gray-300">{{ $item['category'] ?? '' }}</span>
                    <span class="text-yellow-500 font-medium">${{ number_format($item['amount'] ?? 0, 0) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Accomplishments -->
        @if($achievement->accomplishments)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Project Accomplishments</h3>
            <ul class="list-disc list-inside text-gray-300">
                @foreach($achievement->accomplishments as $accomplishment)
                <li>{{ $accomplishment }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Gallery -->
        @if($achievement->gallery_photos)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Project Gallery</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($achievement->gallery_photos as $photo)
                <div class="bg-gray-700 rounded-lg overflow-hidden">
                    <img src="{{ $photo['url'] ?? $photo }}" alt="Gallery photo" class="w-full h-40 object-cover">
                    @if(!empty($photo['caption']))
                        <div class="text-gray-400 text-xs p-2">{{ $photo['caption'] }}</div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Testimonials -->
        @if($achievement->testimonials)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Testimonials</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($achievement->testimonials as $testimonial)
                <div class="bg-gray-700 rounded-lg p-6">
                    <p class="text-gray-300 italic mb-4">"{{ $testimonial['quote'] ?? '' }}"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-black font-bold mr-3">
                            {{ substr($testimonial['name'] ?? '', 0, 1) }}
                        </div>
                        <div>
                            <div class="text-white font-medium">{{ $testimonial['name'] ?? '' }}</div>
                            <div class="text-gray-400 text-sm">{{ $testimonial['role'] ?? '' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Documents -->
        @if($achievement->documents)
        <div class="mb-8">
            <h3 class="text-xl font-bold text-white mb-2">Project Documents</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($achievement->documents as $document)
                <a href="{{ $document['url'] ?? '#' }}" target="_blank" class="flex items-center bg-gray-700 rounded-lg p-4 hover:bg-gray-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div>
                        <div class="text-white font-medium">{{ $document['name'] ?? '' }}</div>
                        <div class="text-gray-400 text-sm">{{ $document['type'] ?? '' }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 