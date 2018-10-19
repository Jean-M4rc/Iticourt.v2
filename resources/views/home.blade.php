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
        
        <div class="btn-group btn-group-toggle btncat col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 justify-content-around" data-toggle="buttons">

            <label id="labelCatFL" class="btn mr-1 active" for="option2"><!-- cat FL -->
              <input type="checkbox" name="options2" id="option2" autocomplete="off">
              <img class="imagecat" src="/storage/svg/carrot-and-apple.svg" alt='carrot'/>
            </label>

            <label id="labelCatVO" class="btn mr-1 active"><!-- cat VO -->
              <input type="checkbox" name="options3" id="option3" autocomplete="off">
              <img class="imagecat" src="/storage/svg/animals.svg" alt='animals'/>
            </label>

            <label id="labelCatLF" class="btn mr-1 active"><!-- catLF -->
                <input type="checkbox" name="options4" id="option4" autocomplete="off">
                <img class="imagecat" src="/storage/svg/milk.svg" alt='milk'/>
            </label>

            <label id="labelCatBA" class="btn active"><!-- cat BA -->
                <input type="checkbox" name="options" id="option5" autocomplete="off">
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
        
    </div>
    
</div>

@endsection