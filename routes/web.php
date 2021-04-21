<?php

use App\Http\Controllers\Ads\AdsAdvertisersApiController;
use App\Http\Controllers\Ads\AdsAdvertisersController;
use App\Http\Controllers\Ads\AdsCampaignsController;
use App\Http\Controllers\CreatorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('privacy_policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('terms_of_service', [HomeController::class, 'terms_of_service'])->name('terms_of_service');
Route::get('api_doc', [HomeController::class, 'api_doc'])->name('api_doc');
Route::get('search', [SearchController::class, 'index'])->name('search');
Route::post('search', [SearchController::class, 'store']);

// Stats
Route::get('brave_browser_active_users', [StatsController::class, 'brave_browser_active_users'])->name('stats.brave_browser_active_users');
Route::get('brave_initiated_bat_purchase', [StatsController::class, 'brave_initiated_bat_purchase'])->name('stats.brave_initiated_bat_purchase');
Route::get('brave_ads_campaigns', [StatsController::class, 'brave_ads_campaigns'])->name('stats.brave_ads_campaigns');
Route::get('brave_creator_historical_stats', [StatsController::class, 'brave_creator_historical_stats'])->name('stats.brave_creator_historical_stats');
Route::get('bat_stats', [StatsController::class, 'bat_stats'])->name('stats.bat_stats');
Route::get('top_creators', [StatsController::class, 'top_creators'])->name('stats.top_creators');
Route::get('creator_validation', [StatsController::class, 'creator_validation'])->name('stats.creator_validation');
Route::get('communities', [StatsController::class, 'communities'])->name('stats.communities');
Route::get('creators/{channel}', [CreatorsController::class, 'index'])->name('creators.index');
Route::get('creators/{channel}/{id}', [CreatorsController::class, 'show'])->name('creators.show');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('resend_verification_email', [UsersController::class, 'resendVerificationEmail'])->name('resend_verification_email');
    Route::post('tokens', [TokensController::class, 'store'])->name('tokens.store');
    Route::patch('tokens', [TokensController::class, 'update'])->name('tokens.update');
    Route::delete('tokens', [TokensController::class, 'destroy'])->name('tokens.destroy');
});

Route::group(['middleware' => ['auth', "isAdmin"]], function () {
    Route::get('/ads_campaigns', [AdsCampaignsController::class, 'index'])->name('ads_campaigns.index');
    Route::get('/ads_campaigns/{adsCampaign}', [AdsCampaignsController::class, 'show'])->name('ads_campaigns.show');
    Route::resource('ads_advertisers', AdsAdvertisersController::class)->only(['index', 'show']);
    Route::resource('ads_advertisers_api', AdsAdvertisersApiController::class)->only(['index', 'store', 'destroy']);
});
