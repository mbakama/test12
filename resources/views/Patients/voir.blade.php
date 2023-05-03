@extends('patients.templates.template')


@section('titre')
   voir les informations
@endsection

@section('content')
<h2 class="text-center">Information personnelle</h2>
<hr>

<div class="card">
    
    <div class="card-body">
        <h4 class="card-title">Nom complet: {{ $patient->prenom }} {{ $patient->nom }} </h4>
        <p class="card-text">Numero : {{ $patient->numero }}</p>
        <p class="card-text">Adresse : {{ $patient->adresse }}</p>
        <p class="card-text">doleance :{{ $patient->probleme }}</p>
        <p class="card-text">Reponse docteur {{ $patient->docteurs->id }} :  {{ $patient->reponse }}
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, temporibus id? Quo quisquam voluptas reprehenderit natus eos? Debitis praesentium molestiae rem vero ea quo recusandae fugit natus eum officia dolorum, consequatur numquam architecto est facere! Quasi eius nihil ratione atque? Unde voluptatibus tenetur architecto, dolorum distinctio perspiciatis reiciendis eos autem nemo, vitae pariatur ipsa ducimus, nobis cum quidem! Dolorem architecto pariatur placeat, quae fuga consequatur earum necessitatibus aliquid cum corrupti sunt eum saepe sequi dolorum voluptate ipsam modi est beatae voluptates quibusdam perspiciatis. Atque blanditiis, tenetur quasi voluptatibus, minima consequatur voluptas quos nihil repellendus veritatis iusto culpa velit porro ut aspernatur voluptate! Officia, commodi. Aliquam iusto molestias nihil voluptates voluptatem eligendi repellendus veritatis itaque asperiores eius voluptatum consequatur numquam ab, minus soluta, accusantium vitae doloribus debitis omnis cumque quo. Vitae quia omnis voluptatem rerum, magnam excepturi, neque vel, qui quam quae temporibus tempora vero cumque consequatur voluptates illo consequuntur. Exercitationem modi deserunt nesciunt impedit non vel tempora voluptatem sit mollitia eius minus voluptatum voluptas aut deleniti sed, quas facere provident sequi molestias eaque consectetur necessitatibus. Doloremque quis expedita harum, nostrum aliquam rerum voluptas. Culpa velit eius nihil assumenda fugiat corporis inventore est molestiae qui exercitationem, magnam animi aliquam, fuga similique.
             </p>
             <span style ="margin-top:5px"> repondu  {{ $patient->updated_at }}</span>
    </div>
</div>
    
@endsection