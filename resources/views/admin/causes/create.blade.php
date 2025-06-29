@extends('admin.layout')

@section('title', 'Create Campaign')

@section('content')
<div class="bg-gray-900 min-h-screen text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-xl sm:text-2xl font-medium leading-6 text-white">Create New Campaign</h2>
                <p class="mt-1 text-sm text-gray-500">Add a new campaign to support your fundraising efforts. Urgent and active campaigns will appear in the Recent Campaigns section.</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('admin.causes.index') }}" class="text-yellow-500 hover:text-yellow-300 text-sm">
                    ← Back to Campaigns
                </a>
            </div>
        </div>

        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               class="w-full p-3 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full p-3 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Goal Amount ($)</label>
                        <input type="number" name="goal" value="{{ old('goal') }}" step="0.01" 
                               class="w-full p-3 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        @error('goal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Campaign Image</label>
                        <input type="file" name="image" 
                               class="w-full p-3 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-orange-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-yellow-500 hover:file:bg-gray-500">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Department</label>
                        <input type="text" name="department" value="{{ old('department') }}"
                               class="w-full p-3 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        @error('department')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-3">Campaign Type</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex items-start p-4 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-650 transition-colors">
                                <input type="radio" name="cause_type" value="general" {{ old('cause_type') === 'general' ? 'checked' : '' }} 
                                       class="mt-1 text-yellow-500 bg-gray-700 border-gray-600 focus:ring-yellow-500" id="general_cause">
                                <div class="ml-3">
                                    <span class="text-gray-300 font-medium">Donation Field Item</span>
                                    <p class="text-sm text-gray-400 mt-1">Displayed in the main donation field section</p>
                                </div>
                            </label>
                            <label class="flex items-start p-4 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-650 transition-colors">
                                <input type="radio" name="cause_type" value="recent" {{ old('cause_type') === 'recent' ? 'checked' : '' }} 
                                       class="mt-1 text-yellow-500 bg-gray-700 border-gray-600 focus:ring-yellow-500" id="recent_cause">
                                <div class="ml-3">
                                    <span class="text-gray-300 font-medium">Recent Campaign</span>
                                    <p class="text-sm text-gray-400 mt-1">Featured in the recent campaigns section</p>
                                </div>
                            </label>
                        </div>
                        @error('cause_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-700 rounded-lg p-4 border border-gray-600" id="urgent_option" style="{{ old('cause_type') === 'recent' ? '' : 'display: none;' }}">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_urgent" {{ old('is_urgent') ? 'checked' : '' }} 
                                   class="mr-3 rounded bg-gray-700 border-gray-600 text-red-400 focus:ring-red-500">
                            <div>
                                <span class="text-gray-300 font-medium">Mark as Urgent</span>
                                <p class="text-sm text-gray-400 mt-1">Select this option if this donation requires immediate attention. An "Urgent" badge will be displayed.</p>
                            </div>
                        </label>
                    </div>

                    <!-- Receipt Expiration Days -->
                    <div>
                        <label for="receipt_expiry_days" class="block text-gray-300 text-sm font-medium mb-2">Receipt Expiration (Days)</label>
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <input type="number" name="receipt_expiry_days" id="receipt_expiry_days" 
                                   value="{{ old('receipt_expiry_days', 7) }}" 
                                   class="w-full sm:w-24 p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                   required min="1" max="90">
                            <p class="mt-2 sm:mt-0 sm:ml-3 text-gray-400 text-sm">Number of days the donation receipt remains valid</p>
                        </div>
                        @error('receipt_expiry_days')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                        <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-medium">
                            Create Campaign
                        </button>
                        <a href="{{ route('admin.causes.index') }}" class="w-full sm:w-auto text-center bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition">
                            Cancel
                        </a>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-md mt-6">
                        <strong>Errors:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const generalCauseRadio = document.getElementById('general_cause');
        const recentCauseRadio = document.getElementById('recent_cause');
        const urgentOption = document.getElementById('urgent_option');
        
        // Function to toggle urgent option visibility
        function toggleUrgentOption() {
            if (recentCauseRadio.checked) {
                urgentOption.style.display = 'block';
            } else {
                urgentOption.style.display = 'none';
                // Also uncheck the urgent checkbox if not a recent cause
                const urgentCheckbox = document.querySelector('input[name="is_urgent"]');
                if (urgentCheckbox) {
                    urgentCheckbox.checked = false;
                }
            }
        }
        
        // Add event listeners
        if (generalCauseRadio) generalCauseRadio.addEventListener('change', toggleUrgentOption);
        if (recentCauseRadio) recentCauseRadio.addEventListener('change', toggleUrgentOption);
        
        // Initialize on page load
        toggleUrgentOption();
    });
</script>
@endsection