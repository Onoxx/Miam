@extends('layouts.app')

@section('content')
<div style="display: flex; flex-direction: column; align-items: center;">
    <h1 style="margin-bottom: 20px;">Création de recette</h1>
    <form action="{{ route('storeRecette') }}" method="POST" enctype="multipart/form-data" style="width: 50%;">
        @csrf

        <label for="nom">Nom de la recette:</label>
        <input type="text" id="nom" name="nom" required style="width: 100%; padding: 10px; margin-bottom: 10px;">

        <label for="temps">Temps de cuisson:</label>
        <input type="text" id="temps" name="temps" required style="width: 100%; padding: 10px; margin-bottom: 10px;">

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required style="margin-bottom: 10px;">
        </br>
        <label for="commentaire">Commentaire:</label>
        <textarea id="commentaire" name="commentaire" rows="4" required style="width: 100%; padding: 10px; margin-bottom: 10px;"></textarea>

        <button type="submit" style="background-color: #3490dc; color: white; padding: 10px 20px; border: none; cursor: pointer;">Ajouter la recette</button>

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