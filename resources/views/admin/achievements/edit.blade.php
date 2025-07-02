@extends('admin.layout')

@section('title', 'Edit Achievement')

@section('content')
<div class="p-4 sm:p-6 lg:p-8 bg-gray-900 min-h-screen text-white">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('admin.achievements.index') }}" class="text-gray-400 hover:text-white transition mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-200">Edit Achievement</h1>
            </div>
            <p class="text-gray-400">Update the details of this completed project</p>
        </div>

        <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" enctype="multipart/form-data" x-data="achievementForm()">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-700 text-white rounded-lg">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Basic Information -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <h2 class="text-xl font-bold text-white mb-6">Basic Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $achievement->title) }}" required
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category *</label>
                        <select name="category" id="category" required
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('category') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ old('category', $achievement->category) == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-300 mb-2">Location *</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $achievement->location) }}" required
                               placeholder="e.g., Nairobi, Kenya"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount Spent ($) *</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', $achievement->amount) }}" required min="0" step="0.01"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('amount') border-red-500 @enderror">
                        @error('amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="completion_date" class="block text-sm font-medium text-gray-300 mb-2">Completion Date *</label>
                        <input type="date" name="completion_date" id="completion_date" value="{{ old('completion_date', $achievement->completion_date->format('Y-m-d')) }}" required
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('completion_date') border-red-500 @enderror">
                        @error('completion_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="volunteers" class="block text-sm font-medium text-gray-300 mb-2">Volunteers *</label>
                        <input type="number" name="volunteers" id="volunteers" value="{{ old('volunteers', $achievement->volunteers ?? '') }}" required min="0"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('volunteers') border-red-500 @enderror">
                        @error('volunteers')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Short Description *</label>
                    <textarea name="description" id="description" rows="3" required maxlength="500"
                              placeholder="Brief description for the card view (max 500 characters)"
                              class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('description') border-red-500 @enderror">{{ old('description', $achievement->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-6">
                    <label for="detailed_description" class="block text-sm font-medium text-gray-300 mb-2">Detailed Description *</label>
                    <textarea name="detailed_description" id="detailed_description" rows="6" required
                              placeholder="Comprehensive description of the project, its impact, and implementation details"
                              class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 @error('detailed_description') border-red-500 @enderror">{{ old('detailed_description', $achievement->detailed_description) }}</textarea>
                    @error('detailed_description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Main Image -->
            @if($achievement->main_image)
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <h3 class="text-lg font-medium text-white mb-4">Current Main Image</h3>
                <div class="flex items-center space-x-4">
                    <img src="{{ $achievement->main_image_url }}" alt="Current main image" class="w-32 h-32 object-cover rounded-lg">
                    <div>
                        <p class="text-gray-300">Current main image for this achievement</p>
                        <p class="text-gray-400 text-sm">Upload a new image below to replace this one</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Impact Statistics -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <h2 class="text-xl font-bold text-white mb-6">Impact Statistics</h2>
                
                <!-- Basic Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Impact Stat 1 *</label>
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="impact_stat_1_value" placeholder="400" value="{{ old('impact_stat_1_value', $achievement->impact_stat_1_value) }}" required
                                   class="bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <input type="text" name="impact_stat_1_label" placeholder="Students" value="{{ old('impact_stat_1_label', $achievement->impact_stat_1_label) }}" required
                                   class="bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Impact Stat 2 *</label>
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="impact_stat_2_value" placeholder="15" value="{{ old('impact_stat_2_value', $achievement->impact_stat_2_value) }}" required
                                   class="bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <input type="text" name="impact_stat_2_label" placeholder="Teachers" value="{{ old('impact_stat_2_label', $achievement->impact_stat_2_label) }}" required
                                   class="bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Stats - Pre-populate with existing data -->
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="block text-sm font-medium text-gray-300">Detailed Impact Metrics</label>
                        <button type="button" @click="addDetailedStat()" 
                                class="text-yellow-500 hover:text-yellow-400 text-sm font-medium">
                            + Add Metric
                        </button>
                    </div>
                    <div class="mb-2 text-yellow-300 text-xs">
                        <strong>Tip:</strong> For the 'People Helped' stat to show on the public page, add a metric with a label like <b>People Helped</b>, <b>People Served</b>, or <b>Beneficiaries</b> and enter the number.
                    </div>
                    
                    <div id="detailed-stats-container">
                        <!-- Dynamic stats will be added here -->
                        <template x-for="(stat, index) in detailedStats" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3 p-4 bg-gray-700 rounded-lg">
                                <input type="text" :name="`detailed_stats[${index}][value]`" placeholder="Value" x-model="stat.value"
                                       class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <input type="text" :name="`detailed_stats[${index}][label]`" placeholder="Label" x-model="stat.label"
                                       class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <input type="text" :name="`detailed_stats[${index}][description]`" placeholder="Description" x-model="stat.description"
                                       class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <button type="button" @click="removeDetailedStat(index)" 
                                        class="text-red-400 hover:text-red-300 text-sm">Remove</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Financial Breakdown -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-white">Financial Breakdown</h2>
                    <button type="button" @click="addFinancialItem()" 
                            class="text-yellow-500 hover:text-yellow-400 text-sm font-medium">
                        + Add Item
                    </button>
                </div>
                <div id="financial-breakdown-container">
                    <template x-for="(item, index) in financialBreakdown" :key="index">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-4 bg-gray-700 rounded-lg">
                            <input type="text" :name="`financial_breakdown[${index}][category]`" placeholder="Category (e.g., Construction)" x-model="item.category"
                                   class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <input type="number" :name="`financial_breakdown[${index}][amount]`" placeholder="Amount" x-model="item.amount" min="0" step="0.01"
                                   class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <button type="button" @click="removeFinancialItem(index)" 
                                    class="text-red-400 hover:text-red-300 text-sm">Remove</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Accomplishments -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-white">Project Accomplishments</h2>
                    <button type="button" @click="addAccomplishment()" 
                            class="text-yellow-500 hover:text-yellow-400 text-sm font-medium">
                        + Add Item
                    </button>
                </div>
                <div id="accomplishments-container">
                    <template x-for="(accomplishment, index) in accomplishments" :key="index">
                        <div class="flex gap-3 mb-3">
                            <input type="text" :name="`accomplishments[${index}]`" placeholder="Accomplishment description" x-model="accomplishments[index]"
                                   class="flex-1 bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <button type="button" @click="removeAccomplishment(index)" 
                                    class="text-red-400 hover:text-red-300 px-3">Remove</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Testimonials -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-white">Community Testimonials</h2>
                    <button type="button" @click="addTestimonial()" 
                            class="text-yellow-500 hover:text-yellow-400 text-sm font-medium">
                        + Add Testimonial
                    </button>
                </div>
                <div id="testimonials-container">
                    <template x-for="(testimonial, index) in testimonials" :key="index">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4 p-4 bg-gray-700 rounded-lg">
                            <input type="text" :name="`testimonials[${index}][name]`" placeholder="Person's Name" x-model="testimonial.name"
                                   class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <input type="text" :name="`testimonials[${index}][role]`" placeholder="Role/Title" x-model="testimonial.role"
                                   class="bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <div class="md:col-span-3">
                                <textarea :name="`testimonials[${index}][quote]`" placeholder="Quote/Testimonial" rows="2" x-model="testimonial.quote"
                                          class="w-full bg-gray-600 border border-gray-500 rounded-lg p-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
                            </div>
                            <button type="button" @click="removeTestimonial(index)" 
                                    class="text-red-400 hover:text-red-300 text-sm">Remove</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Images -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <h2 class="text-xl font-bold text-white mb-6">Project Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-300 mb-2">Main Project Image</label>
                        <input type="file" name="main_image" id="main_image" accept="image/*"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
                        <p class="text-gray-400 text-xs mt-1">Leave empty to keep current image</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Current Gallery Photos</label>
                        <div class="grid grid-cols-2 gap-2">
                            @if($achievement->gallery_photos)
                                @foreach($achievement->gallery_photos as $idx => $photo)
                                    <div class="relative group">
                                        <img src="{{ $photo['url'] ?? $photo }}" alt="Gallery photo" class="w-full h-24 object-cover rounded-lg">
                                        <input type="checkbox" name="remove_gallery_photos[]" value="{{ $idx }}" class="absolute top-2 right-2 h-5 w-5 text-red-500 bg-gray-800 border-gray-600 rounded focus:ring-2 focus:ring-red-500" title="Remove this photo">
                                        @if(!empty($photo['caption']))
                                            <div class="text-gray-400 text-xs p-1">{{ $photo['caption'] }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="text-gray-400 text-xs">No gallery photos.</div>
                            @endif
                        </div>
                        <p class="text-gray-400 text-xs mt-1">Check to remove selected photos on save</p>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="gallery_photos" class="block text-sm font-medium text-gray-300 mb-2">Add New Gallery Photos</label>
                    <input type="file" name="gallery_photos[]" id="gallery_photos" accept="image/*" multiple
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-500 file:text-black hover:file:bg-yellow-600">
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                <h2 class="text-xl font-bold text-white mb-6">Settings</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select name="status" id="status" required
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <option value="active" {{ old('status', $achievement->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $achievement->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $achievement->sort_order) }}" min="0"
                               class="w-full bg-gray-700 border border-gray-600 rounded-lg p-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-gray-400 text-xs mt-1">Lower numbers appear first</p>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="mt-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $achievement->is_featured) ? 'checked' : '' }}
                                       class="rounded bg-gray-700 border-gray-600 text-yellow-500 focus:ring-yellow-500 focus:ring-offset-gray-800">
                                <span class="ml-2 text-gray-300">Featured Achievement</span>
                            </label>
                            <p class="text-gray-400 text-xs mt-1">Show prominently on achievements page</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('admin.achievements.index') }}" 
                   class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-150 ease-in-out text-center">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-lg transition duration-150 ease-in-out">
                    Update Achievement
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function achievementForm() {
    return {
        detailedStats: [],
        financialBreakdown: [],
        accomplishments: [],
        testimonials: [],
        init() {
            // Repopulate from old input if available, otherwise from model
            this.detailedStats = @json(old('detailed_stats', $achievement->detailed_stats ?? []));
            this.financialBreakdown = @json(old('financial_breakdown', $achievement->financial_breakdown ?? []));
            this.accomplishments = @json(old('accomplishments', $achievement->accomplishments ?? []));
            this.testimonials = @json(old('testimonials', $achievement->testimonials ?? []));
        },
        addDetailedStat() {
            this.detailedStats.push({ value: '', label: '', description: '' });
        },
        removeDetailedStat(index) {
            this.detailedStats.splice(index, 1);
        },
        addFinancialItem() {
            this.financialBreakdown.push({ category: '', amount: '' });
        },
        removeFinancialItem(index) {
            this.financialBreakdown.splice(index, 1);
        },
        addAccomplishment() {
            this.accomplishments.push('');
        },
        removeAccomplishment(index) {
            this.accomplishments.splice(index, 1);
        },
        addTestimonial() {
            this.testimonials.push({ name: '', role: '', quote: '' });
        },
        removeTestimonial(index) {
            this.testimonials.splice(index, 1);
        }
    }
}
</script>

@endsection

@push('scripts')
<script>
function achievementForm() {
    return {
        detailedStats: [],
        financialBreakdown: [],
        accomplishments: [],
        testimonials: [],
        init() {
            // Repopulate from old input if available, otherwise from model
            this.detailedStats = @json(old('detailed_stats', $achievement->detailed_stats ?? []));
            this.financialBreakdown = @json(old('financial_breakdown', $achievement->financial_breakdown ?? []));
            this.accomplishments = @json(old('accomplishments', $achievement->accomplishments ?? []));
            this.testimonials = @json(old('testimonials', $achievement->testimonials ?? []));
        },
        addDetailedStat() {
            this.detailedStats.push({ value: '', label: '', description: '' });
        },
        removeDetailedStat(index) {
            this.detailedStats.splice(index, 1);
        },
        addFinancialItem() {
            this.financialBreakdown.push({ category: '', amount: '' });
        },
        removeFinancialItem(index) {
            this.financialBreakdown.splice(index, 1);
        },
        addAccomplishment() {
            this.accomplishments.push('');
        },
        removeAccomplishment(index) {
            this.accomplishments.splice(index, 1);
        },
        addTestimonial() {
            this.testimonials.push({ name: '', role: '', quote: '' });
        },
        removeTestimonial(index) {
            this.testimonials.splice(index, 1);
        }
    }
}
</script>
@endpush