<!-- updateSellerModal -->
<div class="modal fade" id="updateSellerModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenterTitle">Connexion</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action='/updateSeller' enctype="multipart/form-data">

                @csrf

                <fieldset>

                    <div class="modal-body">

                        <!-- Le nom de la structure :business_name -->
                        <div class="form-group">
                            <label for="business_name" class="control-label">Le nom de votre structure : </label>
                            <input id="business_name" class="form-control" name="business_name" type="text" placeholder="{{ auth()->user()->seller->business_name }}"/>

                            @if ($errors->has('business_name'))
                                <p class="form-text text-danger"> {{ $errors->first('business_name') }}</p>
                            @endif

                        </div>                       

                        <!-- la présentation :teaserSeller -->
                        <div class="form-group">
                            <label class="control-label">La présentation de votre structure : </label>
                            <textarea class="form-control" id="teaserSeller" rows="3" name="teaserSeller" placeholder="{{ auth()->user()->seller->presentation }}"></textarea>

                            @if ($errors->has('teaserSeller'))
                                <p class="form-text text-danger"> {{ $errors->first('teaserSeller') }}</p>
                            @endif

                        </div>

                        <!-- Le téléphone :phone -->
                        <div class="form-group">
                            <label for="phone" class="control-label">Téléphone :</label>
                            <input id="phone" class="form-control" name="phone" type="tel" placeholder="{{ auth()->user()->seller->phone }}" />
    
                            @if ($errors->has('phone'))
                                <p class="form-text text-danger"> {{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                        
                        <!-- l'adresse :address -->
                        <div class="form-group">
                            <label class="control-label">L'adresse de votre point de vente : </label>
                            <textarea class="form-control" id="address" rows="3" name="address" placeholder="{{ auth()->user()->seller->address }}"></textarea>

                            @if ($errors->has('address'))
                                <p class="form-text text-danger"> {{ $errors->first('address') }}</p>
                            @endif

                        </div>

                        <!-- Sélection des catégories :product_category[] -->
                        <div class="form-group row mx-2">

                            <label aria-describedby="categoriesHelp" class="col-12">Vos catégories de produits</label>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category1" type="checkbox" name="product_category[]" value="1" {{ auth()->user()->seller->categories->find('1') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category1">Fruits & Légumes</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category2" type="checkbox" name="product_category[]" value="2" {{ auth()->user()->seller->categories->find('2') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category2">Volailles</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category3" type="checkbox" name="product_category[]" value="3" {{ auth()->user()->seller->categories->find('3') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category3">Oeufs</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category4" type="checkbox" name="product_category[]" value="4" {{ auth()->user()->seller->categories->find('4') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category4">Laits & Fromages</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category5" type="checkbox" name="product_category[]" value="5" {{ auth()->user()->seller->categories->find('5') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category5">Charcuterie</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category6" type="checkbox" name="product_category[]" value="6" {{ auth()->user()->seller->categories->find('6') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category6">Boucherie</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category7" type="checkbox" name="product_category[]" value="7" {{ auth()->user()->seller->categories->find('7') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category7">Textiles</label>
                            </div>
                
                            <div class="custom-control custom-checkbox col-12 col-sm-6 col-md-3">
                                <input class="custom-control-input" id="product_category8" type="checkbox" name="product_category[]" value="8" {{ auth()->user()->seller->categories->find('8') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="product_category8">Autres</label>
                            </div>
                
                            @if ($errors->has('product_category'))
                                <p class="form-text text-danger"> {{ $errors->first('product_category') }}</p>
                            @endif
                
                        </div>

                        <!-- Les coordonnées GPS :long :lat -->
                        <div class="form-group container">

                            <input class="form-control mb-1" id="longInput" name="long" placeholder="Longitude : {{ auth()->user()->seller->longitude }}" type="text">
            
                            @if ($errors->has('long'))
                                <p class="form-text text-danger"> {{ $errors->first('long') }}</p>
                            @endif
            
                            <input class="form-control mb-1" id="latInput" name="lat" placeholder="Latitude {{ auth()->user()->seller->latitude }}" type="text">
            
                            @if ($errors->has('lat'))
                                <p class="form-text text-danger"> {{ $errors->first('lat') }}</p>
                            @endif
            
                            <button type="button" id="getCoordonates" class="btn btn-primary container">Récupérer automatiquement<span class="d-inline d-sm-none"><br></span> ses coordonnées</button>  
            
                        </div>
                        
                        <!-- la photo de vente name:avatarSeller123-->
                        <div  class="custom-file">
                            <input class="custom-file-input" id="InputFileAvatarSeller1" type="file" aria-describedby="fileHelp" name="avatarSeller1">
            
                            <label class="custom-file-label" for="InputFileAvatarSeller1"><span class="d-none d-sm-inline">Modifier votre </span>1ère photo :</label>
            
                            @if ($errors->has('avatarSeller1'))
                                <p class="form-text text-danger"> {{ $errors->first('avatarSeller1') }}</p>
                            @endif
                        </div>

                        <div class="custom-file my-2">
                            <input class="custom-file-input" id="InputFileAvatarSeller2" type="file" aria-describedby="fileHelp" name="avatarSeller2">
            
                            <label class="custom-file-label" for="InputFileAvatarSeller2"><span class="d-none d-sm-inline">Ajouter/Modifier votre </span>2ème photo :</label>
            
                            @if ($errors->has('avatarSeller2'))
                                <p class="form-text text-danger"> {{ $errors->first('avatarSeller2') }}</p>
                            @endif
                        </div>

                        <div class="custom-file">
                            <input class="custom-file-input" id="InputFileAvatarSeller3" type="file" aria-describedby="fileHelp" name="avatarSeller3">
            
                            <label class="custom-file-label" for="InputFileAvatarSeller3"><span class="d-none d-sm-inline">Ajouter/Modifier votre </span>3ème photo :</label>
            
                            @if ($errors->has('avatarSeller3'))
                                <p class="form-text text-danger"> {{ $errors->first('avatarSeller3') }}</p>
                            @endif
                        </div>
            
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annuler</button>
                        <input class="btn btn-primary" id="submit" type="submit" value="Modifier">
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- End updateSellerModal -->