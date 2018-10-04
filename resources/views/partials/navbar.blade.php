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

            <!-- logInModal -->
            <div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="LogInModalCenter" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
            
                    <div class="modal-content">
            
                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalCenterTitle">Connexion</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
            
                        <form method="post" action='/connexion'>
            
                            @csrf
            
                            <fieldset>
                                <div class="modal-body">
            
                                    <!-- Le mail -->
                                    <div class="form-group">
                                        <label for="email" class="control-label">Adresse mail : </label>
                                        <input id="email" class="form-control" name="email" type="email" required />
            
                                        @if ($errors->has('email'))
                                            <p class="form-text text-danger"> {{ $errors->first('email') }}</p>
                                        @endif
            
                                    </div>                       
            
                                    <!-- le mot de passe -->
                                    <div class="form-group">
                                        <label class="control-label">Mot de passe : </label>
                                        <input class="form-control" name="password" placeholder="Mot de passe" type="password" required>
                                        <small id="passwordHelp" class="form-text text-muted">Minimum 6 caractères.</small>
            
                                        @if ($errors->has('password'))
                                            <p class="form-text text-danger"> {{ $errors->first('password') }}</p>
                                        @endif
            
                                    </div>
            
                                    <!-- cookiebox -->
                                    
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="customCheck1" name="remember" value="true" type="checkbox">
                                                    <label class="custom-control-label" for="customCheck1">Se souvenir de moi.</label>
                                            </div>
                                        </div>
            
                                    <!-- signInInfo -->
                                    <div class="alert alert-info">
                                        <p>Si vous n'êtes pas encore inscrit sur Iticourt, <a class="link" href="/inscription">"Je m'inscris !"</a></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                                    <input class="btn btn-primary" id="submit" type="submit" value="Connexion">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End logInModal -->
            
        @endauth
            
    </div>
</nav>

