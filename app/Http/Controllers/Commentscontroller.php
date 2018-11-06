<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store()
    {
        request()->validate([

            'title' => ['required', 'min:4'],
            'content' => ['required', 'min:5'],
            'user' => ['required', 'integer'],
            'seller' => ['required', 'integer'],

        ]);

        $comment = Comment::create([
            'content' => request('content'),
            'title' => request('title'),
            'seller_id' => request('seller'),
            'user_id' => request('user'),
        ]);

        flash('Votre commentaire est ajouté')->success();

        return back();
    }

    public function moderateComment()
    {
        // Modération
        return back();
    }

    public function deleteComment()
    {
        // Suppression d'un commentaire
        return back();
    }

}
