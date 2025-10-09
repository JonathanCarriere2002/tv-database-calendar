<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Plateforme
 * @author Jonathan
 */
class PlateformeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' =>fake()->unique()->company(),
            'image' => fake()->randomElement(['Image01.png', 'Image02.png', 'Image03.png']),
            'description' => fake()->paragraph('3'),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
