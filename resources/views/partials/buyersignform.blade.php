<form action="/inscriptionAcheteur" method="post" class="container mb-5" id="buyercollapse"><!-- Formulaire Acheteur -->

    @csrf

    <fieldset>

        @include('partials/usersignform')

        <small class="form-text text-muted"><span style="color:red">*</span> : Champs requis.</small><br/>

        <button type="submit" class="btn btn-primary btn-lg btn-block">M'inscrire en tant qu'acheteur</button>

    </fieldset>

</form>