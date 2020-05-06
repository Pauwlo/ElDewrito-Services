<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
     * The commands that belong to the variant.
     */
    public function commands()
    {
        return $this->belongsToMany(Command::class);
    }

    /**
     * The commands that do not belong to the variant.
     */
    public function commandsAvailable()
    {
        $ids = DB::table('command_variant')
                 ->where('variant_id', $this->id)
                 ->pluck('command_id');

        return Command::whereNotIn('id', $ids)->get();
    }

    /**
     * The options that belong to the variant.
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
