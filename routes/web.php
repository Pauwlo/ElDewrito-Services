<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::get('password/change', 'ProfileController@showChangePassword')->name('password.change');
Route::put('password/change', 'ProfileController@changePassword');

Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('profile', 'ProfileController@update');
