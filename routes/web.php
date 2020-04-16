<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('welcome');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Stats
Route::get('brave_browser_active_users', 'StatsController@brave_browser_active_users')->name('stats.brave_browser_active_users');
Route::get('brave_initiated_bat_purchase', 'StatsController@brave_initiated_bat_purchase')->name('stats.brave_initiated_bat_purchase');

// Chart APIs
Route::any('/charts/dau', 'ChartDataController@dau')->name('charts.dau');
Route::any('/charts/bat_purchase', 'ChartDataController@batPurchase')->name('charts.bat_purchase');
