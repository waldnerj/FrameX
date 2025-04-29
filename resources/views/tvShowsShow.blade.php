@extends('layout.main')

@section('content')
<div class="movie-info border-b border-gray-800 bg-black">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <!-- Poster -->
        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $tvShow['poster_path'] }}" alt="{{ $tvShow['name'] }}" class="w-96 rounded-lg shadow-lg">
        
        <!-- Details -->
        <div class="ml-16 max-w-2xl">
            <h2 class="text-4xl font-semibold text-white">{{ $tvShow['name'] }}</h2>

            <!-- Meta Info -->
            <div class="flex items-center text-gray-400 text-sm mt-2">
                <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-5 h-5 text-red-600">
                <span class="ml-1 text-red-600">{{ round($tvShow['vote_average'] * 10) . '%' }}</span>
                <span class="mx-2">|</span>
                <span>{{ \Carbon\Carbon::parse($tvShow['first_air_date'])->format('M d, Y') }}</span>
                <span class="mx-2">|</span>
                <span>
                    @foreach ($tvShow['genres'] as $genre)
                        {{ $genre['name'] }}@if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>

            <!-- Overview -->
            <p class="text-gray-300 mt-6 leading-relaxed">
                {{ $tvShow['overview'] }}
            </p>

            <!-- Featured Cast -->
            <div class="mt-10">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">
                    @foreach ($tvShow['credits']['cast'] as $cast)
                        @if ($loop->index < 2)
                            <div class="mr-8">
                                <div class="font-semibold text-white">{{ $cast['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $cast['character'] }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Trailer -->
            @if (isset($tvShow['videos']['results'][0]['key']))
                <div class="mt-10">
                    <a href="#" id="playTrailerBtn" class="inline-flex items-center bg-red-600 text-white rounded-lg font-semibold px-6 py-3 hover:bg-red-700 transition duration-200">
                        <img src="{{ asset('images/play.svg') }}" alt="Play" class="w-6 h-6">
                        <span class="ml-3">Play Trailer</span>
                    </a>
                </div>

                <div id="trailerContainer" class="mt-6 hidden">
                    <h3 class="text-xl font-semibold text-gray-800">Trailer:</h3>
                    <div id="trailerIframeContainer" class="mt-4"></div>
                </div>

                <script>
                    document.getElementById('playTrailerBtn').addEventListener('click', function (e) {
                        e.preventDefault();
                        document.getElementById('trailerContainer').classList.remove('hidden');
                        document.getElementById('trailerIframeContainer').innerHTML = `
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}?autoplay=1" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        `;
                    });
                </script>
            @else
                <div class="mt-10">
                    <p class="text-gray-400">No trailer available for this show.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Cast Section -->
<div class="movie-cast border-b border-grey-800 bg-black">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold text-white">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-8">
            @foreach (array_slice($tvShow['credits']['cast'], 0, 5) as $cast)
                <div class="mt-8">
                    @if (!empty($cast['profile_path']))
                        <a href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300' . $cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                        </a>
                    @else
                        <div class="text-gray-400 text-sm mt-2">Kein Bild verfügbar</div>
                    @endif
                    <div class="mt-2">
                        <a href="#" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">{{ $cast['name'] }}</a>
                        <div class="text-gray-400 text-sm">{{ $cast['character'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Images -->
<div class="movie-images">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8">
            @foreach (array_slice($tvShow['images']['backdrops'], 0, 9) as $image)
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $image['file_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
