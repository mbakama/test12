@extends('patients.templates.template')


@section('titre')
    Acceuil
@endsection


@section('content')
<h2 class="text-center">Les messages recents</h2>
<hr>
@if (session('message'))
    <div class="alert alert-danger alert-dismissible fade show m-auto mb-3" style="width: 600px" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <strong>Ops</strong> {{ session('message') }}
    </div>
    
    <script>
      var alertList = document.querySelectorAll('.alert');
      alertList.forEach(function (alert) {
        new bootstrap.Alert(alert)
      })
    </script>
    
@endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    {{-- <th scope="col">Nom</th>
                    <th scope="col">Prenom</th> --}}
                    <th scope="col">Doleance</th>
                    <th scope="col">Adresse</th>
                    {{-- <th scope="col">Numero</th> --}}
                    <th scope="col">Date d'envoi</th>
                    {{-- <th scope="col">Time</th> --}}
                    <th scope="col">Nom du Docteur</th>
                    
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=1;
                @endphp
                @forelse ($patients as $agent)
                <tr class="">
                    <td scope="row">{{ $i++}}</td>
                    {{-- <td scope="row">{{ $agent->nom}}</td>
                    <td>{{ $agent->prenom}}</td> --}}
                    <td>{{ $agent->probleme}}</td>
                    <td>{{ $agent->adresse}}</td>
                    {{-- <td>{{ $agent->numero}}</td> --}}
                    <td>{{ $agent->created_at}}</td>
                    <td>{{ $agent->n }} </td>
                    

                    <td>
                        <a class="btn-success btn" href="{{ route('patients.edit',$agent->id) }}">Edit</a>
                        <form action="{{ route('patients.effacer',$agent->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-danger btn" type="submit">supprimer</button>
                        
                        </form>
                        {{-- <a class="p-1 delete" href="{{ route('patients.effacer',$agent->id) }}">supprimer</a> --}}
                        <a class="p-1 voir btn-default btn" href="{{ route('patients.voir',$agent->id) }}">voir</a>
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="7" class="text-center">Pas des données</td>
                </tr>
                @endforelse
                
               
            </tbody>
        </table>
  
    {{ $patients->links() }}
@endsection