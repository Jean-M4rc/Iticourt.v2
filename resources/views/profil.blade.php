@extends('layout')

@section('contenu')

<div class="jumbotron text-center">
    <h1>Bienvenue sur votre profil <strong>{{ auth()->user()->nickname }}</strong></h1>
    <p class="lead">Vous pouvez consulter vos informations ici et modifier votre compte.</p>
    <hr class="my-4">
    <p>Votre nom : 
        
        @if((auth()->user()->firstname))

        {{ auth()->user()->firstname }}

        @else

        Non-défini.

        @endif

    </p>
    <p>Votre email : 
        
        @if((auth()->user()->email))

        {{ auth()->user()->email }}

        @else

        Non-défini.

        @endif

    </p>
    <p>Votre photo de profil : 
        
        @if((auth()->user()->avatar_path))

        <br><img src="/storage/{{ auth()->user()->avatar_path }}" alt="photo de profil" style="width:200px"/>

        @else

        Non-défini.

        @endif

    </p>
    <p class="lead">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target='#updateUserModal'>Modifier mes infos<span class="d-inline d-sm-none"><br></span> d'utilisateur</button>
    </p>
    @if (auth()->user()->seller)
        @include('partials.profilseller')
    @endif
</div>

@include('partials.modals.updateUserModal')
    
@endsection