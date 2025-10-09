<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ModalSuppression extends Component
{
    /**
     * Constructeur pour le modal de suppression permettant de passer les données de l'objet à supprimer en paramètres
     * Source : https://getbootstrap.com/docs/4.0/components/modal/
     * @author Jonathan Carrière
     */
    public function __construct(public string $route, public int $id, public string $nom, public string $typeObjet, public int $idSupplementaire = 0)
    {
        // Aucun code est nécéssaire dans le constructeur
    }

    /**
     * Afficher le modal permettant de supprimer un modèle Eloquent
     * @author Jonathan Carrière
     */
    public function render(): View
    {
        return view('components.modal-suppression');
    }
}
