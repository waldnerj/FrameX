@extends('layout.main')

@section('content')
<div class="movie-info border-b border-gray-800 bg-black">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-96 rounded-lg shadow-lg">
        
        <div class="ml-16 max-w-2xl">
            <h2 class="text-4xl font-semibold text-white">{{ $movie['title'] }}</h2>

            {{-- Watchlist Button --}}
            @auth
                <form action="{{ route('watchlist.toggle', $movie['id']) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                        {{ $inWatchlist ? 'Aus Watchlist entfernen' : 'Zur Watchlist hinzufügen' }}
                    </button>
                </form>
            @endauth
            
            <div class="flex items-center text-gray-400 text-sm mt-4">
                <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-5 h-5 text-red-600">
                <span class="ml-1 text-red-600">{{ $movie['vote_average'] * 10 . '%' }}</span>
                <span class="mx-2">|</span>       
                <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                <span class="mx-2">|</span>  
                <span>
                    @foreach ($movie['genres'] as $genre)
                        {{ $genre['name'] }}@if (!$loop->last), @endif
                    @endforeach
                </span>
            </div>

            <p class="text-gray-300 mt-6 leading-relaxed">
                {{ $movie['overview'] }}
            </p>
            
            <div class="mt-10">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">
                    @foreach ($movie['credits']['cast'] as $cast)
                        @if ($loop->index < 2) 
                            <div class="mr-8">
                                <div class="font-semibold text-white">
                                    <a href="{{ route('movies.showActor', $cast['id']) }}" class="hover:text-red-600 transition duration-300">
                                        {{ $cast['name'] }}
                                    </a>
                                </div>
                                <div class="text-sm text-gray-400">{{ $cast['character'] }}</div> 
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            
            {{-- Trailer --}}
            @if (isset($movie['videos']['results']) && count($movie['videos']['results']) > 0)
                <div class="mt-10">
                    <button id="playTrailerBtn" class="flex items-center bg-red-600 text-white rounded-lg font-semibold px-6 py-3 hover:bg-red-700 transition duration-200">
                        <img src="{{ asset('images/play.svg') }}" alt="Play" class="w-6 h-6">
                        <span class="ml-3">Play Trailer</span>
                    </button>
                </div>

                <div id="trailerContainer" class="mt-6 hidden">
                    <h3 class="text-xl font-semibold text-gray-800">Trailer:</h3>
                    <div id="trailerIframeContainer" class="mt-4"></div>
                </div>

                <script>
                    const playTrailerBtn = document.getElementById('playTrailerBtn');
                    const trailerContainer = document.getElementById('trailerContainer');
                    const trailerIframeContainer = document.getElementById('trailerIframeContainer');
                    const videoKey = '{{ $movie["videos"]["results"][0]["key"] }}';

                    playTrailerBtn.addEventListener('click', function () {
                        trailerContainer.classList.remove('hidden');
                        trailerIframeContainer.innerHTML = `
                            <iframe width="100%" height="315" 
                                src="https://www.youtube.com/embed/${videoKey}?autoplay=1" 
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        `;
                        trailerContainer.scrollIntoView({ behavior: 'smooth' });
                    });
                </script>
            @else
                <div class="mt-10">
                    <p class="text-gray-400">No trailer available for this movie.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Cast --}}
<div class="movie-cast border-b border-gray-800 bg-black">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold text-white">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-8">
            @foreach (array_slice($movie['credits']['cast'], 0, 5) as $cast)
                <div class="mt-8">
                    @if (!empty($cast['profile_path']))
                        <a href="{{ route('movies.showActor', $cast['id']) }}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300' . $cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                        </a>
                    @else
                        <div class="text-gray-400 text-sm mt-2">Kein Bild verfügbar</div>
                    @endif
                    <div class="mt-2">
                        <a href="{{ route('movies.showActor', $cast['id']) }}" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">
                            {{ $cast['name'] }}
                        </a>
                        <div class="text-gray-400 text-sm">{{ $cast['character'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Images --}}
<div class="movie-images bg-black">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold text-white">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8">
            @foreach (array_slice($movie['images']['backdrops'], 0, 9) as $image)
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
