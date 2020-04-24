<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('welcome');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Stats
Route::get('brave_browser_active_users', 'StatsController@brave_browser_active_users')->name('stats.brave_browser_active_users');
Route::get('brave_initiated_bat_purchase', 'StatsController@brave_initiated_bat_purchase')->name('stats.brave_initiated_bat_purchase');
Route::get('brave_ads_campaigns', 'StatsController@brave_ads_campaigns')->name('stats.brave_ads_campaigns');
Route::get('creators/{channel}', 'CreatorsController@index')->name('creators.index');

Route::get('creators/{channel}/{id}', 'CreatorsController@show')->name('creators.show');



// Chart APIs
Route::any('/charts/dau', 'ChartDataController@dau')->name('charts.dau');
Route::any('/charts/bat_purchases', 'ChartDataController@batPurchases')->name('charts.bat_purchases');
Route::any('/charts/ad_campaign_supported_countries', 'ChartDataController@adCampaignSupportedCountries')->name('charts.add_campaign_supported_countries');
Route::any('/charts/active_ad_campaigns', 'ChartDataController@activeAdCampaigns')->name('charts.active_ad_campaigns');
Route::any('/charts/bat_creator_summary', 'ChartDataController@batCreatorSummary')->name('charts.bat_creator_summary');
Route::any('/charts/creator_stats/{channel?}', 'ChartDataController@creatorStats')->name('charts.creator_stats');

// Other Pages
Route::get('privacy_policy', 'HomeController@privacy_policy')->name('privacy_policy');
