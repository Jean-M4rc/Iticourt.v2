@extends('layout')

@section('contenu')
<div>
    <div id="titleblock" class="collapse show multi-collapse">

        <h1 class="display-6 text-center mt-2">Iticourt</h1>
        <p class="lead text-center container">L'itinéraire des circuits courts</p>
        <hr>

        <div class="row d-none d-md-block mt-5" style="height:150px"></div>

    </div>
    
    <div class="row">

        <div class="col-12 col-md-6 flex-column flex-center multi-collapse collapse show" style="height:150px">
            <a id="buybtn1" href="" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="signinlink titleblock">
                <i class="fas fa-shopping-basket fa-4x flex-center"></i>
                <p class="lead text-center">Vous achetez !</p>
            </a>
        </div>        
        
        <div id="signinlink" class="col-12 col-md-6 flex-column flex-center collapse show multi-collapse" aria-expanded="false" style="height:150px">
                <a href="" data-toggle="modal" data-target="#logInModal">
                    <i class="fas fa-home fa-4x flex-center"></i>
                    <p class="lead ">Vous vendez !</p>
                </a>
        </div>
            
    </div>

    <!-- les icones de produits -->
    <div class="container my-2 d-flex justify-content-around col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 ">
        <ul class="nav collapse multi-collapse">
            <li class="nav-item"><img class="imagecat" src="/storage/svg/carrot-and-apple.svg" alt='carrot' width="50px" height="50px"/></li>
            <li class="nav-item"><img class="imagecat" src="/storage/svg/animals.svg" alt='animals' width="50px" height="50px"/></li>
            <li class="nav-item"><img class="imagecat" src="/storage/svg/milk.svg" alt='milk' width="50px" height="50px"/></li>
            <li class="nav-item"><img class="imagecat" src="/storage/svg/wine.svg" alt='wine' width="50px" height="50px"/></li>
            <li class="nav-item"><a href="" data-toggle="collapse" data-target="multi-collapse" aria-expanded="true" aria-controls="signinlink titleblock"><img class="imagecat" src="/storage/svg/cancel.svg" alt='cancel' width="50px" height="50px"/></a></li>
        </ul>
    </div>

    <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 collapse multi-collapse" id="mapbox" style="">
        <div style="height:75vh;background-color:blue"></div>
    </div>
    
</div>

@endsection