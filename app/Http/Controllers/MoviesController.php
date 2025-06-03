<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json('results');

            $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json('results');
            
        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json('genres');
        
        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return view('movies.movieIndex',[
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres,
        ]);
        
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
            ->json();

        return view('movies.showMovie',[
            'movie' => $movie,
        ]);
    }


//---------------------------------------------------------------------------
    public function actors()
    {
        $actors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular')
            ->json('results');
        return view('movies.actorIndex', [
            'actors' => $actors,
        ]);
    }
    public function actorShow($id)
    {
    $actor = Http::withToken(config('services.tmdb.token'))
        ->get("https://api.themoviedb.org/3/person/{$id}?append_to_response=combined_credits,images")
        ->json();

    return view('movies.showActor', [
        'actor' => $actor,
    ]);
    }

//---------------------------------------------------------------------------

public function tv()
{
    $tvShows = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/popular')
        ->json('results');

    return view('movies.tvIndex', [
        'tvShows' => $tvShows,
    ]);
}

public function tvShow($id)
{
    $tvShow = Http::withToken(config('services.tmdb.token'))
        ->get("https://api.themoviedb.org/3/tv/{$id}?append_to_response=credits,images")
        ->json();

    return view('movies.showTV', [
        'tvShow' => $tvShow,
    ]);
}



}
