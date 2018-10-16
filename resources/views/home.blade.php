@extends('layout')

@section('contenu')
<div>
    <div id="titleblock">

        <h1 class="display-6 text-center mt-2">Iticourt</h1>
        <p class="lead text-center container">L'itinéraire des circuits courts</p>
        <hr>

        <div class="row d-none d-md-block mt-5" style="height:150px"></div>

    </div>

    <div class="row">

        <div id="buyingblock" class="col-12 col-md-6 flex-column flex-center">
            <a id="buybtn1" href="" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="signinlink titleblock">
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

    <!-- les icones de produits -->
    <div id ="imgcat" class="my-2" style="display:none">
        <!--<ul id="listcat" class="justify-content-around">
            <li><img class="imagecat" src="/storage/svg/shopping-list.svg" alt='allchecked' width="70px" height="70px"/></li>
            <li><img class="imagecat" src="/storage/svg/carrot-and-apple.svg" alt='carrot' width="70px" height="70px"/></li>
            <li><img class="imagecat" src="/storage/svg/animals.svg" alt='animals' width="70px" height="70px"/></li>
            <li><img class="imagecat" src="/storage/svg/milk.svg" alt='milk' width="70px" height="70px"/></li>
            <li><img class="imagecat" src="/storage/svg/wine.svg" alt='wine' width="70px" height="70px"/></li>
            <li id="cancelmap"><img class="imagecat" src="/storage/svg/cancel.svg" alt='cancel' width="70px" height="70px"/></li>
        </ul>-->
        <div class="btn-group btn-group-toggle btncat col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 justify-content-around leaflet-control-layers-overlays" data-toggle="buttons">

            <label id="labelCatAll" class="btn active mx-1 leaflet-control-layers-selector" for="option1"><!-- tout, par défaut -->
              <input class="" type="radio" name="options" id="option1" autocomplete="off">
              <img class="imagecat" src="/storage/svg/shopping-list.svg" alt='allchecked'/>
            </label>

            <label class="btn mr-1" id="icocatFL"><!-- cat FL -->
              <input type="radio" class="leaflet-control-layers-selector" name="options" id="option2" autocomplete="off">
              <img class="imagecat" src="/storage/svg/carrot-and-apple.svg" alt='carrot'/>
            </label>

            <label class="btn mr-1"><!-- cat VO -->
              <input type="radio" class="leaflet-control-layers-selector" name="options" id="option3" autocomplete="off">
              <img class="imagecat" src="/storage/svg/animals.svg" alt='animals'/>
            </label>

            <label class="btn mr-1"><!-- catLF -->
                <input type="radio" class="leaflet-control-layers-selector" name="options" id="option4" autocomplete="off">
                <img class="imagecat" src="/storage/svg/milk.svg" alt='milk'/>
            </label>

            <label class="btn"><!-- cat BA -->
                <input type="radio" class="leaflet-control-layers-selector" name="options" id="option5" autocomplete="off">
                <img class="imagecat" src="/storage/svg/wine.svg" alt='wine'/>
            </label>

            <a href="" class="btncat mx-1" id="cancelmap"><!-- close -->
                <img class="imagecat" src="/storage/svg/cancel.svg" alt='cancel'/>
            </a>

        </div>
        

    </div>

    <div id="loader" style="display:none">
        <img src="/storage/loader/ajax-loader.gif"/>
        <p class="lead text-primary bold">Veuillez patientez</p>
    </div>

    <div id="mapBox" class="container my-2 col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <!--<div id="map"></div>-->
    </div>
    
</div>

@endsection