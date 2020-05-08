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
    protected $table = 'op_rankedplaylists';

    /**
     * The options that belong to the playlist.
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'op_option_rankedplaylist', 'rankedplaylist_id');
    }

    /**
     * The options that do not belong to the playlist.
     */
    public function optionsAvailable()
    {
        $ids = DB::table('op_option_rankedplaylist')
                 ->where('rankedplaylist_id', $this->id)
                 ->pluck('option_id');

        return Option::whereNotIn('id', $ids)->get();
    }
}
