<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle doubleur avec HasFactory
 * @author Jonathan Carrière
 */
class Doubleur extends Model
{
    use HasFactory;

    /**
     * Propriétés pouvant entre créer via un formulaire
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'image',
        'date_naissance',
        'lieu_naissance',
        'annees_pratique',
    ];

    /**
     * Fonction permettant de trouver les personnages du doubleur
     * @author Jonathan Carrière
     * @return HasMany
     */
    public function personnages(): HasMany
    {
        return $this->hasMany(Personnage::class, 'doubleurs_id');
    }
}
