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

Route::namespace('OfficialPlaylists')->prefix('official-playlists')->middleware('permission:official-playlists.access')->group(function () {

    Route::get('/', 'OfficialPlaylistController@index')->name('official-playlists.playlists.index');
    Route::get('create', 'OfficialPlaylistController@create')->name('official-playlists.playlists.create');
    Route::post('/', 'OfficialPlaylistController@store')->name('official-playlists.playlists.store');

    Route::prefix('ranked')->group(function () {
        Route::get('{playlist}', 'OfficialPlaylistController@showRanked')->name('official-playlists.playlists.ranked.show');
        Route::put('{playlist}', 'OfficialPlaylistController@updateRanked')->name('official-playlists.playlists.ranked.update');
        Route::get('{playlist}/edit', 'OfficialPlaylistController@editRanked')->name('official-playlists.playlists.ranked.edit');
        Route::delete('{playlist}', 'OfficialPlaylistController@destroyRanked')->name('official-playlists.playlists.ranked.destroy');
        Route::get('{playlist}/json', 'OfficialPlaylistController@jsonRanked')->name('official-playlists.playlists.ranked.json');
        Route::put('{playlist}/add', 'OfficialPlaylistController@addOption')->name('official-playlists.playlists.ranked.options.add');
    });

    Route::prefix('social')->group(function () {
        Route::get('{playlist}', 'OfficialPlaylistController@showSocial')->name('official-playlists.playlists.social.show');
        Route::put('{playlist}', 'OfficialPlaylistController@updateSocial')->name('official-playlists.playlists.social.update');
        Route::get('{playlist}/edit', 'OfficialPlaylistController@editSocial')->name('official-playlists.playlists.social.edit');
        Route::delete('{playlist}', 'OfficialPlaylistController@destroySocial')->name('official-playlists.playlists.social.destroy');
        Route::get('{playlist}/json', 'OfficialPlaylistController@jsonSocial')->name('official-playlists.playlists.social.json');
        Route::put('{playlist}/add', 'OfficialPlaylistController@addMap')->name('official-playlists.playlists.social.maps.add');
        Route::put('{playlist}/add', 'OfficialPlaylistController@addVariant')->name('official-playlists.playlists.social.variants.add');
    });

    Route::prefix('maps')->group(function () {
        Route::get('/', 'MapController@index')->name('official-playlists.maps.index');
        Route::get('create', 'MapController@create')->name('official-playlists.maps.create');
        Route::post('/', 'MapController@store')->name('official-playlists.maps.store');
        Route::get('{map}', 'MapController@show')->name('official-playlists.maps.show');
        Route::get('{map}/edit', 'MapController@edit')->name('official-playlists.maps.edit');
        Route::put('{map}', 'MapController@update')->name('official-playlists.maps.update');
        Route::delete('{map}', 'MapController@destroy')->name('official-playlists.maps.destroy');
    });

    Route::prefix('variants')->group(function () {
        Route::get('/', 'VariantController@index')->name('official-playlists.variants.index');
        Route::get('create', 'VariantController@create')->name('official-playlists.variants.create');
        Route::post('/', 'VariantController@store')->name('official-playlists.variants.store');
        Route::get('{variant}', 'VariantController@show')->name('official-playlists.variants.show');
        Route::get('{variant}/edit', 'VariantController@edit')->name('official-playlists.variants.edit');
        Route::put('{variant}', 'VariantController@update')->name('official-playlists.variants.update');
        Route::delete('{variant}', 'VariantController@destroy')->name('official-playlists.variants.destroy');
        Route::put('{variant}/add', 'VariantController@addCommand')->name('official-playlists.variants.commands.add');
        Route::put('{variant}/add', 'VariantController@addMap')->name('official-playlists.variants.maps.add');
    });

    Route::prefix('commands')->group(function () {
        Route::get('/', 'CommandController@index')->name('official-playlists.commands.index');
        Route::get('create', 'CommandController@create')->name('official-playlists.commands.create');
        Route::post('/', 'CommandController@store')->name('official-playlists.commands.store');
        Route::get('{command}', 'CommandController@show')->name('official-playlists.commands.show');
        Route::get('{command}/edit', 'CommandController@edit')->name('official-playlists.commands.edit');
        Route::put('{command}', 'CommandController@update')->name('official-playlists.commands.update');
        Route::delete('{command}', 'CommandController@destroy')->name('official-playlists.commands.destroy');
    });

    Route::prefix('options')->group(function () {
        Route::get('/', 'OptionController@index')->name('official-playlists.options.index');
        Route::get('create', 'OptionController@create')->name('official-playlists.options.create');
        Route::post('/', 'OptionController@store')->name('official-playlists.options.store');
        Route::get('{option}', 'OptionController@show')->name('official-playlists.options.show');
        Route::get('{option}/edit', 'OptionController@edit')->name('official-playlists.options.edit');
        Route::put('{option}', 'OptionController@update')->name('official-playlists.options.update');
        Route::delete('{option}', 'OptionController@destroy')->name('official-playlists.options.destroy');
    });
});
