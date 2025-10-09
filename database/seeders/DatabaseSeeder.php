<?php

namespace Database\Seeders;

use App\Models\Anime;
use App\Models\Critique;
use App\Models\Horaire;
use App\Models\Personnage;
use App\Models\Plateforme;
use App\Models\User;
use App\Models\Doubleur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Créer des données dans la base de données par défaut
     * @author Jonathan Carrière
     */
    public function run(): void
    {
        // Ajouter les vraies données de l'application dans la base de données lors du seeding
        (new UsersSeeder)->run();
        (new AnimesSeeder)->run();
        (new HorairesSeeder)->run();
        (new DoubleursSeeder)->run();
        (new PlateformesSeeder)->run();
        (new PersonnagesSeeder)->run();
        (new AnimesPlateformesSeeder)->run();
        (new CritiquesSeeder)->run();

        // Ajouter les données provenant du Factory de l'application dans la base de données lors du seeding
        //Anime::factory(10)->create();
        //User::factory(10)->create();
        //Doubleur::factory(10)->create();
        //Plateforme::factory(10)->create();
        //Personnage::factory(10)->create();
        //Critique::factory(10)->create();
        //Horaire::factory(10)->create();
    }
}
