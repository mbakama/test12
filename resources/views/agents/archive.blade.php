@extends('Agents.template')


@section('titre')
   Liste des archivés
@endsection

@section('content')
<h2 class="text-center">La liste des archivés</h2>
<hr>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Etat civil</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agents as $agent)
                <tr class="">
                    <td scope="row">{{ $agent->nom}}</td>
                    <td>{{ $agent->prenom}}</td>
                    <td>{{ $agent->email}}</td>
                    <td>{{ $agent->numero}}</td>
                    <td>{{ $agent->adresse}}</td>
                    <td>{{ $agent->sexe}}</td>
                    <td>{{ $agent->etat}}</td>
                    <td>
                        <a class="p-1 delete" href="{{ url('agents/restored',$agent->id) }}">restore</a>
                        <a class="p-1 voir" href="{{ url('agents/voir',$agent->id) }}">voir</a>
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="7" class="text-center">Pas des données</td>
                </tr>
                @endforelse
                
               
            </tbody>
        </table>
    </div>
    
@endsection