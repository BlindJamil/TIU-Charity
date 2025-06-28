@extends('admin.layout')

@section('title', 'Manage Campaigns')

@section('content')
<div class="bg-gray-900 min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-2xl sm:text-3xl font-bold">Manage Campaigns</h1>
            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                <a href="{{ route('admin.causes.create') }}" class="w-full sm:w-auto text-center bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                    + Add New Campaign
                </a>
            @else
                <button disabled class="w-full sm:w-auto bg-gray-600 text-gray-400 px-4 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to create campaigns">
                    + Add New Campaign
                </button>
            @endif
        </div>

        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <!-- Mobile Cards View -->
            <div class="block lg:hidden">
                @foreach ($causes as $cause)
                    <div class="border-b border-gray-700 last:border-b-0">
                        <div class="p-4 sm:p-6">
                            <div class="flex items-start space-x-4">
                                <div class="h-16 w-16 sm:h-20 sm:w-20 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $cause->image) }}" alt="Campaign Image" class="w-full h-full rounded-md object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-medium text-white truncate">{{ $cause->title }}</h3>
                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm text-orange-400">Goal: ${{ number_format($cause->goal, 2) }}</p>
                                        <p class="text-sm text-yellow-400">Raised: ${{ number_format($cause->raised, 2) }}</p>
                                    </div>
                                    <div class="mt-3 flex flex-wrap gap-1">
                                        @if($cause->is_recent)
                                            <span class="inline-flex items-center bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
                                                Recent
                                            </span>
                                        @endif
                                        
                                        @if($cause->is_urgent)
                                            <span class="inline-flex items-center bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                                Urgent
                                            </span>
                                        @endif
                                        
                                        @if(!$cause->is_recent && !$cause->is_urgent)
                                            <span class="inline-flex items-center bg-gray-600 text-white px-2 py-1 rounded-full text-xs">
                                                General
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                    <a href="{{ route('admin.causes.edit', $cause->id) }}" class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition">Edit</a>
                                    <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to edit campaigns">Edit</button>
                                    <button disabled class="flex-1 bg-gray-600 text-gray-400 px-3 py-2 rounded-md cursor-not-allowed opacity-50" title="You don't have permission to delete campaigns">Delete</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @if($causes->isEmpty())
                    <div class="p-6 text-center">
                        <p class="text-gray-400 mb-4">No campaigns found.</p>
                        @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                            <a href="{{ route('admin.causes.create') }}" class="text-green-500 hover:text-green-400 font-medium">Create your first campaign</a>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Image</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Title</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Goal Amount</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Raised</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="p-3 text-sm font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($causes as $cause)
                                <tr class="border-b border-gray-600 hover:bg-gray-700 transition-colors">
                                    <td class="p-3">
                                        <img src="{{ asset('storage/' . $cause->image) }}" alt="Campaign Image" class="w-16 h-16 rounded-md object-cover">
                                    </td>
                                    <td class="p-3 text-white">{{ $cause->title }}</td>
                                    <td class="p-3 text-orange-400 font-semibold">${{ number_format($cause->goal, 2) }}</td>
                                    <td class="p-3 text-yellow-400 font-semibold">${{ number_format($cause->raised, 2) }}</td>
                                    <td class="p-3">
                                        <div class="flex flex-wrap gap-1">
                                            @if($cause->is_recent)
                                                <span class="inline-flex items-center bg-blue-500 text-white px-2 py-1 rounded-full text-xs">
                                                    Recent
                                                </span>
                                            @endif
                                            
                                            @if($cause->is_urgent)
                                                <span class="inline-flex items-center bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                                                    Urgent
                                                </span>
                                            @endif
                                            
                                            @if(!$cause->is_recent && !$cause->is_urgent)
                                                <span class="inline-flex items-center bg-gray-600 text-white px-2 py-1 rounded-full text-xs">
                                                    General
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <div class="flex space-x-2">
                                            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                                <a href="{{ route('admin.causes.edit', $cause->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition text-sm">Edit</a>
                                                <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="bg-gray-600 text-gray-400 px-3 py-1 rounded-md cursor-not-allowed opacity-50 text-sm" title="You don't have permission to edit campaigns">Edit</button>
                                                <button disabled class="bg-gray-600 text-gray-400 px-3 py-1 rounded-md cursor-not-allowed opacity-50 text-sm" title="You don't have permission to delete campaigns">Delete</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($causes->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-400 mb-4">No campaigns found.</p>
                            @if(auth('admin')->user()->hasPermission('manage_campaigns'))
                                <a href="{{ route('admin.causes.create') }}" class="text-green-500 hover:text-green-400 font-medium">Create your first campaign</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection