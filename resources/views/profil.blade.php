@extends('layout')

@section('contenu')

<div class="jumbotron text-center">
    <h1>Bienvenue sur votre profil <strong>{{ $user->nickname }}</strong></h1>
    <p class="lead">Vous pouvez consulter vos informations ici et modifier votre compte.</p>
    <hr class="my-4">
    <p>Votre nom : 
        
        @if(($user->firstname))

        {{ $user->firstname }}

        @else

        Non-défini.

        @endif

    </p>
    <p>Votre email : 
        
        @if(($user->email))

        {{ $user->email }}

        @else

        Non-défini.

        @endif

    </p>
    <p>Votre photo de profil : 
        
        @if(($user->avatar_path))

        <br><img src="/storage/{{ $user->avatar_path }}" alt="photo de profil" style="width:200px"/>

        @else

        Non-défini.

        @endif

    </p>
    <p class="lead">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target='#updateUserModal'>Modifier mes infos<span class="d-inline d-sm-none"><br></span> d'utilisateur</button>
    </p>
    <p class="lead">
        <button type="button" class="btn btn-secondary btn-sm text-dark" data-toggle="modal" data-target='#modalDeleteUserAccount'>Supprimer mon compte.<br/>
            @if ($user->seller)
                Supprimer aussi <span class="d-inline d-sm-none"><br></span>mon point de vente.
            @endif
        </button>
    </p>
    @if ($user->seller)
        @include('partials.profilseller')
    @endif
</div>

@include('partials.modals.updateUserModal')

@include('partials.modals.modalDeleteAccount')
    
@endsection