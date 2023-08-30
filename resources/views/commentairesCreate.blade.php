@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un commentaire à "{{ $recette->nom }}"</h2>

    <h3>Commentaires existants :</h3>
    @if($recette->commentaires)
        @foreach ($recette->commentaires as $commentaire)
            <div class="card mb-2">
                <div class="card-body">
                    {{ $commentaire->contenu }}
                    <p class="small text-muted">Créé le {{ $commentaire->created_at->format('d/m/Y H:i') }}</p>

                    @if(auth()->check() && $commentaire->user_id === auth()->user()->id)
                        <div style="display:flex; align-items:center">
                            <a href="{{ route('modifierCommentaire', ['id' => $commentaire->id]) }}" style="display:inline-block; margin-right:10px; text-decoration:none;"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form method="POST" action="{{ route('supprimerCommentaire', ['id' => $commentaire->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="outline:none; border:none; background: none; cursor:pointer"><i class="fa-solid fa-trash" style="color:red"></i></button>
                            </form>
                        </div>
                    @endif
                    
                </div>
            </div>
        @endforeach
    @endif
    <hr>

    <form action="{{ route('enregistrerCommentaire', ['id' => $recette->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="recette_id" value="{{ $recette->id }}">
        <div class="form-group">
            <label for="contenu">Nouveau commentaire :</label>
            <textarea class="form-control" name="contenu" rows="4" required></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter le commentaire</button>
    </form>
</div>
@endsection

