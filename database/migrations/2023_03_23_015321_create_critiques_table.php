<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration pour la table Critiques
     * @author Jonathan Carrière
     */
    public function up(): void
    {
        Schema::create('critiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreign('anime_id')->references('id')->on('animes')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('titre', '50');
            $table->string('texte', '1000');
            $table->integer('score');
            $table->date('date_ecriture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('critiques');
    }
};
