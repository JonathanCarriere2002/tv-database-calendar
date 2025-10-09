<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Critiques</h1>
    @if (Auth::check())
        <div class="text-center mb-4">
            <a href="{{route('critiques.create')}}" class="btn btn-light btn-width2">Écrire une Critique</a>
        </div>
    @endif
    <p class="justify mb-5">Cette page affiche l’ensemble des critiques écrites par des utilisateurs pour des animes. En
        effet, si vous vous êtes connectés, vous pouvez écrire des critiques pour des animes qui seront ensuite affichées ici.
        Cette page vous permet également de venir afficher, modifier ainsi que supprimer vos critiques.</p>
    <!--https://getbootstrap.com/docs/5.0/components/accordion/-->
    <div class="accordion mb-3" id="accordionCritiques">
        @foreach($objets as $critique)
            <div class="accordion-item bg-dark text-light">
                <div class="accordion-header" id="panelsStayOpen-heading{{$critique->id}}">
                    <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$critique->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{$critique->id}}">
                        <div class="overflow-hidden custom-font-size">{{$critique->titre}}</div>
                    </button>
                </div>
                <div id="panelsStayOpen-collapse{{$critique->id}}" class="accordion-collapse collapse show mb-3" aria-labelledby="panelsStayOpen-heading{{$critique->id}}">
                    <div class="accordion-body">
                        <div class="row text-center justify-content-center align-items-center mb-2">
                            <div class="col-md-3">
                                <img src="{{url('/images/animes/'.$critique->anime?->image)}}" class="img-thumbnail mb-3" width="200px" alt="Anime {{$critique->anime?->titre}}">
                            </div>
                            <div class="col-md-9">
                                <p class="justify">{{$critique->texte}} (source : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">image</a>)</p>
                                <ul>
                                    <li class="justify mb-1">Anime : {{$critique->anime?->titre}}</li>
                                    <li class="justify mb-1">Date : {{$critique->date_ecriture}}</li>
                                    <li class="justify mb-1">Utilisateur : {{$critique->utilisateur?->name}}</li>
                                </ul>
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <a class="btn btn-light mt-3 d-grid" href="{{route('critiques.show', $critique->id)}}">Afficher</a>
                                    </div>
                                    @if (Auth::check() && Auth::user()->id == $critique->user_id)
                                        <div class="col-md-4">
                                            <a class="btn btn-light mt-3 d-grid" href="{{route('critiques.edit', $critique->id)}}">Modifier</a>
                                        </div>
                                    @endif
                                    @if (Auth::check() && Auth::user()->id == $critique->user_id || Auth::check() && Auth::user()->is_admin == 1)
                                        <div class="col-md-4">
                                            <a class="btn btn-danger mt-3 d-grid" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$critique->id}}" href="{{route("critiques.destroy", $critique->id)}}">Supprimer</a>
                                        </div>
                                        <x-modal-suppression route="critiques.destroy" id="{{$critique->id}}" nom="{{$critique->titre}}" typeObjet="la critique" idSupplementaire="{{$critique->id}}"></x-modal-suppression>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
