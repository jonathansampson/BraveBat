<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('welcome');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('brave_browser_active_users', 'StatsController@brave_browser_active_users')->name('stats.brave_browser_active_users');

// Chart APIs
Route::any('/charts/dau', 'ChartDataController@dau')->name('charts.dau');
Route::any('/charts/bat_purchase', 'ChartDataController@batPurchase')->name('charts.bat_purchase');
