<?php

namespace Database\Factories;

use App\Models\Anime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Critique
 * @author Jonathan Carrière
 */
class CritiqueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'anime_id' => Anime::factory(1)->createOne()->id,
            'user_id' => User::factory(1)->createOne()->id,
            'titre' => fake()->unique()->name(),
            'texte' => fake()->paragraph('3'),
            'score' => fake()->numberBetween(0, 10),
            'date_ecriture' => fake()->dateTimeBetween(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
