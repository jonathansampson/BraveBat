<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome')->name('welcome');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

