<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function sellers()
    {
        return $this->belongsToMany('App\Seller');
    }
}
