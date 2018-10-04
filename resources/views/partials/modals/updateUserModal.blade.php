<!-- updateUserModal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenterTitle">Modifier vos informations</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action='/updateUser' enctype="multipart/form-data">

                @csrf

                <fieldset>
                    <div class="modal-body">

                        <!-- Le pseudo nickname name:nickname-->
                        <div class="form-group">
                            <label for="nickname" class="control-label">Votre pseudo / prénom :</label>
                            <input id="nickname" class="form-control" name="nickname" type="text" placeholder="{{ auth()->user()->nickname }}" />
    
                            @if ($errors->has('nickname'))
                                <p class="form-text text-danger"> {{ $errors->first('nickname') }}</p>
                            @endif
                        </div> 

                        <!-- Le firstname name:firstname -->
                        <div class="form-group">
                            <label for="firstname" class="control-label">Votre nom :</label>
                            <input id="firstname" class="form-control" name="firstname" type="text" placeholder="{{ auth()->user()->firstname }}" />
    
                            @if ($errors->has('firstname'))
                                <p class="form-text text-danger"> {{ $errors->first('firstname') }}</p>
                            @endif
                        </div> 

                        <!-- Le mail name:email-->
                        <div class="form-group">
                            <label for="email" class="control-label">Adresse mail : </label>
                            <input id="email" class="form-control" name="email" type="email" placeholder="{{ auth()->user()->email }}" />

                            @if ($errors->has('email'))
                                <p class="form-text text-danger"> {{ $errors->first('email') }}</p>
                            @endif

                        </div>
                        
                        <!-- le nouveau mot de passe name:newPassword -->
                        <div class="form-group">
                            <label class="control-label">Nouveau mot de passe : </label>
                            <input id="mdp2" class="form-control" name="newPassword" type="password"/>

                            @if ($errors->has('newPassword'))
                                <p class="form-text text-danger"> {{ $errors->first('newPassword') }}</p>
                            @endif

                        </div>

                        <!-- confirmation du nouveau mot de passe name:newPassword_confirmation-->
                        <div class="form-group">
                            <label class="control-label">Confirmer le nouveau mot de passe : </label>
                            <input id="mdp3" class="form-control" name="newPassword_confirmation" type="password"/>

                            @if ($errors->has('newPassword_confirmation'))
                                <p class="form-text text-danger"> {{ $errors->first('newPassword_confirmation') }}</p>
                            @endif

                        </div>

                        <!-- la photo de profil name:avatarProfil-->
                        <div  class="custom-file">

                            <input class="custom-file-input" id="InputFileAvatar" type="file" aria-describedby="fileHelp" name="avatarProfil">
            
                            <label class="custom-file-label" for="InputFileAvatar">Ajouter ou modifier votre photo de profil :</label>
            
                            @if ($errors->has('avatarProfil'))
                                <p class="form-text text-danger"> {{ $errors->first('avatarProfil') }}</p>
                            @endif
            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                        <input class="btn btn-primary" id="submit" type="submit" value="Envoyer">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- End updateUserModal -->