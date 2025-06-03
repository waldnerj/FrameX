@extends('layout.main')

@section('content')
    <div class="actors-list container mx-auto px-4 pt-16">
        <h1 class="text-4xl font-bold mb-6 text-red-600">Actors</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($actors as $actor)
                <div class="mt-8">
                    <a href="{{ route('movies.showActor', $actor['id']) }}">
                      <img src="{{ 'https://image.tmdb.org/t/p/w500' . $actor['profile_path'] }}" 
                       alt="{{ $actor['name'] }}" 
                       class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.showActor', $actor['id']) }}" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">
                            {{ $actor['name'] }}
                        </a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-4 h-4 text-red-600">
                            <span class="ml-1 text-red-600">
                                {{ $actor['popularity'] ?? 'N/A' }}
                            </span>
                            <span class="mx-2">|</span>
                            <span>
                                {{ $actor['known_for_department'] ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
