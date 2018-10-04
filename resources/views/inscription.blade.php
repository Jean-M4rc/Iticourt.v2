@extends('layout')

@section('contenu')

    <h1 class="my-4 text-center">Inscription à Iticourt</h1>

    @include('partials/buyersignform')

    <hr>

    @include('partials/sellersignform')

@endsection