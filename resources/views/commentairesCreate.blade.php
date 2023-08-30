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
                        <form action="{{ route('modifierCommentaire', ['id' => $commentaire->id]) }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
                        </form>
                        <form action="{{ route('supprimerCommentaire', ['id' => $commentaire->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer le commentaire</button>
                        </form>
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

