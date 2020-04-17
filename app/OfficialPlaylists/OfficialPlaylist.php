<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

abstract class OfficialPlaylist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'server_name',
        'message',
        'max_players',
        'vote_mode',
        'number_of_revotes',
    ];

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
