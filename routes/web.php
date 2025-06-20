<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\WatchlistController;

Route::get('/', [MoviesController::class, 'index'])->name('movies.movieIndex');

// Movies
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.showMovie');

// Actors
Route::get('/actors', [MoviesController::class, 'actors'])->name('movies.actorIndex');
Route::get('/actors/{id}', [MoviesController::class, 'actorShow'])->name('movies.showActor');

// TV Shows
Route::get('/tv', [MoviesController::class, 'tv'])->name('movies.tvIndex');
Route::get('/tv/{id}', [MoviesController::class, 'tvShow'])->name('movies.showTv');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {



    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist/toggle/{movieId}', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');
    Route::delete('/watchlist/{movieId}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy');

    // Dashboard Route (Platzhalter oder Weiterleitung)
    Route::get('/dashboard', function () {
        return redirect()->route('movies.movieIndex');
    })->name('dashboard');
});


