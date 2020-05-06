<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
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
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['playlists', 'options'];

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
     * The playlists that belong to the variant.
     */
    public function playlists()
    {
        return $this->belongsToMany(SocialPlaylist::class, 'socialplaylist_variant', 'variant_id', 'socialplaylist_id');
    }

    /**
     * The options that belong to the variant.
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
