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

    Route::get('official-playlists', 'OfficialPlaylistController@index')->name('official-playlists.playlists.index');
    Route::get('official-playlists/create', 'OfficialPlaylistController@create')->name('official-playlists.playlists.create');
    Route::post('official-playlists', 'OfficialPlaylistController@store')->name('official-playlists.playlists.store');

    Route::get('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@showRanked')->name('official-playlists.playlists.ranked.show');
    Route::put('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@updateRanked')->name('official-playlists.playlists.ranked.update');
    Route::get('official-playlists/ranked/{playlist}/edit', 'OfficialPlaylistController@editRanked')->name('official-playlists.playlists.ranked.edit');
    Route::delete('official-playlists/ranked/{playlist}', 'OfficialPlaylistController@destroyRanked')->name('official-playlists.playlists.ranked.destroy');
    Route::get('official-playlists/ranked/{playlist}/json', 'OfficialPlaylistController@jsonRanked')->name('official-playlists.playlists.ranked.json');

    Route::get('official-playlists/social/{playlist}', 'OfficialPlaylistController@showSocial')->name('official-playlists.playlists.social.show');
    Route::put('official-playlists/social/{playlist}', 'OfficialPlaylistController@updateSocial')->name('official-playlists.playlists.social.update');
    Route::get('official-playlists/social/{playlist}/edit', 'OfficialPlaylistController@editSocial')->name('official-playlists.playlists.social.edit');
    Route::delete('official-playlists/social/{playlist}', 'OfficialPlaylistController@destroySocial')->name('official-playlists.playlists.social.destroy');
    Route::get('official-playlists/social/{playlist}/json', 'OfficialPlaylistController@jsonSocial')->name('official-playlists.playlists.social.json');

    Route::get('official-playlists/maps', 'MapController@index')->name('official-playlists.maps.index');
    Route::get('official-playlists/maps/create', 'MapController@create')->name('official-playlists.maps.create');
    Route::post('official-playlists/maps', 'MapController@store')->name('official-playlists.maps.store');
    Route::get('official-playlists/maps/{map}', 'MapController@show')->name('official-playlists.maps.show');
    Route::get('official-playlists/maps/{map}/edit', 'MapController@edit')->name('official-playlists.maps.edit');
    Route::put('official-playlists/maps/{map}', 'MapController@update')->name('official-playlists.maps.update');
    Route::delete('official-playlists/maps/{map}', 'MapController@destroy')->name('official-playlists.maps.destroy');

    Route::get('official-playlists/variants', 'VariantController@index')->name('official-playlists.variants.index');
    Route::get('official-playlists/variants/create', 'VariantController@create')->name('official-playlists.variants.create');
    Route::post('official-playlists/variants', 'VariantController@store')->name('official-playlists.variants.store');
    Route::get('official-playlists/variants/{variant}', 'VariantController@show')->name('official-playlists.variants.show');
    Route::get('official-playlists/variants/{variant}/edit', 'VariantController@edit')->name('official-playlists.variants.edit');
    Route::put('official-playlists/variants/{variant}', 'VariantController@update')->name('official-playlists.variants.update');
    Route::delete('official-playlists/variants/{variant}', 'VariantController@destroy')->name('official-playlists.variants.destroy');

    Route::get('official-playlists/commands', 'CommandController@index')->name('official-playlists.commands.index');
    Route::get('official-playlists/commands/create', 'CommandController@create')->name('official-playlists.commands.create');
    Route::post('official-playlists/commands', 'CommandController@store')->name('official-playlists.commands.store');
    Route::get('official-playlists/commands/{command}', 'CommandController@show')->name('official-playlists.commands.show');
    Route::get('official-playlists/commands/{command}/edit', 'CommandController@edit')->name('official-playlists.commands.edit');
    Route::put('official-playlists/commands/{command}', 'CommandController@update')->name('official-playlists.commands.update');
    Route::delete('official-playlists/commands/{command}', 'CommandController@destroy')->name('official-playlists.commands.destroy');
});
