<p class="container"><button class="btn btn-primary btn-block btn-lg my-5" type="button" data-toggle="collapse" data-target="#buyercollapse" aria-expanded="false" aria-controls="collapseExample">Acheteur ?</button></p>

<form action="/inscriptionAcheteur" method="post" class="container mb-5 collapse" id="buyercollapse"><!-- Formulaire Acheteur -->

    @csrf

    <fieldset>

        @include('partials/usersignform')

        <small class="form-text text-muted"><span style="color:red">*</span> : Champs requis.</small><br/>

        <button type="submit" class="btn btn-primary btn-lg btn-block">M'inscrire en tant qu'acheteur</button>

    </fieldset>

</form>