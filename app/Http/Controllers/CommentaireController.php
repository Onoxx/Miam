<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Recette;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function create($id)
    {
        $recette = Recette::find($id);
        
        if($recette){
            $nomRecette = $recette->nom;
            return view('commentairesCreate', compact('recette'));
        }
    }
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'contenu' => 'required|string',
        ]);

        $commentaire = new Commentaire();
        $commentaire->contenu = $request->input('contenu');
        $commentaire->user_id = auth()->user()->id;

        // Assigner l'ID de la recette au commentaire
        $commentaire->recette_id = $id;

        $commentaire->save();

        return redirect()->route('ajouterCommentaire', ['id' => $commentaire->recette_id])->with('success', 'Commentaire enregistré avec succès');
    }

    public function edit($id)
    {
        $commentaire = Commentaire::findOrFail($id);

        // Vérifiez si l'utilisateur actuel est autorisé à modifier ce commentaire
        if ($commentaire->user_id !== auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à modifier ce commentaire');
        }

        return view('modifierCommentaire', compact('commentaire'));
    }
    
    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);

        // Vérifiez si l'utilisateur actuel est autorisé à modifier ce commentaire
        if ($commentaire->user_id !== auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à modifier ce commentaire');
        }

        $this->validate($request, [
            'contenu' => 'required|string',
        ]);

        $commentaire->contenu = $request->input('contenu');
        $commentaire->save();

        return redirect()->route('ajouterCommentaire', ['id' => $commentaire->recette_id])->with('success', 'Commentaire mis à jour avec succès');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);

        if ($commentaire->user_id !== auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce commentaire');
        }

        $commentaire->delete();

        return redirect()->route('ajouterCommentaire', ['id' => $commentaire->recette_id])->with('success', 'Commentaire supprimé avec succès');
    }

}
