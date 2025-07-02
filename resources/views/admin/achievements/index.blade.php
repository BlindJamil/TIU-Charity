@extends('admin.layout')

@section('title', 'Manage Achievements')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold mb-2 text-gray-200">Achievements Management</h1>
                <p class="text-gray-400">Manage completed projects and showcase your impact</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.achievements.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New Achievement
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Achievements</p>
                        <p class="text-2xl font-semibold text-white">{{ $achievements->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Active Projects</p>
                        <p class="text-2xl font-semibold text-white">{{ $achievements->where('status', 'active')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Featured</p>
                        <p class="text-2xl font-semibold text-white">{{ $achievements->where('is_featured', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-400">Total Funds</p>
                        <p class="text-2xl font-semibold text-white">${{ number_format($achievements->sum('amount'), 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievements Table -->
        <div class="bg-gray-800 shadow-md rounded-lg border border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-700">
                <h2 class="text-lg font-semibold text-white">All Achievements</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="text-left p-4 text-gray-300 font-medium">Project</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Category</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Amount</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Date</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Status</th>
                            <th class="text-left p-4 text-gray-300 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($achievements as $achievement)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gray-700 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($achievement->main_image)
                                            <img src="{{ $achievement->main_image_url }}" alt="{{ $achievement->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-600 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-white font-medium">{{ $achievement->title }}</h3>
                                        <p class="text-gray-400 text-sm">{{ Str::limit($achievement->description, 50) }}</p>
                                        <div class="flex items-center mt-1">
                                            @if($achievement->is_featured)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-900 text-yellow-200 mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                    </svg>
                                                    Featured
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                    {{ $achievement->category }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="text-white font-medium">${{ number_format($achievement->amount, 0) }}</span>
                            </td>
                            <td class="p-4">
                                <span class="text-gray-300">{{ $achievement->formatted_completion_date }}</span>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $achievement->status === 'active' ? 'bg-green-900 text-green-200' : 'bg-red-900 text-red-200' }}">
                                    {{ ucfirst($achievement->status) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.achievements.show', $achievement) }}" 
                                       class="text-blue-400 hover:text-blue-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.achievements.edit', $achievement) }}" 
                                       class="text-yellow-400 hover:text-yellow-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    
                                    <!-- Toggle Status -->
                                    <form action="{{ route('admin.achievements.toggle-status', $achievement) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-gray-400 hover:text-gray-300 transition" title="Toggle Status">
                                            @if($achievement->status === 'active')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <!-- Toggle Featured -->
                                    <form action="{{ route('admin.achievements.toggle-featured', $achievement) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-gray-400 hover:text-yellow-400 transition" title="Toggle Featured">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $achievement->is_featured ? 'text-yellow-400' : '' }}" fill="{{ $achievement->is_featured ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </button>
                                    </form>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this achievement? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">No achievements found</p>
                                    <p class="text-sm text-gray-500 mt-1">Get started by creating your first achievement</p>
                                    <a href="{{ route('admin.achievements.create') }}" 
                                       class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-lg transition duration-150 ease-in-out">
                                        Add New Achievement
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($achievements->hasPages())
            <div class="p-6 border-t border-gray-700">
                {{ $achievements->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection