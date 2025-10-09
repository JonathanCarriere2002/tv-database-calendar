<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration pour la table Plateformes_Animes
     * @author Jonathan Carrière
     */
    public function up(): void
    {
        Schema::create('plateformes_animes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("anime_id")->nullable();
            $table->foreignId("plateforme_id")->nullable();
            $table->foreign("anime_id")->references("id")->on("animes")->cascadeOnDelete();
            $table->foreign("plateforme_id")->references("id")->on("plateformes")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plateformes_animes');
    }
};
