<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Bienvenu sur AniListe !</h1>
    <!--https://getbootstrap.com/docs/5.0/components/carousel/-->
    <div id="carousel" class="carousel carousel-light slide" data-bs-ride="carousel">
        <div class="carousel-indicators bg-dark opacity-75 mb-2 custom-width">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="5"></button>
        </div>
        <div class="carousel-inner">
            @foreach($animes_carousel as $anime_carousel)
                <div class="carousel-item @if($animes_carousel[0] == $anime_carousel) active @endif" data-bs-interval="5000">
                    <div class="d-flex justify-content-center">
                        <img src="{{url('/images/animes/'.$anime_carousel->image)}}" class="img-thumbnail" width="385px" alt="Anime {{$anime_carousel->titre}}">
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev justify-content-end" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark opacity-75" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next justify-content-start" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark opacity-75" aria-hidden="true"></span>
        </button>
    </div>
    <p class="justify mt-4 mb-4">AniListe est une plateforme qui vous permet de visionner des informations sur des animes,
        des doubleurs, des personnages et des sites de diffusion d’animes. Vous pouvez également écrire des critiques pour
        des animes qui seront publiées sur cette plateforme. AniListe vous permet aussi de voir un calendrier qui affiche les
        dates de diffusion d’une multitude d’animes en plus de vous offrir la possibilité d’effectuer la gestion de votre horaire
        d’animes personnalisé. (sources : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">Crunchyroll</a>,
        <a href="https://myanimelist.net/" target="_blank" rel="noreferrer noopener">MyAnimeList</a> et
        <a href="https://en.wikipedia.org/wiki/Main_Page" target="_blank" rel="noreferrer noopener">Wikipédia</a>)</p>
    <!--https://getbootstrap.com/docs/5.0/components/list-group/-->
    <h2 class="mt-5 mb-3">Animes</h2>
    <div class="list-group list-group-horizontal position-relative overflow-auto">
        @foreach($animes as $anime)
            <div class="container col-3 mb-3 text-center">
                <h3 class="overflow-hidden custom-height">{{$anime->titre}}</h3>
                <img src="{{url('/images/animes/'.$anime->image)}}" class="img-thumbnail" width="220px" alt="Anime {{$anime->titre}}">
                <a class="btn btn-light btn-width3 mt-2 d-grid text-center" href="{{route('animes.show', $anime->id)}}">Afficher</a>
            </div>
        @endforeach
    </div>
    <h2 class="mt-5 mb-3">Doubleurs</h2>
    <div class="list-group list-group-horizontal position-relative overflow-auto">
        @foreach($doubleurs as $doubleur)
            <div class="container col-3 mb-3 text-center">
                <h3 class="overflow-hidden custom-height">{{$doubleur->nom}}, {{$doubleur->prenom}}</h3>
                <img src="{{url('/images/doubleurs/'.$doubleur->image)}}" class="img-thumbnail" width="220px" alt="Doubleur {{$doubleur->nom}}, {{$doubleur->prenom}}">
                <a class="btn btn-light btn-width3 mt-2 d-grid text-center" href="{{route('doubleurs.show', $doubleur->id)}}">Afficher</a>
            </div>
        @endforeach
    </div>
    <h2 class="mt-5 mb-3">Personnages</h2>
    <div class="list-group list-group-horizontal position-relative overflow-auto">
        @foreach($personnages as $personnage)
            <div class="container col-3 mb-3 text-center">
                <h3 class="overflow-hidden custom-height">{{$personnage->nom}}</h3>
                <img src="{{url('/images/personnages/'.$personnage->image)}}" class="img-thumbnail" width="220px" alt="Personnage {{$personnage->nom}}">
                <a class="btn btn-light btn-width3 mt-2 d-grid text-center" href="{{route('personnages.show', $personnage->id)}}">Afficher</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
