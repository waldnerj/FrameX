<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

Route::get('/', [MoviesController::class, 'index'])->name('movies.movieIndex');

// Movies
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.showMovie');

// Actors
Route::get('/actors', [MoviesController::class, 'actors'])->name('movies.actorIndex');
Route::get('/actors/{id}', [MoviesController::class, 'actorShow'])->name('movies.showActor');

// TV Shows
Route::get('/tv', [MoviesController::class, 'tv'])->name('movies.tvIndex');
Route::get('/tv/{id}', [MoviesController::class, 'tvShow'])->name('movies.showTv');

