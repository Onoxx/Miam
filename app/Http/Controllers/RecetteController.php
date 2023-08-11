<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;

class RecetteController extends Controller
{
    public function create()
    {
        return view('recetteCreate');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|string|max:255',
            'temps' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'commentaire' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $recette = new Recette();
        $recette->nom = $request->input('nom');
        $recette->temps_cuisson = $request->input('temps');
        $recette->image = $imagePath;
        $recette->commentaire = $request->input('commentaire');
        $recette->user_id = auth()->user()->id; 
        $recette->save();

        return redirect()->route('home')->with('success', 'Recette ajoutée avec succès');
    }
}
