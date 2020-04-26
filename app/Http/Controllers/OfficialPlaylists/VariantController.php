<?php

namespace App\Http\Controllers\OfficialPlaylists;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficialPlaylists\CreateVariantRequest;
use App\Http\Requests\OfficialPlaylists\UpdateVariantRequest;
use App\OfficialPlaylists\Variant;
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
}
