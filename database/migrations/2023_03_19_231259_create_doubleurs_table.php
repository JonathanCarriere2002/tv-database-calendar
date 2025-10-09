<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration pour la table Doubleurs
     * @author Jonathan Carrière
     */
    public function up(): void
    {
        Schema::create('doubleurs', function (Blueprint $table) {
            $table->id();
            $table->string("nom",50);
            $table->string("prenom",50);
            $table->string('image', '100');
            $table->date("date_naissance");
            $table->string('lieu_naissance', '50');
            $table->integer("annees_pratique");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doubleurs');
    }
};
