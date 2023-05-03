

@extends('patients.templates.template')


@section('titre')
    envoi un message
@endsection


@section('content')
<h2 class="text-center">Soumettre un probleme au docteur</h2>
<hr>

@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show m-auto" style="width: 600px" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <strong>Alert Heading</strong> Alert Content
    </div>
    
    <script>
      var alertList = document.querySelectorAll('.alert');
      alertList.forEach(function (alert) {
        new bootstrap.Alert(alert)
      })
    </script>
    
@endif


<form action="{{ route('patients.store') }}" method="post">
    @csrf

    <div class="m-auto" style="width: 600px">
        <div class="mb-3">
            <label for="" class="form-label">nom</label>
            <input type="text" name="nom" id=""
                class="form-control @error('nom')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('nom')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">prenom</label>
            <input type="text" name="prenom" id=""
                class="form-control @error('prenom')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('prenom')
                {{ $message }}
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" name="numero" id=""
                class="form-control @error('numero')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('numero')
                {{ $message }}
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Adresse</label>
            <input type="text" name="adresse" id=""
                class="form-control @error('adresse')
        
    @enderror" placeholder=""
                aria-describedby="helpId">
            @error('adresse')
                {{ $message }}
            @enderror
        </div>
       
        <div class="mb-3">
           
            <textarea name="probleme" class="form-control" id="" cols="30" rows="6"></textarea>
        </div>
        <button class="btn-primary btn" type="submit">envoyer</button>
    </div>
</form>
@endsection

