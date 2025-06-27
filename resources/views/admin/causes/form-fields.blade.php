<!-- Cause Title -->
<div class="mb-4">
    <label for="title" class="block text-gray-300 text-sm font-bold mb-2">Cause Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $cause->title ?? '') }}" 
           class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
           required>
    @error('title')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Cause Description -->
<div class="mb-4">
    <label for="description" class="block text-gray-300 text-sm font-bold mb-2">Description</label>
    <textarea name="description" id="description" rows="5" 
              class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
              required>{{ old('description', $cause->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Funding Goal -->
<div class="mb-4">
    <label for="goal" class="block text-gray-300 text-sm font-bold mb-2">Funding Goal ($)</label>
    <input type="number" name="goal" id="goal" value="{{ old('goal', $cause->goal ?? '') }}" 
           class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
           required min="1" step="0.01">
    @error('goal')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Receipt Expiration Days -->
<div class="mb-4">
    <label for="receipt_expiry_days" class="block text-gray-300 text-sm font-bold mb-2">Receipt Expiration (Days)</label>
    <div class="flex items-center">
        <input type="number" name="receipt_expiry_days" id="receipt_expiry_days" 
               value="{{ old('receipt_expiry_days', $cause->receipt_expiry_days ?? 7) }}" 
               class="w-24 p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
               required min="1" max="90">
        <p class="ml-3 text-gray-400 text-sm">Number of days the donation receipt remains valid</p>
    </div>
    @error('receipt_expiry_days')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Cause Image -->
<div class="mb-4">
    <label for="image" class="block text-gray-300 text-sm font-bold mb-2">Cause Image</label>
    @if(isset($cause) && $cause->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $cause->image) }}" alt="{{ $cause->title }}" class="h-40 rounded-lg">
        <p class="text-gray-400 text-xs mt-1">Current image</p>
    </div>
    @endif
    <input type="file" name="image" id="image" 
           class="w-full p-3 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
           {{ isset($cause) ? '' : 'required' }}>
    @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Cause Type Selection -->
<div class="mb-4">
    <label class="block text-gray-300 text-sm font-bold mb-2">Cause Type</label>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <label class="flex items-center p-4 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-650">
            <input type="radio" name="cause_type" value="general" 
                   {{ old('cause_type', $cause->is_recent ?? true ? '' : 'checked') }} required
                   class="mr-2 text-yellow-500 focus:ring-yellow-500 h-4 w-4">
            <div>
                <span class="text-white font-medium">Donation Field Item</span>
                <p class="text-sm text-gray-400">Displayed in the main donation field section</p>
            </div>
        </label>
        
        <label class="flex items-center p-4 bg-gray-700 rounded-lg border border-gray-600 cursor-pointer hover:bg-gray-650">
            <input type="radio" name="cause_type" value="recent" 
                   {{ old('cause_type', $cause->is_recent ?? false ? 'checked' : '') }} required
                   class="mr-2 text-yellow-500 focus:ring-yellow-500 h-4 w-4">
            <div>
                <span class="text-white font-medium">Recent Campaign</span>
                <p class="text-sm text-gray-400">Featured in the recent campaigns section</p>
            </div>
        </label>
    </div>
    @error('cause_type')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Is Urgent (Only for Recent Campaigns) -->
<div id="urgentOptions" class="mb-4 p-4 bg-gray-700 rounded-lg border border-gray-600 {{ old('cause_type', $cause->is_recent ?? false ? '' : 'hidden') }}">
    <label class="flex items-center">
        <input type="checkbox" name="is_urgent" id="is_urgent" 
               {{ old('is_urgent', $cause->is_urgent ?? false ? 'checked' : '') }}
               class="mr-2 rounded bg-gray-800 border-gray-600 text-yellow-500 focus:ring-yellow-500">
        <div>
            <span class="text-white font-medium">Mark as Urgent</span>
            <p class="text-sm text-gray-400">Highlight this cause as requiring immediate attention</p>
        </div>
    </label>
</div>

<!-- JavaScript to show/hide urgent options based on cause type -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const causeTypeRadios = document.querySelectorAll('input[name="cause_type"]');
        const urgentOptions = document.getElementById('urgentOptions');
        
        causeTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'recent') {
                    urgentOptions.classList.remove('hidden');
                } else {
                    urgentOptions.classList.add('hidden');
                }
            });
        });
    });
</script>