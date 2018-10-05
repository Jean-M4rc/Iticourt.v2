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
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember_me"/>
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