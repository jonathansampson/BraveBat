<?php

use App\Api\v2\Controllers\CreatorsController;
use App\Api\v2\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->post('v1/github', 'Api\GithubController@index')->name('api.v1.github');
Route::middleware('auth:sanctum')->post('v1/reddit', 'Api\RedditController@index')->name('api.v1.reddit');
Route::middleware('auth:sanctum')->post('v1/twitch', 'Api\TwitchController@index')->name('api.v1.twitch');
Route::middleware('auth:sanctum')->post('v1/twitter', 'Api\TwitterController@index')->name('api.v1.twitter');
Route::middleware('auth:sanctum')->post('v1/vimeo', 'Api\VimeoController@index')->name('api.v1.vimeo');
Route::middleware('auth:sanctum')->post('v1/website', 'Api\WebsiteController@index')->name('api.v1.website');
Route::middleware('auth:sanctum')->post('v1/youtube', 'Api\YoutubeController@index')->name('api.v1.youtube');

// dev: 1|oNB57nL40oZCxnz3fb09xmKAvwgvSOYzbdCAYEBzfWLTeG6II0ZIm3DBrTQS4aw5aBHPAtBlhGYeKITw
// production: 1|7qv6lBwPoMJp0qb2kMmO3vNYF5n4DiLcYEdPCaTPGyZ0XR29lM8k3cJzSjZuXW1QFafY1QaYsKK5eUgL

Route::any('v2/stats/creators_by_channels', [StatsController::class, 'creatorsByChannels']);

Route::any('v2/creators/github', [CreatorsController::class, 'github']);
Route::any('v2/creators/website', [CreatorsController::class, 'website']);
Route::any('v2/creators/youtube', [CreatorsController::class, 'youtube']);
Route::any('v2/creators/twitch', [CreatorsController::class, 'twitch']);
Route::any('v2/creators/twitter', [CreatorsController::class, 'twitter']);
Route::any('v2/creators/vimeo', [CreatorsController::class, 'vimeo']);
Route::any('v2/creators/reddit', [CreatorsController::class, 'reddit']);
