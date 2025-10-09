<?php

namespace App\Policies;

use App\Models\Plateforme;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * Policy pour le modèle Plateforme
 * @author Jonathan
 */
class PlateformePolicy
{
    /**
     * Déterminez si l’utilisateur peut afficher des modèles
     * @author Jonathan
     * @param User|null $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Déterminez si l’utilisateur peut afficher le modèle
     * @author Jonathan
     * @param User|null $user
     * @param Plateforme $plateforme
     * @return bool
     */
    public function view(?User $user, Plateforme $plateforme): bool
    {
        return true;
    }

    /**
     * Déterminez si l’utilisateur peut créer des modèles
     * @author Jonathan
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminer si l’utilisateur peut mettre à jour le modèle
     * @author Jonathan
     * @param User $user
     * @param Plateforme $plateforme
     * @return bool
     */
    public function update(User $user, Plateforme $plateforme): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer le modèle
     * @author Jonathan
     * @param User $user
     * @param Plateforme $plateforme
     * @return bool
     */
    public function delete(User $user, Plateforme $plateforme): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut restaurer le modèle
     * @author Jonathan
     * @param User $user
     * @param Plateforme $plateforme
     * @return bool
     */
    public function restore(User $user, Plateforme $plateforme): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer définitivement le modèle
     * @author Jonathan
     * @param User $user
     * @param Plateforme $plateforme
     * @return bool
     */
    public function forceDelete(User $user, Plateforme $plateforme): bool
    {
        return Gate::allows('isAdmin');
    }
}
