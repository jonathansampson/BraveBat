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

Route::middleware('auth:sanctum')->post('v1/github', 'Api\GithubController@index')->name('api.v1.github');
Route::middleware('auth:sanctum')->post('v1/reddit', 'Api\RedditController@index')->name('api.v1.reddit');
Route::middleware('auth:sanctum')->post('v1/twitch', 'Api\TwitchController@index')->name('api.v1.twitch');
Route::middleware('auth:sanctum')->post('v1/twitter', 'Api\TwitterController@index')->name('api.v1.twitter');
Route::middleware('auth:sanctum')->post('v1/vimeo', 'Api\VimeoController@index')->name('api.v1.vimeo');
Route::middleware('auth:sanctum')->post('v1/website', 'Api\WebsiteController@index')->name('api.v1.website');
Route::middleware('auth:sanctum')->post('v1/youtube', 'Api\YoutubeController@index')->name('api.v1.youtube');

// dev: 1|oNB57nL40oZCxnz3fb09xmKAvwgvSOYzbdCAYEBzfWLTeG6II0ZIm3DBrTQS4aw5aBHPAtBlhGYeKITw
// production: 1|7qv6lBwPoMJp0qb2kMmO3vNYF5n4DiLcYEdPCaTPGyZ0XR29lM8k3cJzSjZuXW1QFafY1QaYsKK5eUgL
