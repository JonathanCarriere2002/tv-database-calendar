<?php

namespace Database\Factories;

use App\Models\Anime;
use App\Models\Doubleur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Personnage
 * @author Jonathan
 */
class PersonnageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'image' => fake()->randomElement(['Image01.png', 'Image02.png', 'Image03.png']),
            'description' => fake()->paragraph('3'),
            'anime_id' => Anime::factory(1)->createOne()->id,
            'doubleurs_id' => Doubleur::factory(1)->createOne()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
