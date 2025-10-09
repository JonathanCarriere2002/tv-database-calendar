<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>'{{$critique->titre}}'</h1>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <img src="{{url('/images/animes/'.$critique->anime?->image)}}" class="img-thumbnail" width="385px" alt="Anime {{$critique->anime?->titre}}">
    </div>
    <div class="text-center mb-4">
        <a class="btn btn-light btn-width mt-2" href="{{route('animes.show', $critique->anime?->id)}}">Afficher</a>
        @if (Auth::check() && Auth::user()->id == $critique->user_id)
            <a class="btn btn-light btn-width mt-2" href="{{route('critiques.edit', $critique->id)}}">Modifier</a>
        @endif
        @if (Auth::check() && Auth::user()->id == $critique->user_id || Auth::check() && Auth::user()->is_admin == 1)
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route("critiques.destroy", $critique->id)}}">Supprimer</a>
        @endif
    </div>
    <div>
        <p class="justify mb-4">{{$critique->texte}} (source : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">image</a>)</p>
        <ul>
            <li class="justify mb-3">Anime : {{$critique->anime?->titre}}</li>
            <li class="justify mb-3">Date : {{$critique->date_ecriture}}</li>
            <li class="justify mb-3">Utilisateur : {{$critique->utilisateur?->name}}</li>
        </ul>
    </div>
    <x-modal-suppression route="critiques.destroy" id="{{$critique->id}}" nom="{{$critique->titre}}" typeObjet="la critique"></x-modal-suppression>
</x-app-layout>
