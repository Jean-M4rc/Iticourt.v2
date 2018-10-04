<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'user_id','seller_id','title','content',
    ];

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
