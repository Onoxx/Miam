@extends('layouts.app')

@section('content')
<div style="display: flex; flex-direction: column; align-items: center;">
    <h1 style="margin-bottom: 20px;">Modification de recette</h1>
    <form action="{{ route('updateRecette', ['id' => $recette->id]) }}" method="POST" enctype="multipart/form-data" style="width: 50%;">
        @csrf
        @method('PUT')

        <label for="nom">Nom de la recette:</label>
        <input type="text" id="nom" name="nom" value="{{ $recette->nom }}" required style="width: 100%; padding: 10px; margin-bottom: 10px;">

        <label for="temps">Temps de cuisson:</label>
        <input type="text" id="temps" name="temps" value="{{ $recette->temps_cuisson }}" required style="width: 100%; padding: 10px; margin-bottom: 10px;">

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" style="margin-bottom: 10px;">
        </br>
        <label for="commentaire">Commentaire:</label>
        <textarea id="commentaire" name="commentaire" rows="4" required style="width: 100%; padding: 10px; margin-bottom: 10px;">{{ $recette->commentaire }}</textarea>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>

        <button type="button" onclick="window.location='{{ route('home') }}'" class="btn btn-danger">Annuler</button>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>
@endsection