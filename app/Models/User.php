<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modèle User avec HasFactory
 * @author Jonathan Carrière
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Propriétés pouvant entre créer via un formulaire
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'email_verified_at'
    ];

    /**
     * Propriétés qui sont protégées
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Propriétés pouvant être transformées en d'autres types
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fonction permettant de trouver les critiques de cet utilisateur
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function critiques(): HasMany
    {
        return $this->hasMany(Critique::class, 'user_id');
    }

    /**
     * Fonction permettant de trouver l'ensemble des instances d'horaires de cet utilisateur
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function horaires(): HasMany
    {
        return $this->hasMany(Horaire::class, 'user_id');
    }

    /**
     * Fonction permettant d'obtenir les instances d'horaires d'un utilisateur
     * @author Jonathan Carrière
     * @return BelongsToMany
     */
    public function horaire(): BelongsToMany
    {
        return $this->belongsToMany(Anime::class, "horaires");
    }
}
