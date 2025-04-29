@extends('layout.main')

@section('content')
    <div class="tvShows-list container mx-auto px-4 pt-16">
        <h1 class="text-4xl font-bold mb-6 text-red-600">TV Shows</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach (array_slice($tvShows, 0, 10) as $tvShow)
                <div class="mt-8">
                    <a href="{{ route('tv1.show', $tvShow['id']) }}">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'] }}" 
                             alt="{{ $tvShow['name'] }}" 
                             class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('tv1.show', $tvShow['id']) }}" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">
                            {{ $tvShow['name'] }}
                        </a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-4 h-4">
                            <span class="ml-1 text-red-600">
                                {{ round($tvShow['vote_average'] * 10) . '%' }}
                            </span>
                            <span class="mx-2">|</span>
                            <span>
                                {{ \Carbon\Carbon::parse($tvShow['first_air_date'])->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="text-gray-400 text-sm mt-1">
                            {{ Str::limit($tvShow['overview'], 80) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
