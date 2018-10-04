<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'firstname','nickname','email','password','avatar_path','ban'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at'=> 'datetime:d-m-Y',
        'updated_at',
        'deleted_at'
    ];

    public function seller()
    {
        return $this->hasOne('App\Seller');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
