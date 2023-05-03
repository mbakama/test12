@extends('Agents.template')


@section('titre')
    Ajouter un agent
@endsection

@section('content')
    <h2 class="text-center">Formulaire d'Identification</h2>
    <hr>
    @if (session('message'))
        <div class="alert alert-sucess">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ url('agents/ajouter') }}" method="post">
        @csrf
        <div class="m-auto" style="width: 500px">
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
                <label for="" class="form-label">email</label>
                <input type="email" name="email" id=""
                    class="form-control @error('email')
            
        @enderror" placeholder=""
                    aria-describedby="helpId">
                @error('email')
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
                <label for="" class="form-label">Genre</label>
                <select name="sexe" class="form-select" id="">
                    <option value="Femme">Femme</option>
                    <option value="Homme">Homme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Etat civil</label>
                <select name="etat" class="form-select" id="">
                    <option value="Celibataire">Celibataire</option>
                    <option value="Marie(e)">Marie(e)</option>
                    <option value="Divorcé(e)">Divorcé(e)</option>
                    <option value="veuf(e)">veuf(e)</option>
                </select>
            </div>
            <button class="btn-primary btn" type="submit">enregistrer</button>
        </div>
    </form>
@endsection
