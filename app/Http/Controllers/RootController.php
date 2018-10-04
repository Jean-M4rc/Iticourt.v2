<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Comment;
use App\Seller;

class RootController extends Controller
{

    /**
     * Accède au portail d'administration
     *
     * @return void
     */
    public function administration()
    {

        return view('root', [
            'utilisateurs' => User::with(['seller','comments'])->where('admin','0')->get(),
            'pdvs' => Seller::with('categories')->get()->load('user'),
            'comments' => Comment::with('seller')->latest()->get()->load('user'),
        ]);
    }

    /**
     * Banni un utilisateur
     *
     * @return void
     */
    public function bannissement()
    {
        request()->validate([
            'userId' => ['required'],
        ]);

        $userId = request('userId');

        $utilisateuràbannir = User::where('id',$userId)->first();


        if($utilisateuràbannir->ban === 1){

            $utilisateuràbannir->update([
                'ban' => 0,
            ]);

        } else {

            $utilisateuràbannir->update([
            'ban' => 1,
            ]);

        }
        
        return back();

    }

    /**
     * Réinitialise l'avatar du point de vente
     * En fonction des photos sélectionnées
     *
     * @return void
     */
    public function resetAvatar()
    {
        request()->validate([
            'userId' => ['required'],
            'avatarSellers' => ['required']
        ]);
        
        $sellerId = request('userId');

        //On a validé l'envoi des données, on a au moins un choix et l'id

        $sellerModerate = Seller::where('id', $sellerId);

        $avatarSellers = request('avatarSellers');

            foreach ($avatarSellers as $key => $avatarSeller) {

                // Tentative de suppression des photos à la mise à jour, a refaire !
                // Storage::delete('avatar' . $avatarSeller . '_path', 'public');

                $sellerModerate->update([

                    'avatar' . $avatarSeller . '_path' => 'sellersAvatar/avatarSellerDefault.jpg',
                    
                ]);
            }

        flash('Les photos sont modérées')->success();

        return back();
    }

    /**
     * Supprime le vendeur et l'acheteur correspondant
     *
     * @return void
     */
    public function deleteSeller()
    {
        request()->validate([
            'seller_id' => ['required'],
        ]);
        
        $seller = Seller::where('id', request('seller_id'))->first();

        // Suppression des images uploadés par le vendeur
        // Non fonctionnel, a retravaillé !
        /*
            $defaut = 'sellersAvatar/avatarSellerDefault.jpg';

            if($seller->avatar1_path !== $defaut){

                Storage::delete($seller->avatar1_path);
            }

            if($seller->avatar2_path !== $defaut){

                Storage::delete($seller->avatar2_path);
            }

            if($seller->avatar3_path !== $defaut){

                Storage::delete($seller->avatar3_path);
            }
        */
        
        $seller->user()->delete();

        $seller->delete();

        return back();
    }
}
