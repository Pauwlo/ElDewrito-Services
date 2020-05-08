<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name',
        'file_name',
        'slug',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'op_maps';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['playlists', 'options', 'variants'];

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
     * The playlists that belong to the map.
     */
    public function playlists()
    {
        return $this->belongsToMany(SocialPlaylist::class, 'op_map_socialplaylist', 'map_id', 'socialplaylist_id');
    }

    /**
     * The options that belong to the map.
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * The variants that belong to the map.
     */
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'op_map_variant');
    }
}
