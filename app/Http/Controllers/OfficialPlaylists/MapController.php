<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialPlaylists\CreateMapRequest;
use App\Http\Requests\OfficialPlaylists\UpdateMapRequest;
use App\OfficialPlaylists\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MapController extends Controller
{
    /**
     * Display a listing of the maps.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::orderBy('display_name')->get();

        return view('official-playlists.maps.index', compact('maps'));
    }

    /**
     * Show the form for creating a new map.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('official-playlists.maps.create');
    }

    /**
     * Store a newly created map in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\CreateMapRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMapRequest $request)
    {
        $map = Map::create([
            'display_name' => request('display-name'),
            'file_name' => request('file-name'),
            'slug' => Str::slug(request('file-name') . ' ' . random_int(10000, 99999)),
        ]);

        return redirect()->route('official-playlists.playlists.maps.show', $map)
                         ->with('status', __('Map added!'));
    }

    /**
     * Display the specified map.
     *
     * @param  \App\OfficialPlaylists\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        return view('official-playlists.maps.show', compact('map'));
    }

    /**
     * Show the form for editing the specified map.
     *
     * @param  \App\OfficialPlaylists\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        return view('official-playlists.maps.edit', compact('map'));
    }

    /**
     * Update the specified map in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdateMapRequest  $request
     * @param  \App\OfficialPlaylists\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapRequest $request, Map $map)
    {
        $attributes = [
            'display_name' => request('display-name'),
            'file_name' => request('file-name'),
        ];

        if (request('file-name') !== $map->file_name) {
            $attributes['slug'] = Str::slug(request('file-name') . ' ' . random_int(10000, 99999));
        }

        $map->update($attributes);

        return redirect()->route('official-playlists.maps.show', $map)
                         ->with('status', __('Map updated!'));
    }

    /**
     * Remove the specified map from storage.
     *
     * @param  \App\OfficialPlaylists\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        $map->delete();

        return redirect()->route('official-playlists.maps.index')
                         ->with('status', __('Map removed!'));
    }
}
