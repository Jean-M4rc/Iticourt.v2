<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    protected $fillable = [

        'user_id','longitude','latitude','avatar1_path','avatar2_path','avatar3_path','presentation','business_name','phone','address',
    ];

    /**
     * Relation des catégories de produits et des vendeurs
     *
     * @return array
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Relation du vendeur qui est d'abord un utilisateur
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Relation qui détermine la relation entre les commentaires et la fiche vendeur
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }
}
