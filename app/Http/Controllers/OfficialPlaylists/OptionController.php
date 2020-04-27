<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialPlaylists\CreateOptionRequest;
use App\Http\Requests\OfficialPlaylists\UpdateOptionRequest;
use App\OfficialPlaylists\Map;
use App\OfficialPlaylists\Option;
use App\OfficialPlaylists\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OptionController extends Controller
{
    /**
     * Display a listing of the options.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::all();

        return view('official-playlists.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new option.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maps = Map::all();
        $variants = Variant::all();

        return view('official-playlists.options.create', compact('maps', 'variants'));
    }

    /**
     * Store a newly created option in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\CreateOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOptionRequest $request)
    {
        $map = Map::where('slug', request('map'))->first();
        $variant = Variant::where('slug', request('variant'))->first();

        $option = Option::create([
            'map_id' => $map->id,
            'variant_id' => $variant->id,
            'can_be_veto_result' => $request->has('can-be-veto-result'),
            'slug' => Str::slug(random_int(10000, 99999)),
        ]);

        return redirect()->route('official-playlists.options.show', $option)
                         ->with('status', __('Option created!'));
    }

    /**
     * Display the specified option.
     *
     * @param  \App\OfficialPlaylists\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return view('official-playlists.options.show', compact('option'));
    }

    /**
     * Show the form for editing the specified option.
     *
     * @param  \App\OfficialPlaylists\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $maps = Map::all();
        $variants = Variant::all();

        return view('official-playlists.options.edit', compact('option', 'maps', 'variants'));
    }

    /**
     * Update the specified option in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdateOptionRequest  $request
     * @param  \App\OfficialPlaylists\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $map = Map::where('slug', request('map'))->first();
        $variant = Variant::where('slug', request('variant'))->first();

        $attributes = [
            'map_id' => $map->id,
            'variant_id' => $variant->id,
            'can_be_veto_result' => $request->has('can-be-veto-result'),
        ];

        $option->update($attributes);

        return redirect()->route('official-playlists.options.show', $option)
                         ->with('status', __('Option updated!'));
    }

    /**
     * Remove the specified option from storage.
     *
     * @param  \App\OfficialPlaylists\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('official-playlists.options.index')
                         ->with('status', __('Option deleted!'));
    }
}
