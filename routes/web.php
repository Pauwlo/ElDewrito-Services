<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::get('password/change', 'ProfileController@showChangePassword')->name('password.change');
Route::put('password/change', 'ProfileController@changePassword');

Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('profile', 'ProfileController@update');
Route::delete('profile', 'ProfileController@delete')->name('profile.delete');
Route::get('profile/delete', 'ProfileController@showDeleteConfirmation')->name('profile.delete.confirmation');

Route::namespace('Api')->group(function () {

    Route::put('api/theme', 'ThemesController@update');

});

/*
 * Note: Some API routes are stored here (instead of using
 * routes\api.php because they might require User
 * authentication, therefore sharing the same session.
 */

Route::namespace('OfficialPlaylists')->group(function () {

    Route::get('official-playlists', 'OfficialPlaylistController@index')->name('official-playlists.index');
    Route::get('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@showRanked')->name('official-playlists.ranked.show');
    Route::get('official-playlists/social/{playlist}', 'OfficialPlaylistController@showSocial')->name('official-playlists.social.show');

});
