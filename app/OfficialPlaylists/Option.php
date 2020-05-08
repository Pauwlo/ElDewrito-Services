<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'can_be_veto_result' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'map_id',
        'variant_id',
        'can_be_veto_result',
        'slug',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'op_options';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['playlists'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the map that owns the option.
     */
    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    /**
     * Get the variant that owns the option.
     */
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * The playlists that belong to the option.
     */
    public function playlists()
    {
        return $this->belongsToMany(RankedPlaylist::class, 'op_option_rankedplaylist', 'option_id', 'rankedplaylist_id');
    }
}
