<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>{{$personnage->nom}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <img src="{{url('/images/personnages/'.$personnage->image)}}" class="img-thumbnail" width="385px" alt="Personnage {{$personnage->nom}}">
    </div>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a class="btn btn-light btn-width mt-2" href="{{route('personnages.edit', $personnage->id)}}">Modifier</a>
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route('personnages.destroy', $personnage->id)}}">Supprimer</a>
        </div>
    @endcan
    <div>
        <p class="justify mb-5">{{$personnage->description}} (sources : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">description</a>,
            <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">image</a>)</p>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <h2 class="text-center mb-3">Anime</h2>
            @if($personnage?->anime !== null)
                <h3 class="text-center mb-2 custom-height">{{$personnage?->anime->titre}}</h3>
                <div class="text-center justify-content-center mb-3">
                    <img src="{{url('/images/animes/'.$personnage?->anime->image)}}" class="img-thumbnail" width="260px" alt="Anime {{$personnage?->anime->titre}}">
                    <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('animes.show', $personnage?->anime->id)}}">Afficher les détails</a>
                </div>
            @else
                <p class="custom-font-size2 mb-1 text-center italic">Ce personnage n'est pas associé à un anime...</p>
            @endif
        </div>
        <div class="col-md-6 mb-3">
            <h2 class="text-center mb-3">Doubleur</h2>
            @if($personnage?->doubleur !== null)
                <h3 class="text-center mb-2 custom-height">{{$personnage?->doubleur->prenom}} {{$personnage?->doubleur->nom}}</h3>
                <div class="text-center justify-content-center mb-3">
                    <img src="{{url('/images/doubleurs/'.$personnage?->doubleur->image)}}" class="img-thumbnail custom-image-height" width="260px" alt="Personnage {{$personnage?->doubleur->prenom}} {{$personnage?->doubleur->nom}}">
                    <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('doubleurs.show', $personnage?->doubleur->id)}}">Afficher les détails</a>
                </div>
            @else
                <p class="custom-font-size2 mb-1 text-center italic">Ce personnage n'est pas associé à un doubleur...</p>
            @endif
        </div>
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
    <x-modal-suppression route="personnages.destroy" id="{{$personnage->id}}" nom="{{$personnage->nom}}" typeObjet="le personnage"></x-modal-suppression>
</x-app-layout>
