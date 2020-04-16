<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\OfficialPlaylists\SocialPlaylist;
use App\OfficialPlaylists\RankedPlaylist;
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

        return view('official-playlists.show', compact('title', 'type', 'playlist'));
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

        return view('official-playlists.show', compact('title', 'type', 'playlist'));
    }
}
