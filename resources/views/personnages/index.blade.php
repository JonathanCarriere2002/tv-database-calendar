<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Personnages</h1>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a href="{{route('personnages.create')}}" class="btn btn-light btn-width2">Ajouter un Personnage</a>
        </div>
    @endcan
    <p class="justify mb-5">Cette page affiche l’ensemble des personnages provenant d’une multitude d’animes présentement
        disponibles sur AniListe. De plus, vous pouvez également appuyer sur le bouton <span class="italic">Afficher les détails</span>
        afin de visionner des informations sur un personnage, comme son anime d’origine ou son doubleur.
        (source : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">images</a>)</p>
    <div class="row mb-1">
        @foreach($objets as $personnage)
            <div class="container col-md-3 mb-5 text-center">
                <h2 class="overflow-hidden custom-height">{{$personnage->nom}}</h2>
                <img src="{{url('/images/personnages/'.$personnage->image)}}" class="img-thumbnail" width="260px" alt="Personnage {{$personnage->nom}}">
                <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('personnages.show', $personnage->id)}}">Afficher les détails</a>
            </div>
        @endforeach
    </div>
    <div class="mb-3">
        {{$objets->links()}}
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
</x-app-layout>
