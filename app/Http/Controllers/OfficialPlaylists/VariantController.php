<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialPlaylists\AddVariantCommandRequest;
use App\Http\Requests\OfficialPlaylists\AddVariantMapRequest;
use App\Http\Requests\OfficialPlaylists\CreateVariantRequest;
use App\Http\Requests\OfficialPlaylists\UpdateVariantRequest;
use App\OfficialPlaylists\Command;
use App\OfficialPlaylists\Map;
use App\OfficialPlaylists\RankedPlaylist;
use App\OfficialPlaylists\Variant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VariantController extends Controller
{
    /**
     * Display a listing of the variants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variants = Variant::orderBy('display_name')->get();

        return view('official-playlists.variants.index', compact('variants'));
    }

    /**
     * Show the form for creating a new variant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('official-playlists.variants.create');
    }

    /**
     * Store a newly created variant in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\CreateVariantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVariantRequest $request)
    {
        $variant = Variant::create([
            'display_name' => request('display-name'),
            'file_name' => request('file-name'),
            'slug' => Str::slug(request('file-name') . ' ' . random_int(10000, 99999)),
        ]);

        return redirect()->route('official-playlists.variants.show', $variant)
                         ->with('status', __('Variant added!'));
    }

    /**
     * Display the specified variant.
     *
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        return view('official-playlists.variants.show', compact('variant'));
    }

    /**
     * Show the form for editing the specified variant.
     *
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        return view('official-playlists.variants.edit', compact('variant'));
    }

    /**
     * Update the specified variant in storage.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\UpdateVariantRequest  $request
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariantRequest $request, Variant $variant)
    {
        $attributes = [
            'display_name' => request('display-name'),
            'file_name' => request('file-name'),
        ];

        if (request('file-name') !== $variant->file_name) {
            $attributes['slug'] = Str::slug(request('file-name') . ' ' . random_int(10000, 99999));
        }

        $variant->update($attributes);

        return redirect()->route('official-playlists.variants.show', $variant)
                         ->with('status', __('Variant updated!'));
    }

    /**
     * Remove the specified variant from storage.
     *
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('official-playlists.variants.index')
                         ->with('status', __('Variant removed!'));
    }

    /**
     * Attach a command to the specified variant.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\AddVariantCommandRequest  $request
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function addCommand(AddVariantCommandRequest $request, Variant $variant)
    {
        $command = Command::where('slug', request('command'))->first();

        $variant->commands()->attach($command);
        $variant->touch();

        $route = route('official-playlists.variants.edit', $variant) . '#edit-commands';
        return redirect($route)->with('status', __('Command added!'));
    }

    /**
     * Attach a map to the specified variant.
     *
     * @param  \App\Http\Requests\OfficialPlaylists\AddVariantMapRequest  $request
     * @param  \App\OfficialPlaylists\Variant  $variant
     * @return \Illuminate\Http\Response
     */
    public function addMap(AddVariantMapRequest $request, Variant $variant)
    {
        $map = Map::where('slug', request('map'))->first();

        /*
         * Note: Variant specific maps are only relevant to social playlists.
         * Therefore, we shouldn't touch() the options & ranked playlists
         * that are using this variant. This would show a "recently updated"
         * option/ranked playlist for nothing.
         */
        $oldOptions = $variant->options;

        $oldRankedPlaylists = RankedPlaylist::whereHas('options', function (Builder $query) use ($oldOptions) {
            $query->whereIn('option_id', $oldOptions->pluck(['id']));
        })->get();

        $variant->specificMaps()->attach($map);
        $variant->touch();

        /*
         * Now that the options and ranked playlists have been modified,
         * let's restore them to their previous updated_at timestamp.
         */
        foreach ($variant->options()->get() as $key => $option) {
            $option->updated_at = $oldOptions[$key]->updated_at;
            $option->save(['timestamps' => false]);
        }

        $rankedPlaylists = RankedPlaylist::whereIn('id', $oldRankedPlaylists->pluck(['id']))->get();
        foreach ($rankedPlaylists as $key => $playlist) {
            $playlist->updated_at = $oldRankedPlaylists[$key]->updated_at;
            $playlist->save(['timestamps' => false]);
        }

        $route = route('official-playlists.variants.edit', $variant) . '#edit-maps';
        return redirect($route)->with('status', __('Specific map added!'));
    }
}
