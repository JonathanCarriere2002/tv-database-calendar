<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration pour la table Personnages
     * @author Jonathan Carrière
     */
    public function up(): void
    {
        Schema::create('personnages', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50);
            $table->foreignId('anime_id')->nullable();
            $table->foreignId('doubleurs_id')->nullable();
            $table->foreign('anime_id')->references('id')->on('animes')->nullOnDelete();
            $table->foreign('doubleurs_id')->references('id')->on('doubleurs')->nullOnDelete();
            $table->string('image', '100');
            $table->string('description', '500');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnages');
    }
};
