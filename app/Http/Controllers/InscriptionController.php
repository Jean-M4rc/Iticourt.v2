<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Seller;

class InscriptionController extends Controller
{
    /**
     * Affichage du formulaire
     *
     * @return view
     */
    public function formulaire()
    {
        return view('inscription');
    }

    /**
     * Traitement du formulaire Acheteur
     *
     * @return view
     */
    public function traitementAcheteur()
    {       
        // Validation des champs du formulaire d'inscription

        request()->validate([

            'email' => ['required', 'email','unique:users,email'],
            'nickname' => ['required', 'string','min:4'],
            'firstname' => ['string','nullable','min:3'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required'],

        ]);

        
        $user = User::create([

            'email' => request('email'),
            'nickname' => request('nickname'),
            'firstname' => request('firstname'),
            'password' => bcrypt(request('password')),

        ]);

        auth()->attempt([
            'email'=> request('email'),
            'password' => request('password'),
        ]);

        flash("Vous êtes bien inscrit")->success();

        return redirect('/');

    }

    public function traitementVendeur()
    {

        request()->validate([

            'email' => ['required', 'email','unique:users,email'],
            'nickname' => ['required', 'string','min:4'],
            'firstname' => ['string','nullable','min:3'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required'],
            'businessName'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
            'product_category'=>['required','array'],
            'lat'=>['required','numeric', 'between:-90,90'],
            'long'=>['required','numeric', 'between:-180,180'],
            'teaserSeller'=>['required'],
            'avatar'=>['required', 'image'],
            'avatar1'=>['nullable', 'image'],
            'avatar2'=>['nullable', 'image'],
            'seller_confirmation' => ['required'],
        
        ]);

        $user = User::create([

            'email' => request('email'),
            'nickname' => request('nickname'),
            'firstname' => request('firstname'),
            'password' => bcrypt(request('password')),

        ]);

        if($user)

        // Traitement des images

        // Image principale requise
        $path1 = request('avatar')->store('sellersAvatar','public');

        // Champs non requis - définition variables nulles.
        $path2 ='';
        $path3 ='';

        if(request('avatar1')){
            $path2 = request('avatar1')->store('sellersAvatar','public');
        }
        
        if (request('avatar2')){
            $path3 = request('avatar2')->store('sellersAvatar','public');
        }

        // On défini le vendeur par l'user et la relation user->seller()
        $seller = $user->seller()->create([

            'longitude' => request('long'),
            'latitude' => request('lat'),
            'avatar1_path' => $path1,
            'avatar2_path' => $path2,
            'avatar3_path' => $path3,
            'presentation' => request('teaserSeller'),
            'business_name' => request('businessName'),
            'phone' => request('phone'),
            'address' => request('address'),

        ]);

        $seller->user()->associate($user);

        // On attribut le tableau des catégories du vendeur à la variable $category_followed
        $category = request('product_category');

        // On attache le vendeur à ses categories
        $seller->category()->attach($category);

        auth()->attempt([
            'email'=> request('email'),
            'password' => request('password'),
        ]);

        flash("Vous êtes bien inscrit et connecté")->success();

        return redirect('/');

    }
}
