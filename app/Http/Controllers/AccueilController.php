<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Doubleur;
use App\Models\Personnage;
use Illuminate\View\View;

/**
 * Controlleur de la page d'accueil de l'application
 * @author Jonathan Carrière
 */

class AccueilController extends Controller
{
    /**
     * Afficher la page d'accueil du site
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('accueil.index', [
            'animes' => Anime::all()->sortBy('titre'),
            'animes_carousel' => Anime::inRandomOrder()->limit(6)->get(),
            'doubleurs' => Doubleur::all()->sortBy('nom'),
            'personnages' => Personnage::all()->sortBy('nom')
        ]);
    }
}
