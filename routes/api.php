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

Route::middleware('auth:sanctum')->post('v1/website', 'Api\WebsiteController@index')->name('api.v1.website');
Route::middleware('auth:sanctum')->post('v1/youtube', 'Api\YoutubeController@index')->name('api.v1.youtube');
// Route::middleware('auth:sanctum')->post('/twitter', 'ApiController@website')->name('api.twitter');
// Route::middleware('auth:sanctum')->post('/vimeo', 'ApiController@website')->name('api.vimeo');
// Route::middleware('auth:sanctum')->post('/twitch', 'ApiController@website')->name('api.twitch');
// Route::middleware('auth:sanctum')->post('/reddit', 'ApiController@website')->name('api.reddit');
// Route::middleware('auth:sanctum')->post('/github', 'ApiController@website')->name('api.github');

// dev: 1|oNB57nL40oZCxnz3fb09xmKAvwgvSOYzbdCAYEBzfWLTeG6II0ZIm3DBrTQS4aw5aBHPAtBlhGYeKITw
// production: 1|7qv6lBwPoMJp0qb2kMmO3vNYF5n4DiLcYEdPCaTPGyZ0XR29lM8k3cJzSjZuXW1QFafY1QaYsKK5eUgL
