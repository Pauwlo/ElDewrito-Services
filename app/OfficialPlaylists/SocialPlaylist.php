<?php

namespace App\OfficialPlaylists;

use Illuminate\Support\Facades\DB;

class SocialPlaylist extends OfficialPlaylist
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'op_socialplaylists';

    /**
     * The maps that belong to the playlist.
     */
    public function maps()
    {
        return $this->belongsToMany(Map::class, 'op_map_socialplaylist', 'socialplaylist_id');
    }

    /**
     * The variants that belong to the playlist.
     */
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'op_socialplaylist_variant', 'socialplaylist_id');
    }

    /**
     * The maps that do not belong to the playlist.
     */
    public function mapsAvailable()
    {
        $ids = DB::table('op_map_socialplaylist')
                 ->where('socialplaylist_id', $this->id)
                 ->pluck('map_id');

        return Map::whereNotIn('id', $ids)->get();
    }

    /**
     * The variants that do not belong to the playlist.
     */
    public function variantsAvailable()
    {
        $ids = DB::table('op_socialplaylist_variant')
                 ->where('socialplaylist_id', $this->id)
                 ->pluck('variant_id');

        return Variant::whereNotIn('id', $ids)->get();
    }
}
