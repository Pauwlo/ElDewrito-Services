<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\OfficialPlaylists\Map;
use App\OfficialPlaylists\Option;
use App\OfficialPlaylists\RankedPlaylist;
use App\OfficialPlaylists\SocialPlaylist;
use App\OfficialPlaylists\Variant;
use App\Http\Requests\OfficialPlaylists\AddPlaylistMapRequest;
use App\Http\Requests\OfficialPlaylists\AddPlaylistOptionRequest;
use App\Http\Requests\OfficialPlaylists\AddPlaylistVariantRequest;
use App\Http\Requests\OfficialPlaylists\CreatePlaylistRequest;
use App\Http\Requests\OfficialPlaylists\UpdatePlaylistRequest;
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

        return view('official-playlists.playlists.index', compact('rankedPlaylists', 'socialPlaylists'));
    }

    /**
     * Show the form for creating a new official playlist.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $defaultServerName = '';
        $defaultMessage = '';
        $type = '';

        switch (request('type')) {
            case 'ranked':
                $type = 'Ranked';
                break;
            case 'social':
                $type = 'Social';
                break;
        }

        if ($type) {
            $defaultServerName = "$type - ";
            $defaultMessage = "Thanks for playing on the official $type # server.\n\nType !help in chat for a list of commands.";
        }

        return view('official-playlists.playlists.create', compact(
            'defaultServerName',
            'defaultMessage',
        ));
    }

    /**
     * Store a newly created official playlist in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\CreatePlaylistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlaylistRequest $request)
    {
        $attributes = [
            'name' => request('name'),
            'slug' => Str::slug(request('name') . ' ' . random_int(10000, 99999)),
            'server_name' => request('server-name'),
            'message' => Str::of(request('message'))->replace("\r", ''),
            'max_players' => request('max-players'),
            'vote_mode' => (request('vote-mode') === 'voting') ? 0 : 1,
            'number_of_revotes' => request('number-of-revotes'),
        ];

        $type = request('type');

        if ($type === 'ranked') {
            $playlist = RankedPlaylist::create($attributes);
        } else {
            $playlist = SocialPlaylist::create($attributes);
        }

        return redirect()->route("official-playlists.playlists.$type.show", $playlist)
                         ->with('status', __('Playlist created!'));
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
        $jsonRoute = route('official-playlists.playlists.ranked.json', $playlist);
        $editRoute = route('official-playlists.playlists.ranked.edit', $playlist);
        $destroyRoute = route('official-playlists.playlists.ranked.destroy', $playlist);

        return view('official-playlists.playlists.show', compact(
            'playlist',
            'type',
            'title',
            'jsonRoute',
            'editRoute',
            'destroyRoute',
        ));
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
        $jsonRoute = route('official-playlists.playlists.social.json', $playlist);
        $editRoute = route('official-playlists.playlists.social.edit', $playlist);
        $destroyRoute = route('official-playlists.playlists.social.destroy', $playlist);

        return view('official-playlists.playlists.show', compact(
            'playlist',
            'type',
            'title',
            'jsonRoute',
            'editRoute',
            'destroyRoute',
        ));
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
        $updateRoute = route('official-playlists.playlists.ranked.update', $playlist);

        return view('official-playlists.playlists.edit', compact('playlist', 'type', 'title', 'updateRoute'));
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
        $updateRoute = route('official-playlists.playlists.social.update', $playlist);

        return view('official-playlists.playlists.edit', compact('playlist', 'type', 'title', 'updateRoute'));
    }

    /**
     * Update the specified ranked official playlist in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdatePlaylistRequest  $request
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function updateRanked(UpdatePlaylistRequest $request, RankedPlaylist $playlist)
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

        return redirect()->route('official-playlists.playlists.ranked.show', $playlist)
                         ->with('status', __('Playlist updated!'));
    }

    /**
     * Update the specified social official playlist in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdatePlaylistRequest  $request
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function updateSocial(UpdatePlaylistRequest $request, SocialPlaylist $playlist)
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

        return redirect()->route('official-playlists.playlists.social.show', $playlist)
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

        return redirect()->route('official-playlists.playlists.index')
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

        return redirect()->route('official-playlists.playlists.index')
                         ->with('status', __('Playlist deleted!'));
    }

    /**
     * Generate the specified ranked official playlist JSON file.
     *
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function jsonRanked(RankedPlaylist $playlist)
    {
        $output = [
            'serverName' => $playlist->server_name, 
            'serverMessage' => $playlist->message,
            'maxPlayers' => $playlist->max_players,
            'voteMode' => $playlist->vote_mode,
            'numberOfVetos' => $playlist->number_of_revotes,
        ];

        return response()->json($output, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Generate the specified social official playlist JSON file.
     *
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function jsonSocial(SocialPlaylist $playlist)
    {
        $output = [
            'serverName' => $playlist->server_name, 
            'serverMessage' => $playlist->message,
            'maxPlayers' => $playlist->max_players,
            'voteMode' => $playlist->vote_mode,
            'numberOfRevotesAllowed' => $playlist->number_of_revotes,
        ];

        return response()->json($output, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Attach an option to the specified ranked playlist.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\AddPlaylistOptionRequest  $request
     * @param  \App\OfficialPlaylists\RankedPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function addOption(AddPlaylistOptionRequest $request, RankedPlaylist $playlist)
    {
        $option = Option::where('slug', request('option'))->first();

        $playlist->options()->attach($option);
        $playlist->touch();

        $route = route('official-playlists.playlists.ranked.edit', $playlist) . '#edit-options';
        return redirect($route)->with('status', __('Option added!'));
    }

    /**
     * Attach a map to the specified social playlist.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\AddPlaylistMapRequest  $request
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function addMap(AddPlaylistMapRequest $request, SocialPlaylist $playlist)
    {
        $map = Map::where('slug', request('map'))->first();

        $playlist->maps()->attach($map);
        $playlist->touch();

        $route = route('official-playlists.playlists.social.edit', $playlist) . '#edit-maps';
        return redirect($route)->with('status', __('Map added!'));
    }

    /**
     * Attach a variant to the specified social playlist.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\AddPlaylistVariantRequest  $request
     * @param  \App\OfficialPlaylists\SocialPlaylist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function addVariant(AddPlaylistVariantRequest $request, SocialPlaylist $playlist)
    {
        $variant = Variant::where('slug', request('variant'))->first();

        $playlist->variants()->attach($variant);
        $playlist->touch();

        $route = route('official-playlists.playlists.social.edit', $playlist) . '#edit-variants';
        return redirect($route)->with('status', __('Variant added!'));
    }
}
