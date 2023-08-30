@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le commentaire</h2>

    <form action="{{ route('mettreAJourCommentaire', ['id' => $commentaire->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="contenu">Contenu du commentaire :</label>
        <textarea class="form-control" name="contenu">{{ $commentaire->contenu }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    
</div>
@endsection
