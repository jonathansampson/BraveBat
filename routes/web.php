<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('privacy_policy', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('terms_of_service', 'HomeController@terms_of_service')->name('terms_of_service');
// Stats
Route::get('brave_browser_active_users', 'StatsController@brave_browser_active_users')->name('stats.brave_browser_active_users');
Route::get('brave_initiated_bat_purchase', 'StatsController@brave_initiated_bat_purchase')->name('stats.brave_initiated_bat_purchase');
Route::get('brave_ads_campaigns', 'StatsController@brave_ads_campaigns')->name('stats.brave_ads_campaigns');
Route::get('brave_creator_historical_stats', 'StatsController@brave_creator_historical_stats')->name('stats.brave_creator_historical_stats');
Route::get('creators/{channel}', 'CreatorsController@index')->name('creators.index');
Route::get('creators/{channel}/{id}', 'CreatorsController@show')->name('creators.show');
Route::get('bat_stats', 'StatsController@bat_stats')->name('stats.bat_stats');
Route::get('top_creators', 'StatsController@top_creators')->name('stats.top_creators');
Route::get('creator_validation', 'StatsController@creator_validation')->name('stats.creator_validation');
Route::get('communities', 'StatsController@communities')->name('stats.communities');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('resend_verification_email', 'UsersController@resendVerificationEmail')->name('resend_verification_email');
    Route::post('tokens', 'TokensController@store')->name('tokens.store');
    Route::patch('tokens', 'TokensController@update')->name('tokens.update');
    Route::delete('tokens', 'TokensController@destroy')->name('tokens.destroy');
});

Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search', 'SearchController@store');
