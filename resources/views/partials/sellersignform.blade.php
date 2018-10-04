<p class="container"><button class="btn btn-dark btn-block btn-lg my-5" type="button" data-toggle="collapse" data-target="#sellercollapse" aria-expanded="false" aria-controls="collapseExample">Vendeur ?</button></p>

<form action="/inscriptionVendeur" method="post" class="container mb-5 collapse" enctype="multipart/form-data" id="sellercollapse"><!-- Formulaire pour les vendeurs -->

    @csrf

    <fieldset>
        
        @include('partials/usersignform')

        <div class="form-group"><!-- Nom de la structure -->

            <label class="col-form-label" for="inputBusinessName">Le nom de votre structure <span style="color:red">*</span></label>
            <input class="form-control" placeholder="Les volailles de Roseline..." id="inputBusinessName" type="text" name="businessName" required>
            <small id="businessNameHelp" class="form-text text-muted">Minimum 6 caractères.</small>

            @if ($errors->has('businessName'))
                <p class="form-text text-danger"> {{ $errors->first('businessName') }}</p>
            @endif

        </div>

        <div class="form-group"><!-- Téléphone -->

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">Téléphone <sup style="color:red">*</sup>:</span>
                </div>
                <input class="form-control" type="tel" name="phone" required>
            </div>

            @if ($errors->has('phone'))
                <p class="form-text text-danger"> {{ $errors->first('phone') }}</p>
            @endif

        </div>

        <div class="form-group"><!-- Adresse -->

            <label>Adresse <span style="color:red">*</span></label>
            <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
            <small id="addressHelp" class="form-text text-muted">L'adresse complète de votre point de vente. Minimum 6 caractères.</small>

            @if ($errors->has('address'))
                <p class="form-text text-danger"> {{ $errors->first('address') }}</p>
            @endif

        </div>

        <div class="form-group row"><!-- Sélection des catégories -->

            <label aria-describedby="categoriesHelp" class="col-12">Vos catégories de produits <span style="color:red">*</span><small id="categoriesHelp" class="form-text text-muted">Vous pouvez sélectionner plusieurs catégories et vous devez en sélectionner au moins une.</small></label>

            <div class="custom-control custom-checkbox col-10 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category1" type="checkbox" name="product_category[]" value="1">
                <label class="custom-control-label" for="product_category1">Fruits & Légumes</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category2" type="checkbox" name="product_category[]" value="2">
                <label class="custom-control-label" for="product_category2">Volailles</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category3" type="checkbox" name="product_category[]" value="3">
                <label class="custom-control-label" for="product_category3">Oeufs</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category4" type="checkbox" name="product_category[]" value="4">
                <label class="custom-control-label" for="product_category4">Laits & Fromages</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category5" type="checkbox" name="product_category[]" value="5">
                <label class="custom-control-label" for="product_category5">Charcuterie</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category6" type="checkbox" name="product_category[]" value="6">
                <label class="custom-control-label" for="product_category6">Boucherie</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category7" type="checkbox" name="product_category[]" value="7">
                <label class="custom-control-label" for="product_category7">Textiles</label>
            </div>

            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3 offset-2 offset-sm-0">
                <input class="custom-control-input" id="product_category8" type="checkbox" name="product_category[]" value="8">
                <label class="custom-control-label" for="product_category8">Autres</label>
            </div>

            @if ($errors->has('product_category'))
                <p class="form-text text-danger"> {{ $errors->first('product_category') }}</p>
            @endif

        </div>

        <div class="form-group row"><!-- Récupération de la position GPS du point de vente -->

            <label aria-describedby="gpsHelp" class="col-12">Vos coordonnées GPS (obligatoire) <span style="color:red">*</span><small id="gpsHelp" class="form-text text-muted">Indiquez les coordonnées GPS de votre point de vente, ou de l'entrée de votre propriété sur la voie publique</small></label>

            <div class="form-group container">

                <input class="form-control mb-1" id="longInput" name="long" placeholder="Longitude ex : 49.3154287" type="text" required>

                @if ($errors->has('long'))
                    <p class="form-text text-danger"> {{ $errors->first('long') }}</p>
                @endif

                <input class="form-control mb-1" id="latInput" name="lat" placeholder="Latitude ex : -0.875458754" type="text" required>

                @if ($errors->has('lat'))
                    <p class="form-text text-danger"> {{ $errors->first('lat') }}</p>
                @endif

                <button type="button" id="getCoordonates" class="btn btn-primary container">Récupérer automatiquement<span class="d-inline d-sm-none"><br></span> ses coordonnées</button>  

            </div>

        </div>

        <div class="form-group"><!-- Présentation de la structure -->

            <label>Présentation de votre production <span style="color:red">*</span><small class="form-text text-muted">Décrivez briévement les produits que vous souhaitez vendre.</small></label>

            <textarea class="form-control" id="teaserSeller" rows="3" name="teaserSeller" required></textarea>

            @if ($errors->has('teaserSeller'))
                <p class="form-text text-danger"> {{ $errors->first('teaserSeller') }}</p>
            @endif

        </div>

        <div class="form-group"><!-- Photos -->

            <label>Ajoutez quelques photos pour présenter votre structure et vos produits.</label>

            <div  class="custom-file">

                <input class="custom-file-input" id="InputFile1" type="file" aria-describedby="fileHelp" name="avatar">

                <label class="custom-file-label" for="InputFile1">Photo principale : <span style="color:red">*</span></label>

                <small id="fileHelp" class="form-text text-muted">Ajouter une photo qui représente votre structure ou l'entrée de votre point de vente pour aider vos visiteurs.</small>

                @if ($errors->has('avatar'))
                    <p class="form-text text-danger"> {{ $errors->first('avatar') }}</p>
                @endif

            </div>

            <div  class="custom-file mt-2 mb-1">

                <input class="custom-file-input" id="InputFile2" type="file" aria-describedby="fileHelp" name="avatar1">

                <label class="custom-file-label" for="InputFile2">Photo alternative 1 :</label>

                @if ($errors->has('avatar1'))
                    <p class="form-text text-danger"> {{ $errors->first('avatar1') }}</p>
                @endif

            </div>

            <div class="custom-file mb-1">

                <input class="custom-file-input" id="InputFile3" type="file" aria-describedby="fileHelp" name="avatar2">

                <label class="custom-file-label" for="InputFile3">Photo alternative 2 :</label>

                @if ($errors->has('avatar2'))
                    <p class="form-text text-danger"> {{ $errors->first('avatar2') }}</p>
                @endif

            </div>

            <small id="fileHelp" class="form-text text-muted">Ajouter des photos de vos produits.</small>
        </div>
            
        <small class="form-text text-muted"><span style="color:red">*</span> : Champs requis.</small><br/>

        <div class="form-group alert alert-danger"><!-- checkbox de confirmation de vente -->

            <div class="custom-control custom-checkbox">

                <input class="custom-control-input" id="seller_confirmation" type="checkbox" name="seller_confirmation">

                <label class="custom-control-label" for="seller_confirmation">Je confirme être un vendeur</label>

            </div>

        </div>

        <div class="alert alert-warning text-center">Attention si <strong class="text-danger">"Je confirme être un vendeur"</strong> n'est pas cochée vos informations de vendeur ne seront pas enregistrées et vous serez ne serez pas inscrit.</div>
            
        <button type="submit" class="btn btn-dark btn-lg btn-block">M'inscrire en <span class="d-inline d-sm-none"><br></span>tant que vendeur</button>
        
    </fieldset>
    
</form>