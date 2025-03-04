<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MoviesController@index')->name('movie.index');
Route::get('/show', 'App\Http\Controllers\MoviesController@show')->name('movie.show');
