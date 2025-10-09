<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Doubleurs</h1>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a href="{{route('doubleurs.create')}}" class="btn btn-light btn-width2">Ajouter un Doubleur</a>
        </div>
    @endcan
    <p class="justify mb-5">Cette page affiche l’ensemble des doubleurs ayant fait la voix d’un ou plusieurs personnages
        présentement disponibles sur AniListe. De plus, vous pouvez également appuyer sur le bouton <span class="italic">Afficher les détails</span>
        afin de visionner des informations sur un doubleur, ce qui comprend sa liste de personnages.
        (source : <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">images</a>)</p>
    <div class="row mb-3">
        @foreach($objets as $doubleur)
            <div class="container col-md-3 mb-5 text-center">
                <h2 class="overflow-hidden custom-height">{{$doubleur->nom}}, {{$doubleur->prenom}}</h2>
                <img src="{{url('/images/doubleurs/'.$doubleur->image)}}" class="img-thumbnail" width="260px" alt="Doubleur {{$doubleur->nom}}, {{$doubleur->prenom}}">
                <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('doubleurs.show', $doubleur->id)}}">Afficher les détails</a>
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
