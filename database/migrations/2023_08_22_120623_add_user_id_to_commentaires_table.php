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
    Schema::table('commentaires', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id'); // Ajoutez la colonne user_id
        $table->foreign('user_id')->references('id')->on('users'); // Liez la colonne à la table users
    });
}

public function down()
{
    Schema::table('commentaires', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
