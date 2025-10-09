<?php

namespace Database\Factories;

use App\Models\Anime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Horaire
 * @author Jonathan Carrière
 */
class HoraireFactory extends Factory
{
    public function definition(): array
    {
        return [
            'anime_id' => Anime::factory(1)->createOne()->id,
            'user_id' => User::factory(1)->createOne()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
