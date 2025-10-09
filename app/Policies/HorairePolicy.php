<?php

namespace App\Policies;

use App\Models\Horaire;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * Policy pour le modèle Horaire
 * @author Jonathan Carrière
 */
class HorairePolicy
{
    /**
     * Déterminez si l’utilisateur peut afficher des modèles
     * @author Jonathan Carrière
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Déterminez si l’utilisateur peut afficher le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Horaire $horaire
     * @return bool
     */
    public function view(User $user, Horaire $horaire): bool
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
     * @param Horaire $horaire
     * @return bool
     */
    public function update(User $user, Horaire $horaire): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Horaire $horaire
     * @return bool
     */
    public function delete(User $user, Horaire $horaire): bool
    {
        // Permettre aux utilisateurs connectés d'uniquement supprimer leurs instances d'horaires
        if($user->id == $horaire->utilisateur?->id) {
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
     * @param Horaire $horaire
     * @return bool
     */
    public function restore(User $user, Horaire $horaire): bool
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Déterminez si l’utilisateur peut supprimer définitivement le modèle
     * @author Jonathan Carrière
     * @param User $user
     * @param Horaire $horaire
     * @return bool
     */
    public function forceDelete(User $user, Horaire $horaire): bool
    {
        return Gate::allows('isAdmin');
    }
}
