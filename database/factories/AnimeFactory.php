<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory pour le modèle Anime
 * @author Jonathan Carrière
 */
class AnimeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->unique()->name(),
            'image' => fake()->randomElement(['bleach.jpg', 'codegeass.jpg', 'gintama.jpg', 'hunterhunter.jpg', 'jujutsukaisen.jpg']),
            'genre' => fake()->randomElement(['Action', 'Aventure', 'Comédie', 'Drama', 'Fantastique']),
            'description' => fake()->paragraph('3'),
            'studio' => fake()->company(),
            'saisons' => fake()->numberBetween(1, 50),
            'episodes' => fake()->numberBetween(1, 1000),
            'date_debut' => fake()->date(),
            'duree_episode' => fake()->numberBetween(1, 60),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
