<?php

use App\Http\Controllers\ChartDataBatStatsController;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\DashboardDataController;
use Illuminate\Support\Facades\Route;

// Chart APIs
Route::any('/dau', [ChartDataController::class, 'dau'])->name('charts.dau');
Route::any('/mau', [ChartDataController::class, 'mau'])->name('charts.mau');
Route::any('/bat_purchases', [ChartDataController::class, 'bat_purchases'])->name('charts.bat_purchases');
Route::any('/bat_purchases_in_dollars', [ChartDataController::class, 'bat_purchases_in_dollars'])->name('charts.bat_purchases_in_dollars');
Route::any('/ad_campaign_supported_countries', [ChartDataController::class, 'ad_campaign_supported_countries'])->name('charts.add_campaign_supported_countries');
Route::any('/active_ad_campaigns', [ChartDataController::class, 'active_ad_campaigns'])->name('charts.active_ad_campaigns');
Route::any('/creator_stats', [ChartDataController::class, 'creator_stats'])->name('charts.creator_stats');
Route::any('/creator_daily_addition_stats/{channel?}', [ChartDataController::class, 'creator_daily_addition_stats'])->name('charts.creator_daily_addition_stats');
Route::any('/creator_daily_total_stats/{channel?}', [ChartDataController::class, 'creator_daily_total_stats'])->name('charts.creator_daily_total_stats');
Route::any('/top_creators/{channel}', [ChartDataController::class, 'top_creators'])->name('charts.top_creators');
Route::any('/creator_validation/{channel}', [ChartDataController::class, 'creator_validation'])->name('charts.creator_validation');
Route::any('/communities/{site}/{community}', [ChartDataController::class, 'communities'])->name('charts.communities');

// BAT Chart APIS
Route::any('/bat_price', [ChartDataBatStatsController::class, 'batPrice'])->name('charts.bat_price');
Route::any('/bat_holders_count', [ChartDataBatStatsController::class, 'batHoldersCount'])->name('charts.bat_holders_count');
Route::any('/bat_holders_add', [ChartDataBatStatsController::class, 'batHoldersAdd'])->name('charts.bat_holders_add');
Route::any('/bat_volume', [ChartDataBatStatsController::class, 'batVolume'])->name('charts.bat_volume');
Route::any('/bat_market_cap', [ChartDataBatStatsController::class, 'batMarketCap'])->name('charts.bat_market_cap');

// Dashboard Chart APIS
Route::any('/dashboard/{endpoint}', [DashboardDataController::class, 'index'])->name('charts.dashboard');
