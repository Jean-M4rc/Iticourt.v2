<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function accueil()
    {
        return view('profil');
    }

    public function deconnexion()
    {
        auth()->logout();

        flash("Vous êtes bien déconnecté. A bientôt !")->success();

        return redirect('/');
    }
    
}
