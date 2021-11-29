<?php

use App\Http\Controllers\EpisodeRatings;
use App\Http\Controllers\MovieRatings;
use App\Http\Controllers\PlexWebhookProcessor;
use App\Http\Controllers\PlexWebhookRequestController;
use App\Http\Controllers\Recipe;
use App\Http\Controllers\TrackRatings;
use App\Http\Controllers\WhoseTurn;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/episode-ratings',
    [EpisodeRatings::class, 'show']
);

Route::get(
    '/movie-ratings',
    [MovieRatings::class, 'show']
);

Route::get(
    '/recipes',
    [Recipe::class, 'index']
);

Route::get(
    '/recipes/{id}',
    [Recipe::class, 'show']
);

Route::get(
    '/track-ratings',
    [TrackRatings::class, 'show']
);

Route::get(
    '/process-plex-webhooks',
    [PlexWebhookProcessor::class, 'process']
);

Route::get(
    '/whose-turn-is-it',
    [WhoseTurn::class, 'calculate']
);

Route::resources([
    'plex-webhook-requests' => 'PlexWebhookRequestController',
]);

