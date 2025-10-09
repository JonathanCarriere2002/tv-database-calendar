<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle Anime avec HasFactory
 * @author Jonathan Carrière
 */
class Anime extends Model
{
    use HasFactory;

    /**
     * Propriétés pouvant entre créer via un formulaire
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $fillable = [
        'titre',
        'image',
        'genre',
        'description',
        'studio',
        'saisons',
        'episodes',
        'date_debut',
        'duree_episode',
    ];

    /**
     * Propriétés pouvant être transformées en d'autres types
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $casts = [
        'date_debut'=>'datetime'
    ];

    /**
     * Fonction permettant de trouver les critiques de cet anime
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function critiques(): HasMany
    {
        return $this->hasMany(Critique::class, 'anime_id');
    }

    /**
     * Fonction permettant de trouver l'ensemble des instances d'horaires de cet anime
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function horaires(): HasMany
    {
        return $this->hasMany(Horaire::class, 'anime_id');
    }

    /**
     * Fonction permettant de trouver les personnages de cet anime
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function personnages(): HasMany
    {
        return $this->hasMany(Personnage::class, 'anime_id');
    }

    /**
     * Fonction permettant de trouver les plateformes de cet anime
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function plateformes(): HasMany
    {
        return $this->hasMany(PlateformesAnime::class, 'anime_id');
    }

    /**
     * Fonction permettant d'obtenir les instances d'horaire pour un anime
     * @author Jonathan Carrière
     * @return BelongsToMany
     */
    public function horaire(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "horaires");
    }
}
