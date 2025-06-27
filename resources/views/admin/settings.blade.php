@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold">Donation Settings</h1>

    @if (session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.updateSettings') }}" method="POST">
        @csrf
        <label>
            <input type="checkbox" name="enable_money_donations" {{ $settings->enable_money_donations ? 'checked' : '' }}>
            Enable Money Donations
        </label><br>

        <label>
            <input type="checkbox" name="enable_clothes_donations" {{ $settings->enable_clothes_donations ? 'checked' : '' }}>
            Enable Clothes Donations
        </label><br>

        <label>
            <input type="checkbox" name="enable_food_donations" {{ $settings->enable_food_donations ? 'checked' : '' }}>
            Enable Food Donations
        </label><br>

        <button type="submit">Save Settings</button>
    </form>
</div>
@endsection
