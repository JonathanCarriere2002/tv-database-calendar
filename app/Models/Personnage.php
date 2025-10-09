<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modèle Personnage avec HasFactory
 * @author Jonathan Carrière
 */
class Personnage extends Model
{
    use HasFactory;

    /**
     * Propriétés pouvant entre créer via un formulaire
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'image',
        'description',
        'anime_id',
        'doubleurs_id'
    ];

    /**
     * Fonction permettant de trouver l'anime de ce personnage
     * @author Jonathan Carrière
     * @return BelongsTo
     */
    public function anime(): BelongsTo
    {
        return $this->belongsTo(Anime::class, 'anime_id');
    }

    /**
     * Fonction permettant de trouver le doubleur de ce personnage
     * @author Jonathan Carrière
     * @return BelongsTo
     */
    public function doubleur(): BelongsTo
    {
        return $this->belongsTo(Doubleur::class, 'doubleurs_id');
    }
}
