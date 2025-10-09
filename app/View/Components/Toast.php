<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Toast extends Component
{
    /**
     * Constructeur pour le message toast permettant d'afficher un message de confirmation suite à un ajout, une modification ou une suppression
     * Source : https://getbootstrap.com/docs/5.0/components/toasts/
     * @author Jonathan Carrière
     */
    public function __construct(public string $message)
    {
        // Aucun code est nécéssaire dans le constructeur
    }

    /**
     * Afficher le toast permettant de confirmer un ajout, une modification ou une suppression
     * @author Jonathan Carrière
     */
    public function render(): View
    {
        return view('components.toast');
    }
}
