<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'discord',
        'role',
        'theme',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set user email as unverified.
     * 
     * @return void
     */
    public function setEmailAsUnverified()
    {
        $this->email_verified_at = null;
        $this->save();
    }

    /**
     * Get the user role name.
     * 
     * @return string
     */
    public function roleToString()
    {
        if ($this->hasRole('administrator')) {
            return __('Administrator');
        } elseif ($this->hasRole('official-host')) {
            return __('Official Host');
        } else {
            return __('Member');
        }
    }
}
