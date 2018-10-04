<div class="modal fade {{ $modalClass or '' }}" id="flash-overlay-modal" tabindex="-1" role="dialog" aria-labelledby="flashModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenterTitle">{{ $title }}</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal" data-toggle="modal" data-target='#logInModal'>Annuler</button>
            </div>
        </div>
    </div>
</div>
    
