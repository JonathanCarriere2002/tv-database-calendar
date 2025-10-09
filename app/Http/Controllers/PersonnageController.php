<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Doubleur;
use App\Models\Personnage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controlleur du modèle Personnage
 * @author Jonathan Carrière
 */
class PersonnageController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Personnage::class, 'personnage');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Personnage
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('personnages.index', [
            'objets' => Personnage::all()->sortBy('nom')->toQuery()->paginate(12)
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de création d'un personnage
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        return view('personnages.create', [
            'animes' => Anime::all()->sortBy('titre'),
            'doubleurs' => Doubleur::all()->sortBy('nom'),
        ]);
    }

    /**
     * Entreposer un personnage dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur
        $request->validate([
            'nom' => 'required|string|min:2|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'description' => 'required|string|min:10|max:500',
            'anime_id' => 'required|integer|exists:animes,id',
            'doubleurs_id' => 'required|integer|exists:doubleurs,id',
        ]);
        // Ajouter l'image téléversée dans le répertoire approprié
        // Source: https://www.w3docs.com/snippets/php/how-to-upload-files-in-laravel-directly-into-public-folder.html#:~:text=To%20upload%20files%20directly%20into,ext')%3B
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/personnages'), $imageName);
        // Ajouter le nouvel anime dans la base de données
        Personnage::create([
            'nom' => $request->nom,
            'image' => $imageName,
            'description' => $request->description,
            'anime_id' => $request->anime_id,
            'doubleurs_id' => $request->doubleurs_id,
        ]);
        // Rediriger vers l'index
        return redirect()->route('personnages.index')->with('message', "Le personnage $request->nom a été créé avec succès!");
    }

    /**
     * Afficher les détails d'un Personnage spécifique
     * @author Jonathan Carrière
     * @param Personnage $personnage
     * @return View
     */
    public function show(Personnage $personnage): View
    {
        return view('personnages.show', [
            'personnage' => $personnage
        ]);
    }

    /**
     * Afficher le formulaire permettant de modifier un personnage
     * @author Jonathan Carrière
     * @param Personnage $personnage
     * @return View
     */
    public function edit(Personnage $personnage): View
    {
        return View("personnages.edit", [
            "personnage" => $personnage,
            'animes' => Anime::all()->sortBy('titre'),
            'doubleurs' => Doubleur::all()->sortBy('nom'),
        ]);

    }

    /**
     * Mettre à jour un personnage dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param Personnage $personnage
     * @return RedirectResponse
     */
    public function update(Request $request, Personnage $personnage): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|min:2|max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'description' => 'required|string|min:10|max:500',
            'anime_id' => 'required|integer|exists:animes,id',
            'doubleurs_id' => 'required|integer|exists:doubleurs,id',
        ]);
        if ($request->exists('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/personnages'), $imageName);

            $personnage->update([
                "nom" => $request->nom,
                "image" => $imageName,
                "description" => $request->description,
                'anime_id' => $request->anime_id,
                'doubleurs_id' => $request->doubleurs_id
            ]);
        }
        else{
            $personnage->update([
                "nom" => $request->nom,
                "image" => $personnage->image,
                "description" => $request->description,
                'anime_id' => $request->anime_id,
                'doubleurs_id' => $request->doubleurs_id
            ]);
        }
        return redirect()->route("personnages.show", $personnage->id)->with('message', "Le personnage $request->nom a été modifié avec succès!");
    }

    /**
     * Supprimer un personnage spécifié de la base de données
     * @author Jonathan Carrière
     * @param Personnage $personnage
     * @return RedirectResponse
     */
    public function destroy(Personnage $personnage): RedirectResponse
    {
        // Supprimer l'objet et retourné vers la vue Index
        Personnage::destroy($personnage->id);
        return redirect()->route("personnages.index")->with('message', "Le personnage $personnage->nom a été supprimé avec succès!");
    }
}
