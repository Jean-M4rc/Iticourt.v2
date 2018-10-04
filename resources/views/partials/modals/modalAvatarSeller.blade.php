<div class="modal fade " id="modalAvatarSeller{{ $pdv->id }}" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        
        <div class="modal-content ">
            <form action="/resetSellerAvatar" method="post">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

        
                <div class="modal-body">
                    <!-- photo principale -->
                    <div class="media flex-column align-items-center">
                        <h5 class="mt-0">Photo principale</h5>
                        <img width="100%" class="m-1" src="/storage/{{ $pdv->avatar1_path }}" alt="Photo de {{ $pdv->business_name }}">
                        <div class="media-body control checkbox mt-1 p-2 bg-secondary ">
                            <label class="control-label" for="avatar1"><input class="control-input" id="avatar1" type="checkbox" name="avatarSellers[]" value="1"> Sélectionner l'image pour la réinitialiser.</label>
                        </div>
                    </div>

                    @if ($pdv->avatar2_path)
                        <!-- photo secondaire 1 -->
                        <div class="media flex-column align-items-center">
                            <h5 class="mt-0">Photo secondaire 1</h5>
                            <img width="100%" class="m-1" src="/storage/{{ $pdv->avatar2_path }}" alt="Photo secondaire de {{ $pdv->business_name }}">
                            <div class="media-body control checkbox mt-1 p-2 bg-secondary ">
                                <label class="control-label" for="avatar2"><input class="control-input" id="avatar2" type="checkbox" name="avatarSellers[]" value="2"> Sélectionner l'image pour la réinitialiser.</label>
                            </div>
                        </div>

                    @endif
                    
                    @if($pdv->avatar3_path)
                        <!-- photo secondaire 2 -->
                        <div class="media flex-column align-items-center">
                            <h5 class="mt-0">Photo secondaire 2</h5>
                            <img width="100%" class="m-1" src="/storage/{{ $pdv->avatar3_path }}" alt="Photo de secondaire de {{ $pdv->business_name }}">
                            <div class="media-body control checkbox mt-1 p-2 bg-secondary ">
                                <label class="control-label" for="avatar3"><input class="control-input" id="avatar3" type="checkbox" name="avatarSellers[]" value="3"> Sélectionner l'image pour la réinitialiser.</label>
                            </div>
                        </div>
                    @endif
                    
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input type="hidden" name="userId" value="{{ $pdv->id }}">
                    <button type="submit" class="btn btn-dark">Réinitialiser<span class="d-none d-sm-inline"> les photos sélectionnées</span></button>            
                </div>
            </form>   
        </div>
    </div>
</div>