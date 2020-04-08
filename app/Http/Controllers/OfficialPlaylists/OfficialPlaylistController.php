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
}
