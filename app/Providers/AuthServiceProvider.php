<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Liste des politiques pour l'application
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $policies = [
        'App\Models\Anime' => 'App\Policies\AnimePolicy',
        'App\Models\Doubleur' => 'App\Policies\DoubleurPolicy',
        'App\Models\Personnage' => 'App\Policies\PersonnagePolicy',
        'App\Models\Plateforme' => 'App\Policies\PlateformePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Critique' => 'App\Policies\CritiquePolicy',
        'App\Models\Horaire' => 'App\Policies\HorairePolicy',
    ];

    /**
     * Gate permettant de vérifier qu'un utilisateur est un admin
     * @author Jonathan Carrière
     */
    public function boot(): void
    {
        // Gate permettant de savoir si un utilisateur est un administrateur
        Gate::define("isAdmin", function (User $user){
            return $user->is_admin;
        });
    }
}
