<?php

use Illuminate\Support\Facades\Route;

// Chart APIs
Route::post('/dau', 'ChartDataController@dau')->name('charts.dau');
Route::post('/mau', 'ChartDataController@mau')->name('charts.mau');
Route::post('/bat_purchases', 'ChartDataController@bat_purchases')->name('charts.bat_purchases');
Route::post('/bat_purchases_in_dollars', 'ChartDataController@bat_purchases_in_dollars')->name('charts.bat_purchases_in_dollars');
Route::post('/ad_campaign_supported_countries', 'ChartDataController@ad_campaign_supported_countries')->name('charts.add_campaign_supported_countries');
Route::post('/active_ad_campaigns', 'ChartDataController@active_ad_campaigns')->name('charts.active_ad_campaigns');
Route::post('/bat_creator_summary', 'ChartDataController@bat_creator_summary')->name('charts.bat_creator_summary');
Route::post('/creator_stats', 'ChartDataController@creator_stats')->name('charts.creator_stats');
Route::post('/creator_daily_addition_stats/{channel?}', 'ChartDataController@creator_daily_addition_stats')->name('charts.creator_daily_addition_stats');
Route::post('/creator_daily_total_stats/{channel?}', 'ChartDataController@creator_daily_total_stats')->name('charts.creator_daily_total_stats');
Route::post('/top_creators/{channel}', 'ChartDataController@top_creators')->name('charts.top_creators');
Route::post('/creator_validation/{channel}', 'ChartDataController@creator_validation')->name('charts.creator_validation');
Route::post('/communities/{site}/{community}', 'ChartDataController@communities')->name('charts.communities');

// BAT Chart APIS
Route::post('/bat_price', 'ChartDataBatStatsController@batPrice')->name('charts.bat_price');
Route::post('/bat_holders_count', 'ChartDataBatStatsController@batHoldersCount')->name('charts.bat_holders_count');
Route::post('/bat_holders_add', 'ChartDataBatStatsController@batHoldersAdd')->name('charts.bat_holders_add');
Route::post('/bat_volume', 'ChartDataBatStatsController@batVolume')->name('charts.bat_volume');
Route::post('/bat_market_cap', 'ChartDataBatStatsController@batMarketCap')->name('charts.bat_market_cap');

// Dashboard Chart APIS
Route::any('/dashboard/{endpoint}', 'DashboardDataController@index')->name('charts.dashboard');
