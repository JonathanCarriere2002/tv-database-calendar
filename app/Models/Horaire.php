<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modèle Horaire avec HasFactory
 * @author Jonathan Carrière
 */
class Horaire extends Model
{
    use HasFactory;

    /**
     * Propriétés pouvant entre créer via un formulaire
     * @author Jonathan Carrière
     * @var string[]
     */
    protected $fillable = [
        'anime_id',
        'user_id',
    ];

    /**
     * Fonction permettant de trouver l'anime de cette instance d'horaire
     * @author Jonathan Carrière
     * @return BelongsTo
     */
    public function anime(): BelongsTo
    {
        return $this->belongsTo(Anime::class, 'anime_id');
    }

    /**
     * Fonction permettant de trouver l'utilisateur de cette instance d'horaire
     * @author Jonathan Carrière
     * @return BelongsTo
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
