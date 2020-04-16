<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

abstract class OfficialPlaylist extends Model
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
