<?php

namespace App\Http\Controllers;

use App\Models\Doubleur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlleur du modèle Doubleur
 * @author Jonathan Carrière
 */
class DoubleurController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(Doubleur::class, 'doubleur');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur Doubleur
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('doubleurs.index', [
            'objets' => Doubleur::all()->sortBy('nom')->toQuery()->paginate(12)
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de création d'un doubleur
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        return view('doubleurs.create');
    }

    /**
     * Entreposer un doubleur dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur
        $request->validate([
            'nom' => 'required|string|min:2|max:50',
            'prenom' => 'required|string|min:2|max:50',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'date_naissance' => 'required|date|before:today',
            'lieu_naissance' => 'required|string|min:2|max:50',
            'annees_pratique' => 'required|integer|between:1,50',
        ],[
            'date_naissance.before' => "La date de naissance doit être antérieure à la date d'aujourd'hui."
        ]);
        // Ajouter l'image téléversée dans le répertoire approprié
        // Source: https://www.w3docs.com/snippets/php/how-to-upload-files-in-laravel-directly-into-public-folder.html#:~:text=To%20upload%20files%20directly%20into,ext')%3B
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/doubleurs'), $imageName);
        // Ajouter le nouvel anime dans la base de données
        Doubleur::create([
            'nom' => $request->nom,
            'image' => $imageName,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'annees_pratique' => $request->annees_pratique,
        ]);
        // Rediriger vers l'index
        return redirect()->route('doubleurs.index')->with('message', "Le doubleur $request->nom, $request->prenom a été créé avec succès!");
    }

    /**
     * Afficher les détails d'un Doubleur spécifique
     * @author Jonathan Carrière
     * @param Doubleur $doubleur
     * @return View
     */
    public function show(Doubleur $doubleur): View
    {
        return view('doubleurs.show', [
            'doubleur' => $doubleur
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de modification d'un doubleur
     * @author Jonathan Carrière
     * @param Doubleur $doubleur
     * @return View
     */
    public function edit(Doubleur $doubleur): View
    {
        return View("doubleurs.edit", [
            "doubleur" => $doubleur
        ]);
    }

    /**
     * Mettre à jour le Doubleur dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param Doubleur $doubleur
     * @return RedirectResponse
     */
    public function update(Request $request, Doubleur $doubleur): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|min:2|max:50',
            'prenom' => 'required|string|min:2|max:50',
            'image' => 'mimes:jpeg,png,jpg|max:5000',
            'date_naissance' => 'required|date|before:today',
            'lieu_naissance' => 'required|string|min:2|max:50',
            'annees_pratique' => 'required|integer|between:1,50',
        ],[
            'date_naissance.before' => "La date de naissance doit être antérieure à la date d'aujourd'hui."
        ]);
        if ($request->exists("image")) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images/doubleurs'), $imageName);

            $doubleur->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'image' => $imageName,
                'date_naissance' => $request->date_naissance,
                'lieu_naissance' => $request->lieu_naissance,
                'annees_pratique' => $request->annees_pratique,
            ]);
        } else {
            $doubleur->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'image' => $doubleur->image,
                'date_naissance' => $request->date_naissance,
                'lieu_naissance' => $request->lieu_naissance,
                'annees_pratique' => $request->annees_pratique,
            ]);
        }
        return redirect()->route("doubleurs.index")->with('message', "Le doubleur $request->nom, $request->prenom a été modifié avec succès!");
    }

    /**
     * Supprimer un doubleur spécifié de la base de données
     * @author Jonathan Carrière
     * @param Doubleur $doubleur
     * @return RedirectResponse
     */
    public function destroy(Doubleur $doubleur): RedirectResponse
    {
        // Supprimer l'objet et retourné vers la vue Index
        Doubleur::destroy($doubleur->id);
        return redirect()->route("doubleurs.index")->with('message', "Le doubleur $doubleur->nom, $doubleur->prenom a été supprimé avec succès!");
    }
}
