<div class="modal fade" id="modalDeleteSeller{{ $pdv->id }}" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/deleteSeller" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{ $pdv->business_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-danger">Etes-vous sûr de vouloir supprimer ce point de vente ?</p>
                    <p>Nom de l'utilisateur : {{ $pdv->user->nickname }}</p>
                    <p>Catégories des produits :
                        @foreach ($pdv->categories as $seller_category)
                            {{ $seller_category->name }}
                        @endforeach
                    </p>
                    <p>Crée le : {{ $pdv->created_at->format('d/m/Y à H:i:s') }}</p>
                    <p>Nombre de commentaire : {{ count($pdv->comments) }}</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="seller_id" value="{{ $pdv->id }}">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-dark">Supprimer<span class="d-none d-sm-inline"> ce point de vente</span></button>
                </div>
            </form>
        </div>
    </div>
</div>