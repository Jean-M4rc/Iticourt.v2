@extends('layout')

@section('contenu')

<div class="jumbotron text-center">

    <h1>{{ $seller->business_name }}</h1>
    <p class="lead">Vous pouvez consulter mes informations ici et commenter mes produits.</p>
    <hr class="my-4">
    <p>Me contacter  : {{$seller->phone}}</p>
    <p>Mes categories de produits  : 
        @foreach ($seller->categories as $category)
            {{$category->name}} 
        @endforeach
    </p>
    <p>Mon adresse : {{$seller->address}}</p>
    <div class="row mb-4">
        <p class="col-12 text-center">Les photos de mes produits :</p>
        
        <div class="row">

            @if(!$seller->avatar2_path && !$seller->avatar3_path)

                <img class="col-12 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2" src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>

            @elseif(!$seller->avatar2_path)

                <img class="col-12 col-md-6 col-lg-5 offset-lg-1 mb-2"  src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
                <img class="col-12 col-md-6 col-lg-5" src="/storage/{{ $seller->avatar3_path }}" alt="Troisième photo de produit"/>

           
            @elseif(!$seller->avatar3_path)

                <img class="col-12 col-md-6 col-lg-5 offset-lg-1 mb-2"  src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
                <img class="col-12 col-md-6 col-lg-5" src="/storage/{{ $seller->avatar2_path }}" alt="Deuxième photo de produit"/>

            @else
                <img class="col-12 col-md-4 mb-2" src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
                <img class="col-12 col-md-4 mb-2" src="/storage/{{ $seller->avatar2_path }}" alt="Deuxième photo de produit"/>
                <img class="col-12 col-md-4" src="/storage/{{ $seller->avatar3_path }}" alt="Troisième photo de produit"/>
            @endif
                

        </div>
    </div>

    @auth

    <div class="my-3 col-lg-6 offset-lg-3">
        <form class="flex-center" method="post" action="/comments">
            @csrf
            <fieldset style="width:100%">
                <div class="form-group">
                    <h4>Laissez un commentaire !</h4>
                    <label class="text-dark" for="titleComment">Titre de votre commentaire :</label>
                    <input class="form-control" id="titleComment" type="text" name="title"><br>
                    <input type="hidden" name="user" value="{{auth()->user()->id}}">
                    <input type="hidden" name="seller" value="{{$seller->id}}">
                    <label class="text-dark text-center" for="TextareaSeller">Votre commentaire :</label>
                    <textarea class="form-control" id="TextareaSeller" rows="3" name="content"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Commenter</button>
            </fieldset>
        </form>
    </div> 

    @endauth
    
    @if(auth()->guest())
        <div class="alert alert-info text-center"> Vous devez être connecté pour commenter !</div>
    @endif

    <ul class="list-unstyled col-lg-6 offset-lg-3">

    @foreach($comments as $comment)

        <li class="media my-3 py-2 border border-primary rounded w-auto">
            @if ($comment->user->avatar_path)
                <img class="flex-end ml-2" src="/storage/{{ $comment->user->avatar_path}}" width="100px" height="100px" alt="Photo de profil">
            
            @else
                <img class="flex-end ml-2" src="" width="100px" height="100px" alt="Photo de profil absente">
            @endif
            
            <div class="media-body col-8 flex-start text-left">
                <h4 class="my-0">{{$comment->title}}</h4>
                <small class="text-muted mt-0"> envoyé par {{$comment->user->nickname}} le : {{$comment->created_at->format('d/m/Y à H:i:s')}}</small>
                <p class="text-justify">{{$comment->content}}</p>
            </div>
        </li>

    @endforeach

    </ul>
</div>


@endsection