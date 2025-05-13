@extends('layout.main')

@section('content')
<div class="actor-info border-b border-gray-800 bg-black py-16">
    <div class="container mx-auto flex flex-col md:flex-row px-4">
        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $actor['profile_path'] }}" 
             alt="{{ $actor['name'] }}" 
             class="w-80 rounded-lg shadow-lg">

        <div class="md:ml-16 mt-6 md:mt-0 text-white">
            <h2 class="text-4xl font-bold">{{ $actor['name'] }}</h2>
            <p class="text-gray-400 mt-2">
                <strong>Birthday:</strong> {{ $actor['birthday'] ?? 'Unknown' }}<br>
                <strong>Place of Birth:</strong> {{ $actor['place_of_birth'] ?? 'Unknown' }}
            </p>
            <p class="mt-6 text-gray-300 leading-relaxed">
                {{ $actor['biography'] ?: 'No biography available.' }}
            </p>
        </div>
    </div>
</div>

<div class="known-for border-b border-gray-800 bg-black py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-semibold text-white mb-6">Known For</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($actor['combined_credits']['cast'] as $credit)
                @if ($credit['media_type'] === 'movie' && isset($credit['poster_path']))
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $credit['id']) }}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500' . $credit['poster_path'] }}" 
                                 alt="{{ $credit['title'] ?? $credit['name'] }}" 
                                 class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                        </a>
                        <div class="text-white mt-2 text-sm">
                            {{ $credit['title'] ?? $credit['name'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
