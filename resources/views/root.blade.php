@extends('layout')

@section('contenu')

<h1 class="text-center my-4">Bienvenue sur la page d'administration d'iticourt</h1>
<p class="lead text-center">Vous trouverez ici les différentes parties à administrer</p>
<hr class="my-4">

<div class="container">

  <!-- Nav rootTabs -->
  <ul class="nav nav-tabs" id="rootTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="profiles-tab" data-toggle="tab" href="#profiles" role="tab" aria-controls="profiles" aria-selected="true">Acheteurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false">Vendeurs et Points de ventes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Commentaires</a>
    </li>
  </ul>
    
  <!-- Tab panes -->
  <div class="tab-content">

    <!-- users tab -->
    <div class="tab-pane active" id="profiles" role="tabpanel" aria-labelledby="profiles-tab">
      
      @include('partials.users_tab')
    
    </div>

    <!-- sellers tab -->
    <div class="tab-pane" id="business" role="tabpanel" aria-labelledby="business-tab">

      @include('partials.sellers_tab')
    
    </div>

    <!-- comments tab -->
    <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab">
    
      @include('partials.comments_tab')
    
    </div>

  </div>
</div>
    
    
@endsection