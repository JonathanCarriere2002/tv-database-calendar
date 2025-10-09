<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Critique;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controlleur du modèle Critique
 * @author Jonathan Carrière
 */
class CritiqueController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Critique::class, 'critique');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Critique
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('critiques.index', [
            'objets' => Critique::all()->sortBy('date_ecriture')->toQuery()->paginate(5)
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de création d'une critique
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        // Vérifier si l'utilisateur à vérifier son adresse courriel
        if(Auth::user()->email_verified_at == null){
            return view('auth.verify-email');
        }
        else {
            // Afficher le formulaire de création
            return view('critiques.create', [
                'animes' => Anime::all()->sortBy('titre')
            ]);
        }
    }

    /**
     * Entreposer une critique dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Vérification que l'utilisateur connecté écrit une critique ayant son Id
        $this->validateUserCritique($request);
        // Validation des données du formulaire sur le côté serveur
        $this->validateCritique($request);
        // Ajouter la nouvelle critique dans la base de données
        Critique::create([
            'titre' => $request->titre,
            'anime_id' => $request->anime_id,
            'user_id' => $request->user_id,
            'score' => $request->score,
            'texte' => $request->texte,
            'date_ecriture' => date("Y-m-d H:i"),
        ]);
        // Rediriger vers l'index
        return redirect()->route('critiques.index')->with('message', "La critique '$request->titre' a été créée avec succès!");
    }

    /**
     * Afficher les détails d'une Critique spécifique
     * @author Jonathan Carrière
     * @param Critique $critique
     * @return View
     */
    public function show(Critique $critique): View
    {
        return view('critiques.show', [
            'critique' => $critique
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de modification d'une critique
     * @author Jonathan Carrière
     * @param Critique $critique
     * @return View
     */
    public function edit(Critique $critique): View
    {
        // Vérifier si l'utilisateur à vérifier son adresse courriel
        if(Auth::user()->email_verified_at == null){
            return view('auth.verify-email');
        }
        else {
            // Afficher le formulaire de modification
            return view('critiques.edit', [
                'critique' => $critique,
                'animes' => Anime::all()->sortBy('titre')
            ]);
        }
    }

    /**
     * Modifier une critique dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param Critique $critique
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Critique $critique): RedirectResponse
    {
        // Vérification que l'utilisateur connecté modifie une critique ayant son Id
        $this->validateUserCritique($request);
        // Validation des données du formulaire sur le côté serveur
        $this->validateCritique($request);
        // Mettre à jour la critique dans la base de données
        $critique->update([
            'titre' => $request->titre,
            'anime_id' => $request->anime_id,
            'user_id' => $request->user_id,
            'score' => $request->score,
            'texte' => $request->texte,
            'date_ecriture' => date("Y-m-d H:i")
        ]);
        // Rediriger vers l'index
        return redirect()->route('critiques.index')->with('message', "La critique '$request->titre' a été modifiée avec succès!");
    }

    /**
     * Supprimer un utilisateur spécifié de la base de données
     * @author Jonathan Carrière
     * @param Critique $critique
     * @return RedirectResponse
     */
    public function destroy(Critique $critique): RedirectResponse
    {
        // Vérifier si l'utilisateur à vérifier son adresse courriel
        if(Auth::user()->email_verified_at == null){
            return redirect()->route("verification.notice");
        }
        else {
            // Supprimer l'objet et retourné vers la vue Index
            Critique::destroy($critique->id);
            return redirect()->route("critiques.index")->with('message', "La critique '$critique->titre' a été supprimée avec succès!");
        }
    }

    /**
     * Fonction permettant de valider les propriétés d'une critique à ajouter ou modifier dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return array
     */
    private function validateCritique(Request $request): array {
        return $request->validate([
            'titre' => 'required|string|min:2|max:50',
            'anime_id' => 'required|integer|exists:animes,id',
            'user_id' => 'required|integer|exists:users,id',
            'score' => 'required|integer|between:0,10',
            'texte' => 'required|string|min:10|max:1000',
        ]);
    }

    /**
     * Fonction permettant de valider qu'un utilisateur écrit ou modifie une critique qui lui appartient
     * La vérification pour la suppression se fait à partir de la politique pour le modèle Critique
     * @author Jonathan Carrière
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    private function validateUserCritique(Request $request): void {
        if(Auth::user()->id != $request->user_id){
            throw ValidationException::withMessages(['user_id' => 'Erreur! Identifiant pour utilisateur invalide.']);
        }
    }
}
