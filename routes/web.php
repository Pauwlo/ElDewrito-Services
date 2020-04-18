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
    Route::get('official-playlists/create', 'OfficialPlaylistController@create')->name('official-playlists.create');
    Route::post('official-playlists', 'OfficialPlaylistController@store')->name('official-playlists.store');

    Route::get('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@showRanked')->name('official-playlists.ranked.show');
    Route::put('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@updateRanked')->name('official-playlists.ranked.update');
    Route::get('official-playlists/ranked/{playlist}/edit', 'OfficialPlaylistController@editRanked')->name('official-playlists.ranked.edit');
    Route::delete('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@destroyRanked')->name('official-playlists.ranked.destroy');
    Route::get('official-playlists/ranked/{playlist}/json', 'OfficialPlaylistController@jsonRanked')->name('official-playlists.ranked.json');

    Route::get('official-playlists/social/{playlist}', 'OfficialPlaylistController@showSocial')->name('official-playlists.social.show');
    Route::put('official-playlists/social/{playlist}', 'OfficialPlaylistController@updateSocial')->name('official-playlists.social.update');
    Route::get('official-playlists/social/{playlist}/edit', 'OfficialPlaylistController@editSocial')->name('official-playlists.social.edit');
    Route::delete('official-playlists/social/{playlist}', 'OfficialPlaylistController@destroySocial')->name('official-playlists.social.destroy');
    Route::get('official-playlists/social/{playlist}/json', 'OfficialPlaylistController@jsonSocial')->name('official-playlists.social.json');

});
