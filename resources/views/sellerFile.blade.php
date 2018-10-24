@extends('layout')

@section('contenu')

<div id="sellerFile" class="jumbotron text-center">

    <h1>{{ $seller->business_name }}</h1>
    <p class="lead">Vous pouvez consulter mes informations ici et commenter mes produits.</p>
    <hr class="my-4">
    <p>Me contacter  : {{$seller->phone}}</p>
    <p>Mes catégories de produits  :<br/> 
        @foreach ($seller->categories as $category)
            {{$category->name}}<br/> 
        @endforeach
    </p><br/>
    <p>Mon adresse :<br/>{{$seller->address}}</p>
    <br/>
    <p>
        <a href="#closeSellerMap"><button id="btnrouting" class="btn btn-lg btn-primary">
            <span class="h3 text-dark font-weight-bold p-3">Me rejoindre !</span>
            <br/>
            <small>Conçu pour les mobiles</small>
        </button></a>
    </p>
    <div class="row mb-4">
        <p class="col-12 text-center">Les photos de mes produits :</p>

        @if(!$seller->avatar2_path && !$seller->avatar3_path)

            <img class="col-12 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2 imgsellerfile" src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>

        @elseif(!$seller->avatar2_path)

            <img class="col-12 col-md-6 col-lg-5 offset-lg-1 imgsellerfile"  src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
            <span class="d-md-none my-1"><br/></span>
            <img class="col-12 col-md-6 col-lg-5 imgsellerfile" src="/storage/{{ $seller->avatar3_path }}" alt="Troisième photo de produit"/>

        
        @elseif(!$seller->avatar3_path)

            <img class="col-12 col-md-6 col-lg-5 offset-lg-1 imgsellerfile"  src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
            <span class="d-md-none my-1"><br/></span>
            <img class="col-12 col-md-6 col-lg-5 imgsellerfile" src="/storage/{{ $seller->avatar2_path }}" alt="Deuxième photo de produit"/>

        @else
            <img class="col-12 col-md-4 imgsellerfile" src="/storage/{{ $seller->avatar1_path }}" alt="Première photo de produit"/>
            <span class="d-md-none my-1"><br/></span>
            <img class="col-12 col-md-4 imgsellerfile" src="/storage/{{ $seller->avatar2_path }}" alt="Deuxième photo de produit"/>
            <span class="d-md-none my-1"><br/></span>
            <img class="col-12 col-md-4 imgsellerfile" src="/storage/{{ $seller->avatar3_path }}" alt="Troisième photo de produit"/>
        @endif
            
    </div>

    @auth

    <div class="my-3 col-lg-6 offset-lg-3">
        <form class="flex-center" method="post" action="/comments">
            @csrf
            <fieldset style="width:100%">
                <div class="form-group">
                    <h4>Laissez un commentaire !</h4>
                    <label class="text-dark" for="titleComment">Titre de votre commentaire :</label>
                    <input class="form-control" id="titleComment" type="text" name="title">
                    @if ($errors->has('title'))
                        <p class="form-text text-danger"> {{ $errors->first('title') }}</p>
                    @endif
                    <br><input type="hidden" name="user" value="{{auth()->user()->id}}">
                    <input type="hidden" name="seller" value="{{$seller->id}}">
                    <label class="text-dark text-center" for="TextareaSeller">Votre commentaire :</label>
                    <textarea class="form-control" id="TextareaSeller" rows="3" name="content"></textarea>
                    @if ($errors->has('content'))
                        <p class="form-text text-danger"> {{ $errors->first('content') }}</p>
                    @endif
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
<div id="loader2" style="display:none">
    <img src="/storage/loader/ajax-loader.gif"/>
    <p class="lead text-primary bold">Veuillez patientez</p>
</div>

<div id="mapBoxRouting" class="container my-0 col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2"  data="{{$seller->latitude}},{{$seller->longitude}}" >
        
</div>


@endsection