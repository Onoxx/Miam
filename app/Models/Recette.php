<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $table = 'recettes'; // Nom de la table des recettes

    protected $fillable = ['nom', 'temps_cuisson', 'image', 'commentaire'];

    // Exemple de relation avec l'utilisateur qui a créé la recette
    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
    
}
