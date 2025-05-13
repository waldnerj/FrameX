<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movie.index');
Route::get('/movies/{movie}', 'App\Http\Controllers\MoviesController@show')->name('movie.show');
Route::get('/actor', 'App\Http\Controllers\MoviesController@actors')->name('actor.show');
Route::get('/tv', 'App\Http\Controllers\MoviesController@tvShows')->name('tv.show');

Route::get('/actors/{id}', [MoviesController::class, 'actorShow'])->name('actors.show');
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.show');
