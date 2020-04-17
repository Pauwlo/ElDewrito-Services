<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\OfficialPlaylists\RankedPlaylist;
use App\OfficialPlaylists\SocialPlaylist;
use App\Http\Requests\UpdateOfficialPlaylistRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OfficialPlaylistController extends Controller
{
    /**
     * Display a listing of the official playlists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rankedPlaylists = RankedPlaylist::all();
        $socialPlaylists = SocialPlaylist::all();

        return view('official-playlists.index', compact('rankedPlaylists', 'socialPlaylists'));
    }

    /**
     * Display the specified ranked official playlist.
     *
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function showRanked(RankedPlaylist $playlist)
    {
        $type = __('Ranked playlist');
        $title = "$type: $playlist->name";
        $editRoute = route('official-playlists.ranked.edit', $playlist);
        $destroyRoute = route('official-playlists.ranked.destroy', $playlist);

        return view('official-playlists.show', compact('playlist', 'type', 'title', 'editRoute', 'destroyRoute'));
    }

    /**
     * Display the specified social official playlist.
     *
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function showSocial(SocialPlaylist $playlist)
    {
        $type = __('Social playlist');
        $title = "$type: $playlist->name";
        $editRoute = route('official-playlists.social.edit', $playlist);
        $destroyRoute = route('official-playlists.social.destroy', $playlist);

        return view('official-playlists.show', compact('playlist', 'type', 'title', 'editRoute', 'destroyRoute'));
    }

    /**
     * Show the form for editing the specified ranked official playlist.
     *
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function editRanked(RankedPlaylist $playlist)
    {
        $type = __('Ranked playlist');
        $title = __('Edit ranked playlist:') . " $playlist->name";
        $updateRoute = route('official-playlists.ranked.update', $playlist);

        return view('official-playlists.edit', compact('playlist', 'type', 'title', 'updateRoute'));
    }

    /**
     * Show the form for editing the specified social official playlist.
     *
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function editSocial(SocialPlaylist $playlist)
    {
        $type = __('Social playlist');
        $title = __('Edit social playlist:') . " $playlist->name";
        $updateRoute = route('official-playlists.social.update', $playlist);

        return view('official-playlists.edit', compact('playlist', 'type', 'title', 'updateRoute'));
    }

    /**
     * Update the specified ranked official playlist in storage.
     *
     * @param  \App\Requests\UpdateOfficialPlaylistRequest  $request
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function updateRanked(UpdateOfficialPlaylistRequest $request, RankedPlaylist $playlist)
    {
        $attributes = [
            'name' => request('name'),
            'server_name' => request('server-name'),
            'message' => Str::of(request('message'))->replace("\r", ''),
            'max_players' => request('max-players'),
            'vote_mode' => (request('vote-mode') === 'voting') ? 0 : 1,
            'number_of_revotes' => request('number-of-revotes'),
        ];

        if (request('name') !== $playlist->name) {
            $attributes['slug'] = Str::slug(request('name') . ' ' . random_int(10000, 99999));
        }

        $playlist->update($attributes);

        return redirect()->route('official-playlists.ranked.show', $playlist)
                         ->with('status', __('Playlist updated!'));
    }

    /**
     * Update the specified social official playlist in storage.
     *
     * @param  \App\Requests\UpdateOfficialPlaylistRequest  $request
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function updateSocial(UpdateOfficialPlaylistRequest $request, SocialPlaylist $playlist)
    {
        $attributes = [
            'name' => request('name'),
            'server_name' => request('server-name'),
            'message' => Str::of(request('message'))->replace("\r", ''),
            'max_players' => request('max-players'),
            'vote_mode' => (request('vote-mode') === 'voting') ? 0 : 1,
            'number_of_revotes' => request('number-of-revotes'),
        ];

        if (request('name') !== $playlist->name) {
            $attributes['slug'] = Str::slug(request('name') . ' ' . random_int(10000, 99999));
        }

        $playlist->update($attributes);

        return redirect()->route('official-playlists.social.show', $playlist)
                         ->with('status', __('Playlist updated!'));
    }

    /**
     * Remove the specified ranked official playlist from storage.
     *
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroyRanked(RankedPlaylist $playlist)
    {
        $playlist->delete();

        return redirect()->route('official-playlists.index')
                         ->with('status', __('Playlist deleted!'));
    }

    /**
     * Remove the specified social official playlist from storage.
     *
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroySocial(SocialPlaylist $playlist)
    {
        $playlist->delete();

        return redirect()->route('official-playlists.index')
                         ->with('status', __('Playlist deleted!'));
    }
}
