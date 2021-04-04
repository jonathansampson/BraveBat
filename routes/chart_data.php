<?php

use Illuminate\Support\Facades\Route;

// Chart APIs
Route::any('/dau', 'ChartDataController@dau')->name('charts.dau');
Route::any('/mau', 'ChartDataController@mau')->name('charts.mau');
Route::any('/bat_purchases', 'ChartDataController@bat_purchases')->name('charts.bat_purchases');
Route::any('/bat_purchases_in_dollars', 'ChartDataController@bat_purchases_in_dollars')->name('charts.bat_purchases_in_dollars');
Route::any('/ad_campaign_supported_countries', 'ChartDataController@ad_campaign_supported_countries')->name('charts.add_campaign_supported_countries');
Route::any('/active_ad_campaigns', 'ChartDataController@active_ad_campaigns')->name('charts.active_ad_campaigns');
Route::any('/bat_creator_summary', 'ChartDataController@bat_creator_summary')->name('charts.bat_creator_summary');
Route::any('/creator_stats', 'ChartDataController@creator_stats')->name('charts.creator_stats');
Route::any('/creator_daily_addition_stats/{channel?}', 'ChartDataController@creator_daily_addition_stats')->name('charts.creator_daily_addition_stats');
Route::any('/creator_daily_total_stats/{channel?}', 'ChartDataController@creator_daily_total_stats')->name('charts.creator_daily_total_stats');
Route::any('/top_creators/{channel}', 'ChartDataController@top_creators')->name('charts.top_creators');
Route::any('/creator_validation/{channel}', 'ChartDataController@creator_validation')->name('charts.creator_validation');
Route::any('/communities/{site}/{community}', 'ChartDataController@communities')->name('charts.communities');

// BAT Chart APIS
Route::any('/bat_price', 'ChartDataBatStatsController@batPrice')->name('charts.bat_price');
Route::any('/bat_holders_count', 'ChartDataBatStatsController@batHoldersCount')->name('charts.bat_holders_count');
Route::any('/bat_holders_add', 'ChartDataBatStatsController@batHoldersAdd')->name('charts.bat_holders_add');
Route::any('/bat_volume', 'ChartDataBatStatsController@batVolume')->name('charts.bat_volume');
Route::any('/bat_market_cap', 'ChartDataBatStatsController@batMarketCap')->name('charts.bat_market_cap');

// Dashboard Chart APIS
Route::any('/daily_verified', 'DashboardDataController@daily_verified')->name('charts.daily_verified');
