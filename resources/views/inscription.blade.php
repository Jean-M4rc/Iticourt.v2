@extends('layout')

@section('contenu')

    <h1 class="my-4 text-center">Inscription à Iticourt</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="accordion container" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-primary btn-block btn-lg my-5" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Acheteur</button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body container">
                    @include('partials.buyersignform')
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-dark btn-block btn-lg my-5" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Vendeur !</button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    @include('partials/sellersignform')
                </div>
            </div>
        </div>
    </div>

@endsection