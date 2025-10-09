<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\View\View;

/**
 * Controlleur du modèle Calendrier
 * @author Jonathan Carrière
 */
class CalendrierController extends Controller
{
    /**
     * Afficher la page d'accueil du calendrier
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('calendriers.index', [
            'animes' => Anime::all()->sortBy('titre')
        ]);
    }

    /**
     * Afficher un anime dans le calendrier
     * @author Jonathan Carrière
     * @return false|string
     */
    public function afficher(){
        return json_encode(Anime::all());
    }
}
