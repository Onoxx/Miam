@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Recettes :</h2>
    <div class="row">
        @foreach ($recettes as $recette)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="image-container">
                    <img src="{{ asset('storage/' . $recette->image) }}" class="card-img-top" alt="{{ $recette->nom }}" style="height: 20rem;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $recette->nom }}</h5>
                    <p class="card-text">{{ $recette->commentaire }}</p>
                    <p>Temps de cuisson : {{ $recette->temps_cuisson }}</p>

                    @if(auth()->check() && $recette->user_id === auth()->user()->id)
                    
                    <form action="{{ route('deleteRecette', ['id' => $recette->id]) }}" method="POST">
                        <a href="{{ route('editRecette', ['id' => $recette->id]) }}" class="btn btn-primary">Modifier la recette</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer la recette</button>
                    </form>
                    @endif
                    <br>
                    <a href="{{ route('ajouterCommentaire', ['id' => $recette->id]) }}" class="btn btn-info btnComment">Afficher les commentaires</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection