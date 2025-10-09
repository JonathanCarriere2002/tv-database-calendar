<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration pour la table Animes
     * @author Jonathan Carrière
     */
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('titre', '50');
            $table->string('image', '100');
            $table->string('genre', '50');
            $table->string('description', '500');
            $table->string('studio', '50');
            $table->integer('saisons');
            $table->integer('episodes');
            $table->date('date_debut');
            $table->integer('duree_episode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
