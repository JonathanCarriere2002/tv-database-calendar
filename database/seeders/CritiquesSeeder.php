<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

/**
 * Seeder pour le modèle Critique permettant d'ajouter les vraies données de l'application dans la base de données
 * @author Jonathan Carrière
 */
class CritiquesSeeder
{
    public function run(): void
    {
        DB::table("critiques")->insert([
            ["anime_id" => 11, "user_id" => 1, "titre" => "Gintama est le meilleur anime", "texte" => "Gintama est un des animes avec le meilleur score selon plusieurs sources pour une raison. Aucune autre émission mélange aussi parfaitement l’action et la comédie ensemble. Avec Gintama, on ne sait jamais à quoi s’attendre. Autant de moments ridiculement absurdes s’y trouve que de moments sérieux remplis d’action.", "score" => 10, "date_ecriture" => "2023-01-23"],
            ["anime_id" => 33, "user_id" => 2, "titre" => "J'adore The Rising of the Shield Hero", "texte" => "Shield Hero est mon anime préférer de tous les temps sans aucun doute. J’adore les dynamiques entre les personnages. De plus, l’histoire illustre un monde fantastique plus sombre qu’un anime typique de ce genre, ce que je trouve rafraichissant.", "score" => 10,  "date_ecriture" => "2023-01-23"],
            ["anime_id" => 7, "user_id" => 1, "titre" => "Code Geass est simplement excellent", "texte" => "Code Geass est un anime qui nécessite aucune introduction. L’histoire de la révolution de Lelouch est rempli des péripéties captivantes et de personnages mémorables. Les combats entre les Knightmares, soit des robots géants, sont parmi les meilleurs des animes du genre Mecha.", "score" => 9,  "date_ecriture" => "2023-02-12"],
            ["anime_id" => 3, "user_id" => 2, "titre" => "Bocchi the Rock! était très amusant", "texte" => "Bocchi the Rock m’a grandement surpris. Je ne m’attendais pas à ce qu’un anime avec un synopsis aussi simple soit rempli d’autant de moments mémorables. J’ai apprécié les moments qui illustraient la vie quotidienne de Bocchi ainsi que la musique excellente.", "score" => 8,  "date_ecriture" => "2023-02-24"],
            ["anime_id" => 13, "user_id" => 4, "titre" => "J'ai aimé Hunter x Hunter", "texte" => "Je ne savais pas trop à quoi m’attendre avec Hunter x Hunter, mais j’ai été surpris. Le monde unique m’a immédiatement captivé et le personnage de Gon correspond à un protagoniste intéressant. Cependant, j’ai trouvé que le rythme de l’histoire pouvait varier trop souvent.", "score" => 7,  "date_ecriture" => "2023-03-03"],
            ["anime_id" => 24, "user_id" => 8, "titre" => "Persona 4: bon anime, mauvaise adaptation", "texte" => "Je suis un très grand fan du jeu Persona 4 : Golden donc j’ai immédiatement regardé l’anime. Cependant, j’ai été déçu par ce-dernier. En effet, l’histoire de Persona 4 Golden : The Animation ignore ou simplifie des scènes très importantes du jeu, ce qui donne une expérience manquant en contenu.", "score" => 4,  "date_ecriture" => "2023-03-14"],
            ["anime_id" => 5, "user_id" => 6, "titre" => "Chainsaw Man est un des meilleurs anime de 2022", "texte" => "Sans aucun doute, Chainsaw Man est la meilleure nouvelle parution en 2022 pour les animes. La qualité de l’animation est facilement parmi les meilleures puisque chaque image contient une panoplie de détails. Le monde infesté de démons et les personnages qui les chassent sont ce qui distingue cet anime du restant.", "score" => 9,  "date_ecriture" => "2023-03-18"],
            ["anime_id" => 21, "user_id" => 10, "titre" => "Nier: Automata Ver1.1a est bien", "texte" => "Nier : Automata Ver1.1a est une bonne adaptation d’un des meilleurs jeux de la dernière décennie. La qualité de l’animation fut très belle et les personnages étaient aussi captivant que dans le jeu. Cependant, je trouve que cet anime aurait dû avoir plus d’épisodes pour mieux adapter l’histoire originale.", "score" => 7,  "date_ecriture" => "2023-04-02"],
            ["anime_id" => 33, "user_id" => 7, "titre" => "J'ai trouvé The Rising of the Shield Hero correct", "texte" => "Je n’ai pas aimé Shield Hero ni détesté cet anime. En effet, je trouve que le début de l’histoire était rempli de promesse, mais que le rythme des évènements a très rapidement arrêté. Je me suis ennuyé à quelques moments, mais les parties intéressantes étaient quand même bonnes.", "score" => 5,  "date_ecriture" => "2023-04-04"],
            ["anime_id" => 11, "user_id" => 5, "titre" => "Gintama fut très bon", "texte" => "J’ai décidé de donner Gintama une chance et cet anime m’a surpris. Je toujours vu que cet anime avait des scores excellents sur plusieurs sites de revues d’émissions, mais je ne savais pas pourquoi. Les parodies présentes dans Gintama m’ont toujours fait rire. Cependant, j’ai trouvé les premières 25 épisodes très lentes.", "score" => 7,  "date_ecriture" => "2023-04-10"]
        ]);
    }
}
