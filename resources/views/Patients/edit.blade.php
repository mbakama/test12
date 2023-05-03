

@extends('patients.templates.template')


@section('titre')
    Edit un message
@endsection


@section('content')
<h2 class="text-center">Edit son message</h2>
<hr>

@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show m-auto" style="width: 600px" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <strong>Alert Heading</strong> {{ session('message') }} </div>
    
    <script>
      var alertList = document.querySelectorAll('.alert');
      alertList.forEach(function (alert) {
        new bootstrap.Alert(alert)
      })
    </script>
    
@endif


<form action="{{ route('patients.update',$patient->id) }}" method="post">
    @csrf
    @method('put')
    <div class="m-auto" style="width: 600px">
        <div class="mb-3">
            <label for="" class="form-label">nom</label>
            <input type="text" value="{{ $patient->nom }}" name="nom" id=""
                class="form-control @error('nom')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('nom')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">prenom</label>
            <input type="text" value="{{ $patient->prenom }}" name="prenom" id=""
                class="form-control @error('prenom')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('prenom')
                {{ $message }}
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" value="{{ $patient->numero }}" name="numero" id=""
                class="form-control @error('numero')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('numero')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Adresse</label>
            <input type="text" value="{{ $patient->adresse }}" name="adresse" id=""
                class="form-control @error('adresse')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('adresse')
                {{ $message }}
            @enderror
        </div>
       
        <div class="mb-3">
           
            <textarea name="probleme"  class="form-control" id="" cols="30" rows="6">{{ $patient->probleme }}</textarea>
        </div>
        <button class="btn-primary btn" type="submit">envoyer</button>
    </div>
</form>
@endsection

