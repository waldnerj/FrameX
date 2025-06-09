@extends('layout.main')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Deine Watchlist</h1>

        @if($watchlist->isEmpty())
            <p class="text-gray-400">Du hast noch keine Filme oder Serien zur Watchlist hinzugefügt.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($watchlist as $item)
                    @php
                        $movie = Http::withToken(config('services.tmdb.token'))
                            ->get("https://api.themoviedb.org/3/movie/{$item->movie_id}")
                            ->json();
                    @endphp

                    @if(!empty($movie))
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-full h-72 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2 text-white">{{ $movie['title'] }}</h2>
                                <p class="text-gray-400 text-sm">{{ \Illuminate\Support\Str::limit($movie['overview'], 100) }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('movies.showMovie', $movie['id']) }}" class="text-red-500 hover:underline">Mehr erfahren</a>
                                    <form method="POST" action="{{ route('watchlist.destroy', $movie['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition text-sm">Entfernen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection
