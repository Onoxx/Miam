<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    protected $table = 'recettes'; 

    protected $fillable = ['nom', 'temps_cuisson', 'image', 'commentaire'];


    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
