<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Controlleur du modèle User
 * @author Jonathan Carrière
 */
class UserController extends Controller
{
    /**
     * Liaison entre la politique du modèle et son contrôleur
     * @author Jonathan Carrière
     */
    public function __construct(){
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Afficher l'ensemble des ressources du contrôlleur User
     * @author Jonathan Carrière
     * @return View
     */
    public function index(): View
    {
        return view('users.index', [
            'objets' => User::all()->sortBy('name')
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de création d'un usager
     * @author Jonathan Carrière
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Entreposer un usager dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:'.User::class],
            'password' => 'required|string|min:8',
        ]);
        // Ajouter le nouvel utilisateur dans la base de données
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);
        // Rediriger vers l'index
        return redirect()->route('users.index')->with('message', "L'utilisateur $request->name a été créé avec succès!");
    }

    /**
     * Afficher les détails d'un User spécifique
     * @author Jonathan Carrière
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Afficher la vue contenant le formulaire de modification d'un utilisateur
     * @author Jonathan Carrière
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Modifier un utilisateur dans la base de données
     * @author Jonathan Carrière
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validation des données du formulaire sur le côté serveur (https://laravel.com/docs/5.2/validation#rule-unique)
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:5'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$user->id],
            'password' => 'nullable|min:8',
            'is_admin' => 'required|integer|between:0,1',
            'email_verified_at' => 'required|integer|between:0,1',
        ]);
        // Vérifier si le mot de passe sera modifié
        if ($request->exists('password')) {
            // Vérifier si le courriel va être validé
            if ($request->email_verified_at == 1) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'is_admin' => $request->is_admin,
                    'email_verified_at' => now()
                ]);
            }
            else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'is_admin' => $request->is_admin,
                    'email_verified_at' => null
                ]);
            }
        }
        else {
            // Vérifier si le courriel va être validé
            if ($request->email_verified_at == 1) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $user->password,
                    'is_admin' => $request->is_admin,
                    'email_verified_at' => now()
                ]);
            }
            else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $user->password,
                    'is_admin' => $request->is_admin,
                    'email_verified_at' => null
                ]);
            }
        }
        // Rediriger vers l'index
        return redirect()->route('users.index')->with('message', "L'utilisateur $request->name a été modifié avec succès!");
    }

    /**
     * Supprimer un utilisateur spécifié de la base de données
     * @author Jonathan Carrière
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        // Supprimer l'objet et retourné vers la vue Index
        User::destroy($user->id);
        return redirect()->route("users.index")->with('message', "L'utilisateur $user->name a été supprimé avec succès!");
    }
}
