<?php

namespace App\Http\Controllers;

use App\Models\Plateforme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlleur du modèle Plateformes
 * @author Jonathan Carrière
 */
class PlateformeController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Plateforme::class, 'plateforme');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Plateforme
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view("plateformes.index", [
            'objets' => Plateforme::all()->sortBy('nom')
        ]);
    }

    /**
     * Afficher le formulaire permettant de créer une plateforme
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        return view('plateformes.create');
    }

    /**
     * Afficher la vue contenant le formulaire de création d'une plateforme
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
        ]);
        // Ajouter l'image téléversée dans le répertoire approprié
        // Source: https://www.w3docs.com/snippets/php/how-to-upload-files-in-laravel-directly-into-public-folder.html#:~:text=To%20upload%20files%20directly%20into,ext')%3B
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/plateformes'), $imageName);
        // Ajouter le nouvel anime dans la base de données
        Plateforme::create([
            'nom' => $request->nom,
            'image' => $imageName,
            'description' => $request->description,
        ]);
        // Rediriger vers l'index
        return redirect()->route('plateformes.index')->with('message', "La plateforme $request->nom a été créée avec succès!");
    }

    /**
     * Afficher les détails d'une Plateforme spécifique
     * @author Jonathan Carrière
     * @param Plateforme $plateforme
     * @return View
     */
    public function show(Plateforme $plateforme): View
    {
        if($plateforme?->animes->isEmpty() !== true) {
            return view('plateformes.show', [
                'plateforme' => $plateforme,
                'plateformeAnimes' => $plateforme?->animes->sortBy('titre')->toQuery()->paginate(12)
            ]);
        }
        else{
            return view('plateformes.show', [
                'plateforme' => $plateforme
            ]);
        }
    }

    /**
     * Affiche la vue de modification de plateforme
     * @author Jonathan Carrière
     * @param Plateforme $plateforme
     * @return View
     */
    public function edit(Plateforme $plateforme): View
    {
        return View("plateformes.edit", [
            "plateforme" => $plateforme
        ]);
    }

    /**
     * Modifier une plateforme dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param Plateforme $plateforme
     * @return RedirectResponse
     */
    public function update(Request $request, Plateforme $plateforme): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|min:2|max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'description' => 'required|string|min:10|max:500',
        ]);
        //Vérification de l'image
        if ($request->exists('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/plateformes'), $imageName);

            $plateforme->update([
                "nom" => $request->nom,
                "image" => $imageName,
                "description" => $request->description
            ]);
        }
        else{
            $plateforme->update([
                "nom" => $request->nom,
                "image" => $plateforme->image,
                "description" => $request->description
            ]);
        }
        return redirect()->route("plateformes.index")->with('message', "La plateforme $request->nom a été modifiée avec succès!");
    }

    /**
     * Supprimer une plateforme spécifiée de la base de données
     * @author Jonathan Carrière
     * @param Plateforme $plateforme
     * @return RedirectResponse
     */
    public function destroy(Plateforme $plateforme): RedirectResponse
    {
        // Supprimer l'objet et retourner vers la vue Index
        Plateforme::destroy($plateforme->id);
        return redirect()->route("plateformes.index")->with('message', "La plateforme $plateforme->nom a été supprimée avec succès!");
    }
}
