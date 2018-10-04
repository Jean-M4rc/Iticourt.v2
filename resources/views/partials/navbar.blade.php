<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{ env('APP_URL') }}">Iticourt</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarColor01">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">A propos</a>
            </li>
        
            <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/sellersList">Nos vendeurs</a>
            </li>

        </ul>

        @auth <!-- l'utilisateur est connecté -->

            <div class="btngroup">

            @if(auth()->user()->admin==1)

                <a href="/rootme" class="btn btn-dark {{ request()->is('rootme') ? 'active' : '' }}">Administration</a>
                        
            @endif

                <!-- L'inscription renvoie vers une autre page -->
                <a href="/profil"><button class="btn btn-primary {{ request()->is('profil') ? 'active' : '' }}">Mon compte</button></a>
            
                <!-- bouton qui déclenche la modal de connexion -->
                <a href="/deconnexion"><button class="btn btn-primary">Déconnexion</button></a>
            </div>

            

        @else

            <div class="btngroup">
                <!-- L'inscription renvoie vers une autre page -->
                <a href="/inscription"><button class="btn btn-primary {{ request()->is('inscription') ? 'active' : '' }}">Inscription</button></a>
            
                <!-- bouton qui déclenche la modal de connexion -->
                <button class="btn btn-primary" data-toggle="modal" data-target='#logInModal'>Connexion</button>
            </div>

            
            
        @endauth
            
    </div>

    @include('partials/modals/logInModal')

</nav>

