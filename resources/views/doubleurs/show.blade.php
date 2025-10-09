<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>{{$doubleur->nom}}, {{$doubleur->prenom}}</h1>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <img src="{{url('/images/doubleurs/'.$doubleur->image)}}" class="img-thumbnail" width="385px" alt="Doubleur {{$doubleur->nom}}, {{$doubleur->prenom}}">
    </div>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a class="btn btn-light btn-width mt-2" href="{{route('doubleurs.edit', $doubleur->id)}}">Modifier</a>
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route('doubleurs.destroy', $doubleur->id)}}">Supprimer</a>
        </div>
    @endcan
    <div>
        <p class="justify mb-5">Ce doubleur provient de {{$doubleur->lieu_naissance}} et est né(e) le {{$doubleur->date_naissance}}. Présentement, cet individu
            est un doubleur professionnel depuis {{$doubleur->annees_pratique}} an(s). {{$doubleur->nom}}, {{$doubleur->prenom}} a fait la voix de
            {{$doubleur?->personnages->count()}} personnage(s) disponible(s) sur AniListe. (sources : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">description</a>,
            <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">image</a>)</p>
    </div>
    <div class="row mb-3">
        <h2 class="text-center mb-3">Personnages</h2>
        @if($doubleur?->personnages->isEmpty() !== true)
            @foreach($doubleur?->personnages as $personnage)
                <div class="container col-md-3 mb-5 text-center">
                    <h3 class="text-center mb-2 custom-height">{{$personnage->nom}}</h3>
                    <div class="text-center justify-content-center mb-3 mt-3">
                        <img src="{{url('/images/personnages/'.$personnage->image)}}" class="img-thumbnail" width="260px" alt="Personnage {{$personnage->nom}}">
                        <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('personnages.show', $personnage->id)}}">Afficher les détails</a>
                    </div>
                </div>
            @endforeach
        @else
            <p class="custom-font-size2 mb-1 text-center italic">Ce doubleur ne possède pas de personnages...</p>
        @endif
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
    <x-modal-suppression route="doubleurs.destroy" id="{{$doubleur->id}}" nom="{{$doubleur->nom}}, {{$doubleur->prenom}}" typeObjet="le doubleur"></x-modal-suppression>
</x-app-layout>
