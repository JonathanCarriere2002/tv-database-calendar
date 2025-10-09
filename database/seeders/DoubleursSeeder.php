<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

/**
 * Seeder pour le modèle Doubleur permettant d'ajouter les vraies données de l'application dans la base de données
 * @author Jonathan Carrière
 */
class DoubleursSeeder
{
    public function run(): void
    {
        // Source : Les images des doubleurs proviennent de MyAnimeListe. (https://myanimelist.net/)
        DB::table("doubleurs")->insert([
            ["nom" => "Aoyama", "prenom" => "Yoshino", "image" => "aoyama.jpg", "date_naissance" => "1996-05-15", "lieu_naissance" => "Kumamoto, Japon", "annees_pratique" => 10],
            ["nom" => "Fukuyama", "prenom" => "Jun", "image" => "fukuyama.jpg", "date_naissance" => "1978-11-26", "lieu_naissance" => "Osaka, Japon", "annees_pratique" => 30],
            ["nom" => "Furukawa", "prenom" => "Makoto", "image" => "furukawa.jpg", "date_naissance" => "1989-09-29", "lieu_naissance" => "Kumamoto", "annees_pratique" => 12],
            ["nom" => "Han", "prenom" => "Megumi", "image" => "han.jpg", "date_naissance" => "1989-06-03", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 16],
            ["nom" => "Hanae", "prenom" => "Natsuki", "image" => "hanae.jpg", "date_naissance" => "1991-06-26", "lieu_naissance" => "Kanagawa, Japon", "annees_pratique" => 11],
            ["nom" => "Hidaka", "prenom" => "Rina", "image" => "hidaka.jpg", "date_naissance" => "1994-06-15", "lieu_naissance" => "Chiba, Japon", "annees_pratique" => 15],
            ["nom" => "Ise", "prenom" => "Mariya", "image" => "ise.jpg", "date_naissance" => "1988-09-25", "lieu_naissance" => "Kanagawa, Japon", "annees_pratique" => 18],
            ["nom" => "Ishida", "prenom" => "Akira", "image" => "ishida.jpg", "date_naissance" => "1967-11-02", "lieu_naissance" => "Nisshin, Japon", "annees_pratique" => 35],
            ["nom" => "Ishikawa", "prenom" => "Yui", "image" => "ishikawa.jpg", "date_naissance" => "1989-05-30", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 16],
            ["nom" => "Kaida", "prenom" => "Yuuko", "image" => "kaida.jpg", "date_naissance" => "1980-01-14", "lieu_naissance" => "Kanagawa, Japon", "annees_pratique" => 27],
            ["nom" => "Kamiya", "prenom" => "Hiroshi", "image" => "kamiya.jpg", "date_naissance" => "1975-01-28", "lieu_naissance" => "Matsudo, Japon", "annees_pratique" => 26],
            ["nom" => "Kitou", "prenom" => "Akari", "image" => "kitou.jpg", "date_naissance" => "1994-10-16", "lieu_naissance" => "Aichi, Japon", "annees_pratique" => 9],
            ["nom" => "Kusunoki", "prenom" => "Tomori", "image" => "kusunoki.jpg", "date_naissance" => "1999-12-22", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 6],
            ["nom" => "Minase", "prenom" => "Inori", "image" => "minase.jpg", "date_naissance" => "1995-12-02", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 13],
            ["nom" => "Miyano", "prenom" => "Mamoru", "image" => "miyamo.jpg", "date_naissance" => "1983-06-08", "lieu_naissance" => "Saitama, Japon", "annees_pratique" => 25],
            ["nom" => "Murakawa", "prenom" => "Rie", "image" => "murakawa.jpg", "date_naissance" => "1990-06-01", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 14],
            ["nom" => "Nakamura", "prenom" => "Yuuichi", "image" => "nakamura.jpg", "date_naissance" => "1980-02-20", "lieu_naissance" => "Kagawa, Japon", "annees_pratique" => 25],
            ["nom" => "Ono", "prenom" => "Daisuke", "image" => "ono.jpg", "date_naissance" => "1978-05-04", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 30],
            ["nom" => "Seto", "prenom" => "Asami", "image" => "seto.jpg", "date_naissance" => "1993-04-02", "lieu_naissance" => "Saitama, Japon", "annees_pratique" => 12],
            ["nom" => "Sugita", "prenom" => "Tomokazu", "image" => "sugita.jpg", "date_naissance" => "1980-10-11", "lieu_naissance" => "Saitama, Japon", "annees_pratique" => 27],
            ["nom" => "Takahashi", "prenom" => "Rie", "image" => "takahashi.jpg", "date_naissance" => "1994-02-27", "lieu_naissance" => "Saitama, Japon", "annees_pratique" => 11],
            ["nom" => "Toya", "prenom" => "Kikunosuke", "image" => "toya.jpg", "date_naissance" => "1998-11-30", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 1],
            ["nom" => "Uchida", "prenom" => "Maaya", "image" => "uchida.jpg", "date_naissance" => "1989-12-27", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 13],
            ["nom" => "Yukana", "prenom" => "Nogami", "image" => "yukuna.jpg", "date_naissance" => "1975-01-06", "lieu_naissance" => "Tokyo, Japon", "annees_pratique" => 30]
        ]);
    }
}
