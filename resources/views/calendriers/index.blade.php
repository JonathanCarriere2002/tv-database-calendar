<!--@author Jonathan Carrière-->
<x-app-layout>
    @vite('resources/js/calendrier_script.js')
    <h1 class="text-center mt-4 mb-4">Calendrier</h1>
    <p class="justify mb-2">Cette page contient un calendrier permettant d’afficher les dates de diffusion pour l’ensemble
        des animes disponibles sur AniListe. Vous pouvez avancer ou reculer le calendrier afin de visionner des émissions
        qui ont été diffuser dans le passé ainsi que le futur. De plus, vous pouvez appuyer sur un anime dans le calendrier
        pour afficher ses détails.</p>
    <div id="spinner" class="d-flex align-items-center mb-3 mt-4">
        <h2><strong>Chargement du calendrier...</strong></h2>
        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
    </div>
    <div class="mb-3" id='calendar'></div>
</x-app-layout>
