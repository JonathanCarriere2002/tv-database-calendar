<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Doubleur
 * @author Jonathan
 */
class DoubleurFactory extends Factory
{
    public function definition(): array
    {
        return [
            "nom" => fake()->lastName(),
            "prenom" =>fake()->firstName(),
            'image' => fake()->randomElement(['Image01.png', 'Image02.png', 'Image03.png']),
            "date_naissance" => fake()->dateTimeBetween(),
            "lieu_naissance" =>fake()->city(),
            "annees_pratique" => fake()->numberBetween(1,25),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
