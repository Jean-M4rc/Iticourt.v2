<table class="table table-hover">
    <thead>
        <tr class="table-info fixed text-center">
            <th class="align-middle" scope="col">Auteur</th>
            <th class="align-middle" scope="col">Point de vente</th>
            <th class="d-none d-lg-table-cell align-middle" scope="col">Date</th>
            <th scope="col" class="align-middle">Actions</th>
        </tr>
    </thead>

    <tbody>
        
        @forelse ($comments as $comment)

            <tr class="table-primary text-center align-middle">

                <td class="align-middle">{{ $comment->user->nickname }}</td>
                <td class="align-middle">{{ $comment->seller->business_name }}</td>
                <td class="d-none d-lg-table-cell align-middle">{{ $comment->created_at->format('d/m/Y à H:i:s') }}</td>
                <td class="align-middle"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalComment{{ $comment->id }}">Actions</button></td> 
                    
            </tr>

            <!-- modalComment -->
            @include('partials.modals.modalComment')

        @empty

            <tr class="table-warning text-center"><td colspan="5">Aucun commentaire enregistré</td></tr>
            
        @endforelse    
          
    </tbody>
</table> 