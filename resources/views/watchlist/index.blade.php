@extends('layout.main')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-6">Deine Watchlist</h1>

        @if($watchlist->isEmpty())
            <p class="text-gray-400">Du hast noch keine Filme oder Serien zur Watchlist hinzugefügt.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($watchlist as $item)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                        <img src="{{ $item->poster_url ?? asset('images/placeholder.jpg') }}" alt="{{ $item->title }}" class="w-full h-72 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $item->title }}</h2>
                            <p class="text-gray-400 text-sm">{{ \Illuminate\Support\Str::limit($item->description, 100) }}</p>
                            <div class="mt-4">
                                <a href="{{ route('movies.showMovie', $item->id) }}" class="text-red-500 hover:underline">Mehr erfahren</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
