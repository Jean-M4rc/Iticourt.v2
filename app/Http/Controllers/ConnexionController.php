<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends Controller
{

    /**
     * Traitement du formulaire de connexion
     *
     * @return void
     */
    public function traitement()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        // Méthode non fonctionnelle, le cookie est toujours actif

        $remember = request('remember_me');

        $resultat = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
            'ban' => 0,
        ], $remember);

        if ($resultat) {

            flash("Vous êtes bien connecté.")->success();

            return back();

        } else {

            flash()->overlay('Echec de la connexion !', 'Attention')->error();

            return back();
        }
    }
}
