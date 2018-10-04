<hr class="my-4">
<h2>Votre point de vente : <strong>{{ auth()->user()->seller->business_name }}</strong></h2>
<p>Votre présentation : 
    
    @if((auth()->user()->seller->presentation))

    {{ auth()->user()->seller->presentation }}

    @else

    Non-défini.

    @endif

</p>
<p>Votre téléphone : 
    
    @if((auth()->user()->seller->phone))

    {{ auth()->user()->seller->phone }}

    @else

    Non-défini.

    @endif

</p>
<p>Votre adresse : 
    
    @if((auth()->user()->seller->address))

    {{ auth()->user()->seller->address }}

    @else

    Non-défini.

    @endif

</p>
<div><p>Vos photos :</p>
    
    <p>Photo principale :
        @if((auth()->user()->seller->avatar1_path))

        <br/><img src="/storage/{{ auth()->user()->seller->avatar1_path }}" alt="photo de point de vente" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
    <p>Photo secondaire n°1 :
        @if((auth()->user()->seller->avatar2_path))

        <br/><img src="/storage/{{ auth()->user()->seller->avatar2_path }}" alt="photo de point de vente 2" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
    <p>Photo secondaire n°2 :
        @if((auth()->user()->seller->avatar3_path))

        <br/><img src="/storage/{{ auth()->user()->seller->avatar3_path }}" alt="photo de point de vente 3" style="width:280px"/>

        @else

        Non-défini.

        @endif
    </p>
</div>
<button class="btn btn-dark btn-lg" data-toggle="modal" data-target='#updateSellerModal'>Modifier les informations<span class="d-inline d-sm-none"><br></span> de votre point de vente</button>

@include('partials.modals.updateSellerModal')