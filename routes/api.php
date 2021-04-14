<?php

use App\Api\v2\Controllers\BatStatsController;
use App\Api\v2\Controllers\CreatorsController;
use App\Api\v2\Controllers\CreatorStatsController;
use App\Http\Controllers\Api\GithubController;
use App\Http\Controllers\Api\RedditController;
use App\Http\Controllers\Api\TwitchController;
use App\Http\Controllers\Api\TwitterController;
use App\Http\Controllers\Api\VimeoController;
use App\Http\Controllers\Api\WebsiteController;
use App\Http\Controllers\Api\YoutubeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->post('v1/github', [GithubController::class, 'index'])->name('api.v1.github');
Route::middleware('auth:sanctum')->post('v1/reddit', [RedditController::class, 'index'])->name('api.v1.reddit');
Route::middleware('auth:sanctum')->post('v1/twitch', [TwitchController::class, 'index'])->name('api.v1.twitch');
Route::middleware('auth:sanctum')->post('v1/twitter', [TwitterController::class, 'index'])->name('api.v1.twitter');
Route::middleware('auth:sanctum')->post('v1/vimeo', [VimeoController::class, 'index'])->name('api.v1.vimeo');
Route::middleware('auth:sanctum')->post('v1/website', [WebsiteController::class, 'index'])->name('api.v1.website');
Route::middleware('auth:sanctum')->post('v1/youtube', [YoutubeController::class, 'index'])->name('api.v1.youtube');

// dev: 1|oNB57nL40oZCxnz3fb09xmKAvwgvSOYzbdCAYEBzfWLTeG6II0ZIm3DBrTQS4aw5aBHPAtBlhGYeKITw
// production: 1|7qv6lBwPoMJp0qb2kMmO3vNYF5n4DiLcYEdPCaTPGyZ0XR29lM8k3cJzSjZuXW1QFafY1QaYsKK5eUgL

Route::any('v2/creator_stats/by_channels', [CreatorStatsController::class, 'creatorsByChannels']);
Route::any('v2/bat_stats/all', [BatStatsController::class, 'all']);

Route::any('v2/creators/github', [CreatorsController::class, 'github']);
Route::any('v2/creators/website', [CreatorsController::class, 'website']);
Route::any('v2/creators/youtube', [CreatorsController::class, 'youtube']);
Route::any('v2/creators/twitch', [CreatorsController::class, 'twitch']);
Route::any('v2/creators/twitter', [CreatorsController::class, 'twitter']);
Route::any('v2/creators/vimeo', [CreatorsController::class, 'vimeo']);
Route::any('v2/creators/reddit', [CreatorsController::class, 'reddit']);
