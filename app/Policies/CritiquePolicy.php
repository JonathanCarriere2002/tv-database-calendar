<?php

namespace App\Policies;

use App\Models\Critique;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * Policy pour le modèle Critique
 * @author Jonathan Carrière
 */
class CritiquePolicy
{
    /**
     * Déterminez si l’utilisateur peut afficher des modèles
     * @author Jonathan Carrière
     * @param User|null $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Déterminez si l’utilisateur peut afficher le modèle
     * @author Jonathan Carrière
     * @param User|null $user
     * @param Critique $critique
     * @return bool
     */
    public function view(?User $user, Critique $critique): bool
    {
        return true;
    }

    /**
     * Déterminez si l’utilisateur peut créer des modèles
     * @author Jonathan Carrière
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Déterminer si l’utilisateur peut mettre à jour le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Critique $critique
     * @return bool
     */
    public function update(User $user, Critique $critique): bool
    {
        // Permettre aux utilisateurs connectés d'uniquement modifier leurs critiques
        if($user->id == $critique->utilisateur?->id) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Déterminez si l’utilisateur peut supprimer le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Critique $critique
     * @return bool
     */
    public function delete(User $user, Critique $critique): bool
    {
        // Permettre aux utilisateurs connectés d'uniquement supprimer leurs critiques
        if($user->id == $critique->utilisateur?->id || $user->is_admin === 1) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Déterminez si l’utilisateur peut restaurer le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Critique $critique
     * @return bool
     */
    public function restore(User $user, Critique $critique): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer définitivement le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Critique $critique
     * @return bool
     */
    public function forceDelete(User $user, Critique $critique): bool
    {
        return Gate::allows('isAdmin');
    }
}
