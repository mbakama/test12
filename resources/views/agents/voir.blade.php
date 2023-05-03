@extends('Agents.template')


@section('titre')
   voir les informations
@endsection

@section('content')
<h2 class="text-center">Information personnelle</h2>
<hr>

<div class="card">
    
    <div class="card-body">
        <h4 class="card-title">Nom complet: {{ $agent->prenom }} {{ $agent->nom }} </h4>
        <p class="card-text">Email : {{ $agent->email }}</p>
        <p class="card-text">Numero : {{ $agent->numero }}</p>
        <p class="card-text">Adresse : {{ $agent->adresse }}</p>
        <p class="card-text">Genre :{{ $agent->sexe }}</p>
        <p class="card-text">Etat civil:{{ $agent->etat }}</p>
    </div>
</div>
    
@endsection