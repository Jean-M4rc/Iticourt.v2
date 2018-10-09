<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Seller;

class CompteController extends Controller
{
    public function accueil()
    {
        $user = auth()->user();
        return view('profil', [
            'user' => $user,
        ]);
    }

    public function deconnexion()
    {
        auth()->logout();

        flash("Vous êtes bien déconnecté. A bientôt !")->success();

        return redirect('/');
    }

    public function deleteMyAccount()
    {
        request()->validate([
            'user_id' => ['required'],
        ]);
        
        $user = User::where('id', request('user_id'))->with('seller','comments')->first();

        

        if($user->seller){

            $seller = $user->seller;
            // On supprime la relation de catégorie
            $seller->categories()->detach();

            // On supprime les photo de point de vente
            $oldpicture = $seller->avatar1_path;
            $filename = explode("/",$oldpicture);
            $file = $filename[1];
            Storage::delete('/public/sellersAvatar/'.$file);
            
            if($seller->avatar2_path){
                $oldpicture = $seller->avatar2_path;
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                Storage::delete('/public/sellersAvatar/'.$file);
            }

            if($seller->avatar3_path){
                $oldpicture = $seller->avatar3_path;
                $filename = explode("/",$oldpicture);
                $file = $filename[1];
                Storage::delete('/public/sellersAvatar/'.$file);
            }
        }

        //On supprime la photo de profil.
        $oldpicture = $user->avatar_path;
        if($oldpicture !=='usersAvatar/avatarUserDefault.jpeg'){                
            $filename = explode("/",$oldpicture);
            $file = $filename[1];
            Storage::delete('/public/usersAvatar/'.$file);
        }

        $user->delete();

        flash('Vous avez supprimé votre compte. A bientôt !')->success();

        return redirect('/');
    }

    public function deleteMyShop()
    {
        request()->validate([
            'seller_id' => ['required'],
        ]);
        
        $seller = Seller::where('id', request('seller_id'))->with('categories','comments')->first();

        // On supprime la relation de catégorie
        $seller->categories()->detach();

        // On supprime les photo de point de vente
        $oldpicture = $seller->avatar1_path;
        $filename = explode("/",$oldpicture);
        $file = $filename[1];
        Storage::delete('/public/sellersAvatar/'.$file);
        
        if($seller->avatar2_path){
            $oldpicture = $seller->avatar2_path;
            $filename = explode("/",$oldpicture);
            $file = $filename[1];
            Storage::delete('/public/sellersAvatar/'.$file);
        }

        if($seller->avatar3_path){
            $oldpicture = $seller->avatar3_path;
            $filename = explode("/",$oldpicture);
            $file = $filename[1];
            Storage::delete('/public/sellersAvatar/'.$file);
        }

        $seller->delete();

        flash('Votre point de vente a été supprimé')->success();

        return redirect('/');
    }
    
}
