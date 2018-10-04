<div class="modal fade" id="modalComment{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Gestion d'un commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-primary">Titre : {{ $comment->title }}</p>
                <p class="text-dark">Message : {{ $comment->content }}</p>
                <p class="text-primary">Auteur : {{ $comment->user->nickname }}</p>
                <p class="text-dark">Point de vente commenté : {{ $comment->seller->business_name }}</p>
                <p class="text-primary">Crée le : {{ $comment->created_at->format('d/m/Y à H:i:s') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                <div>
                    <form action="/moderateComment" method="post">
                        @csrf
                        <fieldset>
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <p class="text-dark">Message : {{ $comment->content }}</p>
                            <button type="submit" class="btn btn-primary">Modérer</button>
                        </fieldset>
                        
                    </form>
                </div>
                <div>
                    <form action="/deleteComment" method="POST">
                        @csrf       
                        <button type="submit" class="btn btn-dark">Supprimer</button>
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>