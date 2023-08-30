<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recette_id'); // Clé étrangère pour lier les commentaires aux recettes
            $table->text('contenu');
            $table->timestamps();

            // Clé étrangère pour lier les commentaires aux recettes
            $table->foreign('recette_id')->references('id')->on('recettes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
