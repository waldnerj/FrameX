<div class="mt-8">
    <a href="{{ route('movies.showMovie', $movie['id']) }}">
        <img src="{{'https://image.tmdb.org/t/p/w500'.$movie['poster_path']}}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.showMovie', $movie['id']) }}" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">{{$movie['title']}}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-4 h-4 text-red-600">
            <span class="ml-1 text-red-600">{{$movie['vote_average'] * 10 . '%'}}</span>
            <span class="mx-2">|</span>       
            <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach ($movie['genre_ids'] as $genre)
                {{$genres->get($genre)}}@if (!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>