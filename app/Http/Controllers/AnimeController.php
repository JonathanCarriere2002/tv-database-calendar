<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlleur du modèle Anime
 * @author Jonathan Carrière
 */
class AnimeController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Anime::class, 'anime');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Anime
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('animes.index', [
            'objets' => Anime::all()->sortBy('titre')->toQuery()->paginate(12)
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de création d'un anime
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        return view('animes.create', [
            'genres' => $this->getGenreListe()
        ]);
    }

    /**
     * Entreposer un anime dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur
        $request->validate([
            'titre' => 'required|string|min:2|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'genre' => 'required|string|min:2|max:50|in:Action,Aventure,Comédie,Drame,Mecha,Romance,Seinen,Shonen,Slice of Life',
            'description' => 'required|string|min:10|max:500',
            'studio' => 'required|string|min:2|max:50',
            'saisons' => 'required|integer|between:1,50',
            'episodes' => 'required|integer|between:1,1000',
            'duree_episode' => 'required|integer|between:1,60',
            'date_debut' => 'required|date',
        ]);
        // Ajouter l'image téléversée dans le répertoire approprié
        // Source: https://www.w3docs.com/snippets/php/how-to-upload-files-in-laravel-directly-into-public-folder.html#:~:text=To%20upload%20files%20directly%20into,ext')%3B
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/animes'), $imageName);
        // Ajouter le nouvel anime dans la base de données
        Anime::create([
            'titre' => $request->titre,
            'image' => $imageName,
            'genre' => $request->genre,
            'description' => $request->description,
            'studio' => $request->studio,
            'saisons' => $request->saisons,
            'episodes' => $request->episodes,
            'duree_episode' => $request->duree_episode,
            'date_debut' => $request->date_debut,
        ]);
        // Rediriger vers l'index
        return redirect()->route('animes.index')->with('message', "L'anime $request->titre a été créé avec succès!");
    }

    /**
     * Afficher les détails d'un Anime spécifique
     * @author Jonathan Carrière
     * @param Anime $anime
     * @return View
     */
    public function show(Anime $anime): View
    {
        return view('animes.show', [
            'anime' => $anime
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de modification d'un anime
     * @author Jonathan Carrière
     * @param Anime $anime
     * @return View
     */
    public function edit(Anime $anime): View
    {
        return view('animes.edit', [
            'anime' => $anime,
            'genres' => $this->getGenreListe()
        ]);
    }

    /**
     * Modifier un anime dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function update(Request $request, Anime $anime): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur
        $request->validate([
            'titre' => 'required|string|min:2|max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'genre' => 'required|string|min:2|max:50|in:Action,Aventure,Comédie,Drame,Mecha,Romance,Seinen,Shonen,Slice of Life',
            'description' => 'required|string|min:10|max:500',
            'studio' => 'required|string|min:2|max:50',
            'saisons' => 'required|integer|between:1,50',
            'episodes' => 'required|integer|between:1,1000',
            'duree_episode' => 'required|integer|between:1,60',
            'date_debut' => 'required|date',
        ]);
        // Si la demande de modification comprend la modification de l'image
        if ($request->exists('image')) {
            // Ajouter l'image téléversée dans le répertoire approprié si l'utilisateur a choisi de mettre à jour l'image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/animes'), $imageName);
            // Mettre à jour l'anime dans la base de données
            $anime->update([
                'titre' => $request->titre,
                'image' => $imageName,
                'genre' => $request->genre,
                'description' => $request->description,
                'studio' => $request->studio,
                'saisons' => $request->saisons,
                'episodes' => $request->episodes,
                'duree_episode' => $request->duree_episode,
                'date_debut' => $request->date_debut,
            ]);
        }
        else {
            // Mettre à jour l'anime dans la base de données
            $anime->update([
                'titre' => $request->titre,
                'image' => $anime->image,
                'genre' => $request->genre,
                'description' => $request->description,
                'studio' => $request->studio,
                'saisons' => $request->saisons,
                'episodes' => $request->episodes,
                'duree_episode' => $request->duree_episode,
                'date_debut' => $request->date_debut,
            ]);
        }
        // Rediriger vers l'index
        return redirect()->route('animes.index')->with('message', "L'anime $request->titre a été modifié avec succès!");
    }

    /**
     * Supprimer un anime spécifié de la base de données
     * @author Jonathan Carrière
     * @param Anime $anime
     * @return RedirectResponse
     */
    public function destroy(Anime $anime): RedirectResponse
    {
        // Supprimer l'objet et retourné vers la vue Index
        Anime::destroy($anime->id);
        return redirect()->route("animes.index")->with('message', "L'anime $anime->titre a été supprimé avec succès!");
    }

    /**
     * Fonction permettant d'obtenir la liste des genres qui sera affichée dans le select des formulaires pour les animes
     * @author Jonathan Carrière
     * @return string[]
     */
    private function getGenreListe(): array
    {
        return array("Action", "Aventure", "Comédie", "Drame", "Mecha", "Romance", "Seinen", "Shonen", "Slice of Life");
    }
}
