<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

    /**
     * Vérifier si un champ et rempli et s'il l'est vérifier les données et mettre à jour
     * Le prénom/pseudo
     * Le nom
     * L'email (unique)
     * Le mot de passe
     * La photo
     *
     * @return void
     */
    public function updateUser()
    {
        $user = auth()->user();

        // Le pseudo
        if (request('nickname')){

            request()->validate([
                'nickname' => ['string','min:4'],
            ]);

            $user->update([
                'nickname'=>request('nickname'),
            ]);

            flash('Vos informations ont été mise à jour');
        }
        
        // Le nom
        if (request('firstname')){

            request()->validate([
                'firstname' => ['string','min:4'],
            ]);

            $user->update([
                'firstname'=>request('firstname'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // l'email
        if (request('email')){

            request()->validate([
                'email' => ['email','unique:users,email'],
            ]);

            $user->update([
                'email'=>request('email'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // le nouveau mot de passe
        if (request('newPassword')){

            request()->validate([
                'newPassword' => ['confirmed','min:6'],
                'newPassword_confirmation' => ['required'],
            ]);

            $user->update([
                'password'=>bcrypt(request('newPassword')),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // la photo de profil
        if (request('avatarProfil')){

            //On supprime l'ancienne image si ce n'est pas l'image par defaut.
            $oldpicture = $user->avatar_path;
            if($oldpicture !=='usersAvatar/avatarUserDefault.jpeg'){

                dd($oldpicture);
                
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                //Storage::delete('/public/sellersAvatar/'.$file);
            }
            
            request()->validate([
                'avatarProfil' => ['image'],
            ]);

            $path = request('avatarProfil')->store('usersAvatar','public');

            $user->update([
                'avatar_path' =>$path,
            ]);

            flash('Vos informations ont été mise à jour');
        }

        return back();
    }

    /**
     * Vérifier si un champ et rempli et s'il l'est vérifier les données et mettre à jour
     * Le nom de la structure
     * La présentation de la structure
     * Les coordonnées GPS
     * Le téléphone
     * Les catégories de produits
     * Les photos
     *
     * @return void
     */
    public function updateSeller()
    {
        $seller = auth()->user()->seller;

        // Les catégories sont requises pour éviter toutes erreurs
        request()->validate([
            'product_category'=>['required','array'],
        ]);

        // Le nom de la structure
        if (request('business_name')){

            $seller->update([
                'business_name'=>request('business_name'),
            ]);

            flash('Vos informations ont été mise à jour');
        }
        
        // La présentation
        if (request('teaserSeller')){

            request()->validate([
                'teaserSeller' => ['string','min:4'],
            ]);

            $seller->update([
                'presentation'=>request('teaserSeller'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // le téléphone
        if (request('phone')){

            request()->validate([
                'phone' => ['string'],
            ]);

            $seller->update([
                'telephone'=>request('phone'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // l'adresse
        if (request('address')){

            request()->validate([
                'address' => ['string'],
            ]);

            $seller->update([
                'address'=>request('address'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        // Les catégories
        if (request('product_category')){

            //On détache les anciennes catégories
            $seller->categories()->detach();


            // On attache le vendeur à ses categories
            $category = request('product_category');
            $seller->categories()->attach($category);

        }

        // Les coordonnées GPS
        if(request('long')){

            request()->validate([
                'long'=>['numeric', 'between:-180,180'],
            ]);

            $seller->update([
                'longitude'=>request('long'),
            ]);

            flash('Vos informations ont été mise à jour');
        }

        if(request('lat')){

            request()->validate([
                'lat'=>['required','numeric', 'between:-90,90'],
            ]);

            $seller->update([
                'latitude'=>request('lat'),
            ]);

            flash('Vos informations ont été mise à jour');
        }            

        // les photos du point de vente
        if (request('avatarSeller1')){

            request()->validate([
                'avatarSeller1' => ['image'],
            ]);

            //ici on supprime l'ancienne photo si elle existe
            if($seller->avatar1_path){
                $oldpicture = $seller->avatar1_path;
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                Storage::delete('/public/sellersAvatar/'.$file);
            }

            $path = request('avatarSeller1')->store('sellersAvatar','public');

            $seller->update([
                'avatar1_path' =>$path,
            ]);

            flash('Vos informations ont été mise à jour');
        }

        if (request('avatarSeller2')){

            //ici on supprime l'ancienne photo si elle existe
            if($seller->avatar2_path){
                $oldpicture = $seller->avatar2_path;
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                Storage::delete('/public/sellersAvatar/'.$file);
            }
            
            request()->validate([
                'avatarSeller2' => ['image'],
            ]);

            $path = request('avatarSeller2')->store('sellersAvatar','public');

            auth()->user()->seller()->update([
                'avatar2_path' =>$path,
            ]);

            flash('Vos informations ont été mise à jour');
        }

        if (request('avatarSeller3')){

            request()->validate([
                'avatarSeller3' => ['image'],
            ]);

            //ici on supprime l'ancienne photo si elle existe
            if($seller->avatar3_path){
                $oldpicture = $seller->avatar3_path;
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                Storage::delete('/public/sellersAvatar/'.$file);
            }

            $path = request('avatarSeller3')->store('sellersAvatar','public');

            auth()->user()->seller()->update([
                'avatar3_path' =>$path,
            ]);

            flash('Vos informations ont été mise à jour');
        }

        return back();
    }

}
