<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('privacy_policy', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('terms_of_service', 'HomeController@terms_of_service')->name('terms_of_service');

// Stats
Route::get('brave_browser_active_users', 'StatsController@brave_browser_active_users')->name('stats.brave_browser_active_users');
Route::get('brave_initiated_bat_purchase', 'StatsController@brave_initiated_bat_purchase')->name('stats.brave_initiated_bat_purchase');
Route::get('brave_ads_campaigns', 'StatsController@brave_ads_campaigns')->name('stats.brave_ads_campaigns');
Route::get('brave_creator_historical_stats', 'StatsController@brave_creator_historical_stats')->name('stats.brave_creator_historical_stats');
Route::get('creators/{channel}', 'CreatorsController@index')->name('creators.index');
Route::get('creators/{channel}/{id}', 'CreatorsController@show')->name('creators.show');



// Chart APIs
Route::any('/charts/dau', 'ChartDataController@dau')->name('charts.dau');
Route::any('/charts/bat_purchases', 'ChartDataController@batPurchases')->name('charts.bat_purchases');
Route::any('/charts/ad_campaign_supported_countries', 'ChartDataController@adCampaignSupportedCountries')->name('charts.add_campaign_supported_countries');
Route::any('/charts/active_ad_campaigns', 'ChartDataController@activeAdCampaigns')->name('charts.active_ad_campaigns');
Route::any('/charts/bat_creator_summary', 'ChartDataController@batCreatorSummary')->name('charts.bat_creator_summary');
Route::any('/charts/creator_stats', 'ChartDataController@creatorStats')->name('charts.creator_stats');
Route::any('/charts/creator_daily_addition_stats/{channel?}', 'ChartDataController@creatorDailyAdditionStats')->name('charts.creator_daily_addition_stats');
Route::any('/charts/creator_daily_total_stats/{channel?}', 'ChartDataController@creatorDailyTotalStats')->name('charts.creator_daily_total_stats');

//API
// Route::get('docs', function () {
//     return view('apidoc.index');
// });

// Route::get('api/78', function () {
//     return 'ok';
// });
