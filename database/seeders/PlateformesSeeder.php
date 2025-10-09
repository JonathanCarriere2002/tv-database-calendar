<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

/**
 * Seeder pour le modèle Plateforme permettant d'ajouter les vraies données de l'application dans la base de données
 * @author Jonathan Carrière
 */
class PlateformesSeeder
{
    public function run(): void
    {
        // Source : Les descriptions des plateformes proviennent de Wikipédia. Les textes ont étés traduit de l'anglais au français via Google Translate. (https://en.wikipedia.org/wiki/Main_Page)
        DB::table("plateformes")->insert([
            ["nom" => "Crunchyroll", "image" => "crunchyroll.jpg", "description" => "Crunchyroll est un service américain de streaming vidéo à la demande par abonnement appartenant à Sony Group Corporation via une joint-venture entre Sony Pictures et Aniplex de Sony Music Entertainment Japan."],
            ["nom" => "Funimation", "image" => "funimation.jpg", "description" => "Crunchyroll, LLC, anciennement connue sous le nom de Funimation de 1994 à 2022, est une société de divertissement américaine détenue par Sony Group Corporation en tant que coentreprise entre Sony Pictures et Sony Music Entertainment Japan."],
            ["nom" => "HiDive", "image" => "hidive.jpg", "description" => "Hidive, LLC est un service de vidéo à la demande par abonnement axé sur le streaming d'anime. Après l'arrêt d'Anime Network Online en 2017, Hidive LLC, une nouvelle société non affiliée à Anime Network, a acquis les actifs du service."],
            ["nom" => "Netflix", "image" => "netlfix.jpg", "description" => "Netflix, Inc. est une société de médias américaine basée à Los Gatos, en Californie. Elle exploite le service de vidéo à la demande par abonnement over-the-top de la marque Netflix, qui comprend des films et des séries télévisées originaux, tels que des animes."],
            ["nom" => "Hulu", "image" => "hulu.jpg", "description" => "Hulu est un service américain de streaming par abonnement détenu majoritairement par The Walt Disney Company, NBCUniversal de Comcast détenant une participation minoritaire."]
        ]);
    }
}
