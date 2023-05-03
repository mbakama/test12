@extends('docteurs.template')


@section('titre')
    Repondre
@endsection


@section('content')
    <h2 class="text-center">Repondre au patient</h2>
    <hr>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show m-auto" style="width: 600px" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert Heading</strong> {{ session('message') }}
        </div>

        <script>
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function(alert) {
                new bootstrap.Alert(alert)
            })
        </script>
    @endif


    <form action="{{ route('docteurs.repondre', $all->id) }}" method="post">
        @csrf

        <div class="m-auto" style="width: 600px">
            <div class="mb-3">
                <label for="" class="form-label">nom</label>
                <input type="text" disabled value="{{ $all->prenom }}" name="nom" id=""
                    class="form-control @error('nom')
        
    @enderror" placeholder="" aria-describedby="helpId">
                <input type="hidden" value="{{ $all->nom }}" name="nom" id="" class="form-control"
                    aria-describedby="helpId">

            </div>
            <div class="mb-3">
                <label for="" class="form-label">prenom</label>
                <input disabled type="text" value="{{ $all->prenom }}" name="prenom" id=""
                    class="form-control @error('prenom')
        
    @enderror" placeholder="" aria-describedby="helpId">
                <input type="hidden" value="{{ $all->prenom }}" name="prenom" id="" class="form-control"
                    aria-describedby="helpId">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" disabled name="numero" id=""
                    class="form-control @error('numero')
        
    @enderror" value="{{ $all->numero }}" aria-describedby="helpId">
                <input type="hidden" value="{{ $all->numero }}" name="numero" id=""
                    class="form-control @error('numero')
        
    @enderror" placeholder="" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for=""  class="form-label">Adresse</label>
                <input disabled type="text" value="{{ $all->adresse }}" name="adresse" id=""
                    class="form-control @error('adresse')
        
    @enderror" placeholder="" aria-describedby="helpId">
    <input type="hidden" value="{{ $all->adresse }}" name="adresse" id=""
                    class="form-control @error('adresse')
        
    @enderror" placeholder="" aria-describedby="helpId">
                
            </div>
            <div class="mb-3">

                <textarea disabled name="probleme" class="form-control" id="" cols="30" rows="6">
                    {{ $all->probleme }}
                </textarea>
                <textarea hidden name="probleme" class="form-control" id="" cols="30" rows="6">
                    {{ $all->probleme }}
                </textarea>
            </div>
            <div class="mb-3">

                <textarea name="reponse" class="form-control" id="" cols="30" rows="6"></textarea>
            </div>
            <button class="btn-primary btn" type="submit">envoyer</button>
        </div>
    </form>
@endsection
