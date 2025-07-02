<!-- resources/views/profile/edit.blade.php -->
@extends('profile.layout')

@section('profile-content')
<!-- Profile Information Form Content -->
<div>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')
        
        <div>
            <label for="name" class="block text-sm font-medium text-white mb-1">Name</label>
            <input id="name" name="name" type="text" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" 
                value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
            <input id="email" name="email" type="email" 
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" 
                value="{{ old('email', $user->email) }}">
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="phone" class="block text-sm font-medium text-white mb-1">Phone Number</label>
            <input id="phone" name="phone" type="text"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="city" class="block text-sm font-medium text-white mb-1">City (optional)</label>
            <input id="city" name="city" type="text"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                value="{{ old('city', $user->city) }}">
            @error('city')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="address" class="block text-sm font-medium text-white mb-1">Full Address (optional)</label>
            <textarea id="address" name="address" rows="3"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                placeholder="Street address, building, apartment, etc. (city can be included here or above)">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="student_id" class="block text-sm font-medium text-white mb-1">Student ID (optional)</label>
            <input id="student_id" name="student_id" type="text"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                value="{{ old('student_id', $user->student_id) }}">
            @error('student_id')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="department" class="block text-sm font-medium text-white mb-1">Department (optional)</label>
            <select id="department" name="department"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Select Department</option>
                <option value="Computer Engineering" {{ old('department', $user->department) == 'Computer Engineering' ? 'selected' : '' }}>Computer Engineering</option>
                <option value="Civil Engineering" {{ old('department', $user->department) == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                <option value="Architecture" {{ old('department', $user->department) == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                <option value="Business Administration" {{ old('department', $user->department) == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                <option value="International Relations" {{ old('department', $user->department) == 'International Relations' ? 'selected' : '' }}>International Relations</option>
                <option value="English Language Teaching" {{ old('department', $user->department) == 'English Language Teaching' ? 'selected' : '' }}>English Language Teaching</option>
                <option value="Law" {{ old('department', $user->department) == 'Law' ? 'selected' : '' }}>Law</option>
                <option value="Medicine" {{ old('department', $user->department) == 'Medicine' ? 'selected' : '' }}>Medicine</option>
                <option value="Dentistry" {{ old('department', $user->department) == 'Dentistry' ? 'selected' : '' }}>Dentistry</option>
                <option value="Pharmacy" {{ old('department', $user->department) == 'Pharmacy' ? 'selected' : '' }}>Pharmacy</option>
                <option value="Nursing" {{ old('department', $user->department) == 'Nursing' ? 'selected' : '' }}>Nursing</option>
                <option value="Other" {{ old('department', $user->department) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('department')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="graduation_year" class="block text-sm font-medium text-white mb-1">Expected Graduation Year (optional)</label>
            <select id="graduation_year" name="graduation_year"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Select Year</option>
                @for($year = date('Y'); $year <= date('Y') + 10; $year++)
                    <option value="{{ $year }}" {{ old('graduation_year', $user->graduation_year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            @error('graduation_year')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="emergency_contact" class="block text-sm font-medium text-white mb-1">Emergency Contact Name (optional)</label>
            <input id="emergency_contact" name="emergency_contact" type="text"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                value="{{ old('emergency_contact', $user->emergency_contact) }}">
            @error('emergency_contact')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="emergency_phone" class="block text-sm font-medium text-white mb-1">Emergency Contact Phone (optional)</label>
            <input id="emergency_phone" name="emergency_phone" type="text"
                class="w-full bg-[#242b45] border border-gray-700 text-white rounded py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                value="{{ old('emergency_phone', $user->emergency_phone) }}">
            @error('emergency_phone')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded transition duration-300">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection