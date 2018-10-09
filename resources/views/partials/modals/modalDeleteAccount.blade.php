<div class="modal fade" id="modalDeleteUserAccount" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/deleteMyAccount" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Attention !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-danger text-center">
                        <strong>Etes-vous sûr de vouloir supprimer votre compte 
                            @if ($user->seller)
                                <span class="d-inline d-sm-none"><br></span> et votre point de vente.
                            @endif
                        ?</strong>
                        <br/>
                        Cette action est irréversible. Toutes vos données seront effacées.
                    </p>
                    <p>Nom de l'utilisateur : {{ $user->nickname }}</p>
                    <p>Crée le : {{ $user->created_at->format('d/m/Y à H:i:s') }}</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-dark">Supprimer<span class="d-none d-sm-inline"> mon compte</span></button>
                </div>
            </form>
        </div>
    </div>
</div>