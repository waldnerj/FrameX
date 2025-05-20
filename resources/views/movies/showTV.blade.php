@extends('layout.main')

@section('content')
<div class="tv-info border-b border-gray-800 bg-black py-16">
    <div class="container mx-auto flex flex-col md:flex-row px-4">
        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'] }}" 
             alt="{{ $tvShow['name'] }}" 
             class="w-80 rounded-lg shadow-lg">

        <div class="md:ml-16 mt-6 md:mt-0 text-white">
            <h2 class="text-4xl font-bold">{{ $tvShow['name'] }}</h2>
            <p class="text-gray-400 mt-2">
                <strong>First Air Date:</strong> {{ \Carbon\Carbon::parse($tvShow['first_air_date'])->format('F d, Y') ?? 'Unknown' }}<br>
                <strong>Number of Seasons:</strong> {{ $tvShow['number_of_seasons'] ?? 'Unknown' }}<br>
                <strong>Status:</strong> {{ $tvShow['status'] ?? 'Unknown' }}
            </p>
            <p class="mt-6 text-gray-300 leading-relaxed">
                {{ $tvShow['overview'] ?: 'No overview available.' }}
            </p>

            @if(isset($tvShow['genres']))
                <div class="mt-4 text-sm text-gray-400">
                    <strong>Genres:</strong> 
                    {{ collect($tvShow['genres'])->pluck('name')->join(', ') }}
                </div>
            @endif
        </div>
    </div>
</div>

@if (!empty($tvShow['seasons']))
<div class="seasons border-b border-gray-800 bg-black py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-semibold text-white mb-6">Seasons</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($tvShow['seasons'] as $season)
                @if (!empty($season['poster_path']))
                    <div class="mt-2">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $season['poster_path'] }}" 
                             alt="{{ $season['name'] }}" 
                             class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                        <div class="text-white mt-2 text-sm">
                            {{ $season['name'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
