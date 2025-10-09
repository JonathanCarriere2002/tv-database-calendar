<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * Policy pour le modèle User
 * @author Jonathan Carrière
 */
class UserPolicy
{
    /**
     * Déterminez si l’utilisateur peut afficher des modèles
     * @author Jonathan Carrière
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut afficher le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut créer des modèles
     * @author Jonathan Carrière
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminer si l’utilisateur peut mettre à jour le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut restaurer le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function restore(User $user, User $model): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer définitivement le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function forceDelete(User $user, User $model): bool
    {
        return Gate::allows('isAdmin');
    }
}
