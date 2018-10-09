<hr class="my-4">
<h2>Votre point de vente : <strong>{{ $user->seller->business_name }}</strong></h2>
<p>Votre présentation : 
    
    @if(($user->seller->presentation))

    {{ $user->seller->presentation }}

    @else

    Non-défini.

    @endif

</p>
<p>Votre téléphone : 
    
    @if(($user->seller->phone))

    {{ $user->seller->phone }}

    @else

    Non-défini.

    @endif

</p>
<p>Votre adresse : 
    
    @if(($user->seller->address))

    {{ $user->seller->address }}

    @else

    Non-défini.

    @endif

</p>
<div><p>Vos photos :</p>
    
    <p>Photo principale :
        @if(($user->seller->avatar1_path))

        <br/><br/><img src="/storage/{{ $user->seller->avatar1_path }}" alt="photo de point de vente" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
    <p>Photo secondaire n°1 :
        @if(($user->seller->avatar2_path))

        <br/><img src="/storage/{{ $user->seller->avatar2_path }}" alt="photo de point de vente 2" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
    <p>Photo secondaire n°2 :
        @if(($user->seller->avatar3_path))

        <br/><img src="/storage/{{ $user->seller->avatar3_path }}" alt="photo de point de vente 3" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
</div>
<p>
    <button class="btn btn-primary btn-lg mb-3" data-toggle="modal" data-target='#updateSellerModal'>Modifier les informations<span class="d-inline d-sm-none"><br></span> de votre point de vente</button>
    <br/>
    <button class="btn btn-secondary text-dark btn-sm" data-toggle="modal" data-target='#deleteMyShopModal'>Supprimer <span class="d-inline d-sm-none"><br></span>mon point de vente </button>
</p>


@include('partials.modals.updateSellerModal')

@include('partials.modals.deleteMyShopModal')