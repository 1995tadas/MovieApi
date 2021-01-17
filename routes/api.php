<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::name('movies.')->group(function () {
    Route::get('/trending', 'MovieController@fetchTrendingMovies')->name('trending');
    Route::get('/movie/{id}', 'MovieController@fetchMovie')->where(['id' => '[0-9]{1,6}'])
        ->name('movie');
});
