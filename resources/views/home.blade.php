@extends('layout')

@section('contenu')
<div>
    <div>

        <h1 class="display-6 text-center mt-2">Iticourt</h1>
        <p class="lead text-center container">L'itinéraire des circuits courts</p>
        <hr>

        <div class="row d-none d-md-block mt-5">
            <p class="lead text-center flex-center" style="height:150px">Que voulez-vous faire ?</p>        
        </div>

    </div>
    
    <div class="row">

        <div class="col-12 col-md-6 flex-column flex-center" style="height:150px">
            <a id="buybtn1" href="" @click.prevent="show = !show">
                <i class="fas fa-shopping-basket fa-4x flex-center"></i>
                <p class="lead text-center">Vous achetez !</p>
            </a>
        </div>

        
        
        <div class="col-12 col-md-6 flex-column flex-center " style="height:150px">
                <a class="links" href="#logInModal" data-toggle="modal" data-target="#logInModal" >
                    <i class="fas fa-home fa-4x flex-center"></i>
                    <p class="lead ">Vous vendez !</p>
                </a>
        </div>
            
    </div>

    <div><button >Fermer la carte</button></div>

    <div class="col-12 col-lg-6 offset-lg-3" id="mapbox" style="height:85vh;width:100vw">
        <l-map :zoom="zoom" :center="center">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lng="marker"></l-marker>
        </l-map>
    </div>


    
</div>
@endsection