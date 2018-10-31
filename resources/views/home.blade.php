@extends('layout')

@section('contenu')
<div>
    <div id="titleblock">

        <h1 class="display-6 text-center mt-2">Iticourt</h1>
        <p class="lead text-center container">L'itinéraire des circuits courts</p>
        <hr>

        <div class="row d-none d-md-block mt-5" style="height:150px"></div>

    </div>

    <div class="row w-100">

        <div id="buyingblock" class="col-12 col-md-6 flex-column flex-center">
            <a id="buybtn1" href="#">
                <i class="fas fa-shopping-basket fa-5x flex-center"></i>
                <p class="lead text-center">Vous achetez !</p>
            </a>
        </div>
        
        <div id="signinlink" class="col-12 col-md-6 flex-column flex-center">
            <a href="" data-toggle="modal" data-target="#logInModal">
                <i class="fas fa-home fa-5x flex-center"></i>
                <p class="lead ">Vous vendez !</p>
            </a>
        </div>
            
    </div>

    <div id="loader" style="display:none">
        <img src="/storage/loader/ajax-loader.gif"/>
        <p class="lead text-primary bold">Veuillez patientez</p>
    </div>

    <div id="mapBox" class="container col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2"></div>
    
</div>

@endsection