<?php

namespace App\OfficialPlaylists;

use Illuminate\Support\Facades\DB;

class RankedPlaylist extends OfficialPlaylist
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rankedplaylists';

    /**
     * The options that belong to the playlist.
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_rankedplaylist', 'rankedplaylist_id');
    }

    /**
     * The options that do not belong to the playlist.
     */
    public function optionsAvailable()
    {
        $ids = DB::table('option_rankedplaylist')
                 ->where('rankedplaylist_id', $this->id)
                 ->pluck('option_id');

        return Option::whereNotIn('id', $ids)->get();
    }
}
