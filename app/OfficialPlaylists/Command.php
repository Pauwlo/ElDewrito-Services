<?php

namespace App\OfficialPlaylists;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'command',
        'slug',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'op_commands';
    
    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['variants'];

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
     * The variants that belong to the command.
     */
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'op_command_variant');
    }
}
