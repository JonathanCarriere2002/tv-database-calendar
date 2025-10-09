<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Horaire;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controlleur du modèle Horaire
 * @author Jonathan Carrière
 */
class HoraireController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Horaire::class, 'horaire');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Horaire
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()?->horaires->isEmpty() !== true) {
            return view('horaires.index', [
                'objets' => Horaire::all(),
                'animes' => Anime::all()->sortBy('titre'),
                'animesUser' => Auth::user()?->horaires->sortBy('anime_id')
            ]);
        }
        else {
            return view('horaires.index', [
                'objets' => Horaire::all(),
                'animes' => Anime::all()->sortBy('titre')
            ]);
        }
    }

    /**
     * Entreposer une instance d'horaire (un anime dont un utilisateur ajoute à son horaire) dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Vérification que l'utilisateur connecté ajoute dans son horaire
        if(Auth::user()->id != $request->user_id){
            throw ValidationException::withMessages(['user_id' => 'Erreur! Identifiant pour utilisateur invalide.']);
        }
        // Vérification que l'anime n'est pas déjà dans l'horaire de l'utilisateur (https://stackoverflow.com/questions/27095090/laravel-checking-if-a-record-exists)
        $horaire = Horaire::where([['anime_id', '=', $request->anime_id], ['user_id', '=', $request->user_id]])->first();
        if ($horaire === null) {
            // Validation des données du formulaire sur le côté serveur
            $request->validate([
                'anime_id' => 'required|integer|exists:animes,id',
                'user_id' => 'required|integer|exists:users,id',
            ]);
            // Ajouter la nouvelle critique dans la base de données
            Horaire::create([
                'anime_id' => $request->anime_id,
                'user_id' => $request->user_id,
            ]);
            // Obtenir le titre de l'anime
            $anime = Anime::find($request->anime_id);
            // Rediriger vers l'index
            return redirect()->route('horaires.index')->with('message', "L'anime $anime->titre a été ajouté à votre horaire avec succès!");
        }
        // Erreur si l'anime est déjà dans l'horaire
        else {
            throw ValidationException::withMessages(['anime_id' => 'Erreur! Cet anime est déjà à votre horaire.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @author Jonathan Carrière
     * @param Horaire $horaire
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function destroy(Horaire $horaire): RedirectResponse
    {
        // Vérification que l'utilisateur connecté supprime dans son horaire
        if(Auth::user()->id != $horaire->user_id){
            throw ValidationException::withMessages(['user_id' => 'Erreur! Identifiant pour utilisateur invalide.']);
        }
        // Supprimer l'anime de l'horaire de l'utilisateur
        Horaire::destroy($horaire->id);
        $titre = $horaire->anime?->titre;
        return redirect()->route("horaires.index")->with('message', "L'anime $titre a été supprimé de votre horaire avec succès!");
    }

    /**
     * Fonction permettant d'afficher un anime dans l'horaire d'un utilisateur
     * @author Jonathan Carrière
     * @return false|string
     */
    public function afficher(){
        $animes = User::find(Auth::user()->id)->horaire;
        foreach ($animes as $anime) {
            $lstAnimes[] = $anime;
        }
        return json_encode($lstAnimes);
    }
}
