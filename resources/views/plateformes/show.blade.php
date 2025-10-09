<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>{{$plateforme->nom}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <img src="{{url('/images/plateformes/'.$plateforme->image)}}" class="img-thumbnail" width="325px" alt="Plateforme {{$plateforme->nom}}">
    </div>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a class="btn btn-light btn-width mt-2" href="{{route('plateformes.edit', $plateforme->id)}}">Modifier</a>
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route('plateformes.destroy', $plateforme->id)}}">Supprimer</a>
        </div>
    @endcan
    <div>
        <p class="justify mb-5">{{$plateforme->description}} (sources : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">description</a>,
            <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">image</a>)</p>
    </div>
    <div class="row mb-3">
        <h2 class="text-center mb-3">Animes</h2>
        @if($plateforme?->animes->isEmpty() !== true)
            @foreach($plateformeAnimes as $anime)
                <div class="container col-md-3 mb-5 text-center">
                    <h3 class="text-center mb-2 custom-height">{{$anime->anime?->titre}}</h3>
                    <div class="text-center justify-content-center mb-3 mt-3">
                        <img src="{{url('/images/animes/'.$anime->anime?->image)}}" class="img-thumbnail" width="260px" alt="Anime {{$anime->anime?->titre}}">
                        <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('animes.show', $anime->anime?->id)}}">Afficher les détails</a>
                    </div>
                </div>
            @endforeach
            <div class="mb-3">
                {{$plateformeAnimes->links()}}
            </div>
        @else
            <p class="custom-font-size2 mb-1 text-center italic">Cette plateforme ne possède pas d'animes...</p>
        @endif
    </div>
    <x-modal-suppression route="plateformes.destroy" id="{{$plateforme->id}}" nom="{{$plateforme->nom}}" typeObjet="la plateforme"></x-modal-suppression>
</x-app-layout>
