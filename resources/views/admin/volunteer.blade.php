@extends('layouts.app')

@section('title', 'Volunteer')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-950 text-white">
    @if($project)
        <div class="max-w-3xl w-full bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-orange-400 mb-4">{{ $project->title }}</h1>
            <p class="text-gray-300">{{ $project->description }}</p>

            <form action="{{ route('volunteer.store') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">
                    Volunteer Now
                </button>
            </form>
        </div>
    @else
        <p class="text-xl text-gray-400">No active volunteer projects at the moment.</p>
    @endif
</div>
@endsection
