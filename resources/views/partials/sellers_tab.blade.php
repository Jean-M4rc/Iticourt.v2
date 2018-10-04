<table class="table table-hover">
    <thead>
        <tr class="table-info fixed text-center">
            <th class="d-none d-lg-table-cell align-middle" scope="col">Nom du vendeur</th>
            <th class="align-middle" scope="col">Nom du point de vente</th>
            <th class="d-none d-lg-table-cell align-middle" scope="col">Catégorie</th>
            <th class="d-none d-lg-table-cell align-middle" scope="col">Adresse du lieu de vente</th>
            <th class="d-none d-lg-table-cell align-middle" scope="col">Téléphone</th>
            <th class="d-none d-sm-table-cell align-middle" scope="col">Voir sur la carte</th>
            <th class="d-none d-sm-table-cell align-middle" scope="col">Voir les photos</th>
            <th class="d-none d-sm-table-cell align-middle" scope="col">Supprimer</th>
            <th scope="col" class="d-table-cell d-sm-none align-middle">Actions</th>
        </tr>
    </thead>

    <tbody>
        
        @forelse ($pdvs as $pdv)

            <tr class="table-primary text-center align-middle">

                <td class="d-none d-lg-table-cell align-middle">{{ $pdv->user->nickname }}</td>
                <td class="align-middle">{{ $pdv->business_name }}</td>
                <td class="d-none d-lg-table-cell align-middle">
                    @foreach ($pdv->categories as $seller_category)
                        {{ $seller_category->name }}
                    @endforeach
                </td>
                <td class="d-none d-lg-table-cell align-middle">{{ $pdv->address }}</td>
                <td class="d-none d-lg-table-cell align-middle">{{ $pdv->phone }}</td>
                <td class="d-none d-sm-table-cell align-middle"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMapSeller{{ $pdv->id }}">Carte</button></td>
                <td class="d-none d-sm-table-cell align-middle"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAvatarSeller{{ $pdv->id }}">Photos</button></td>
                <td class="d-none d-sm-table-cell align-middle"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDeleteSeller{{ $pdv->id }}">Supprimer</button></td>
                

                <!-- partie caché en vue large -->
				<td class="d-table-cell d-sm-none" style="width:120px">
                    <button class="btn btn-outline-success action-toggler mb-1" type="button" data-toggle="collapse" data-target="#actionCollapsed{{ $pdv->id }}" aria-controls="actionCollapsed" aria-expanded="false"><i class="fas fa-bars"></i></button>
                    
                    <div id="actionCollapsed{{ $pdv->id }}" class="collapse px-0 mx-auto" >
                        
                        <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modalMapSeller{{ $pdv->id }}"><i class="fas fa-map-marked-alt"></i></button><br/>
                        
                        <button class="btn btn-outline-primary my-1" type="button" data-toggle="modal" data-target="#modalAvatarSeller{{ $pdv->id }}"><i class="far fa-image"></i></button><br/>
                        
						<button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#modalDeleteSeller{{ $pdv->id }}"><i class="far fa-trash-alt"></i></button>
					</div>
				</td>
                
                    
            </tr>

            <!-- modalMapSeller -->
            @include('partials.modals.modalMapSeller')

            <!-- modalAvatarUser -->
            @include('partials.modals.modalAvatarSeller')

            <!-- modalInfoUser -->
            @include('partials.modals.modalDeleteSeller')

        @empty

            <tr class="table-warning text-center"><td colspan="8">Aucun point de vente enregistré</td></tr>
            
        @endforelse
         
    </tbody>
</table> 