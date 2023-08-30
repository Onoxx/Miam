<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
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
    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);

        if (auth()->user()->id === $recette->user_id) {
            $recette->delete();
            return redirect()->route('home')->with('success', 'Recette supprimée avec succès');
        } else {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à supprimer cette recette');
        }
    }
    
    public function edit($id)
    {
        $recette = Recette::findOrFail($id);

        return view('editRecette', compact('recette'));
    }
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'nom' => 'required|string|max:255',
        'temps' => 'required|string|max:50',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Mettez la taille maximale souhaitée
        'commentaire' => 'required|string',
    ]);

    $recette = Recette::findOrFail($id);
    $recette->nom = $request->input('nom');
    $recette->temps_cuisson = $request->input('temps');
    $recette->commentaire = $request->input('commentaire');

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($recette->image); // Supprime l'ancienne image
        $imagePath = $request->file('image')->store('images', 'public');
        $recette->image = $imagePath;
    }

    $recette->save();

    return redirect()->route('home')->with('success', 'Recette modifiée avec succès');
}

}
