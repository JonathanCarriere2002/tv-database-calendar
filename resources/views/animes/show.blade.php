<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>{{$anime->titre}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <img src="{{url('/images/animes/'.$anime->image)}}" class="img-thumbnail" width="385px" alt="Anime {{$anime->titre}}">
    </div>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a class="btn btn-light btn-width mt-2" href="{{route('animes.edit', $anime->id)}}">Modifier</a>
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route('animes.destroy', $anime->id)}}">Supprimer</a>
        </div>
    @endcan
    <div>
        <p class="justify mb-5">{{$anime->description}} (sources : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">description</a>,
            <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">image</a>)</p>
    </div>
    <div>
        <p class="justify mb-5">Cet anime a été réalisé par le studio d'animation {{$anime->studio}} et a vu son premier épisode paraitre le
            {{$anime->date_debut->format('Y-m-d')}}. {{$anime->titre}} est un anime du genre {{$anime->genre}} ayant un total de {{$anime->saisons}}
            saison(s) ainsi que {{$anime->episodes}} épisode(s).</p>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <h2 class="text-center mb-2">Critiques</h2>
            @if($anime?->critiques->isEmpty())
                <p class="custom-font-size2 mb-1 text-center italic">Cet anime ne possède pas de critiques...</p>
            @endif
            <ul>
                @foreach($anime?->critiques as $critique)
                    <li class="custom-font-size2 mb-1"><a class="custom-link" href="{{route('critiques.show', $critique->id)}}">{{$critique->titre}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 mb-3">
            <h2 class="text-center mb-2">Personnages</h2>
            @if($anime?->personnages->isEmpty())
                <p class="custom-font-size2 mb-1 text-center italic">Cet anime ne possède pas de personnages...</p>
            @endif
            <ul>
                @foreach($anime?->personnages as $personnage)
                    <li class="custom-font-size2 mb-1"><a class="custom-link" href="{{route('personnages.show', $personnage->id)}}">{{$personnage->nom}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 mb-3">
            <h2 class="text-center mb-2">Plateformes</h2>
            @if($anime?->plateformes->isEmpty())
                <p class="custom-font-size2 mb-1 text-center italic">Cet anime est sur aucune plateforme...</p>
            @endif
            <ul>
                @foreach($anime?->plateformes as $plateforme)
                    <li class="custom-font-size2 mb-1"><a class="custom-link" href="{{route('plateformes.show', $plateforme->plateforme?->id)}}">{{$plateforme->plateforme?->nom}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
    <x-modal-suppression route="animes.destroy" id="{{$anime->id}}" nom="{{$anime->titre}}" typeObjet="l'anime"></x-modal-suppression>
</x-app-layout>
