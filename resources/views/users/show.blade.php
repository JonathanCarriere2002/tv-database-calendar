<!--@author Jonathan Carrière-->
<x-app-layout>
    <div class="text-center mt-4 mb-4 overflow-hidden">
        <h1>{{$user->name}} (#{{$user->id}}@if($user->is_admin == 1), Admin, @else, Pas Admin, @endif @if($user->email_verified_at != null)E-Mail Verif.) @else E-Mail Pas Verif.)@endif </h1>
        <h2>{{$user->email}}</h2>
    </div>
    @can('isAdmin')
        <div class="text-center mb-5">
            <a class="btn btn-light btn-width mt-2" href="{{route('users.edit', $user->id)}}">Modifier</a>
            <a class="btn btn-danger btn-width mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="{{route('users.destroy', $user->id)}}">Supprimer</a>
        </div>
    @endcan
    <div class="row mb-5">
        <h2 class="text-center mb-3">Critiques</h2>
        @if($user?->critiques->isEmpty() !== true)
            <div class="accordion mb-3" id="accordionCritiques">
                @foreach($user?->critiques as $critique)
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
                                        <p class="justify">{{$critique->texte}} (source : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">images</a>)</p>
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
        @else
            <p class="custom-font-size2 mb-1 text-center italic">Cet utilisateur ne possède pas de critiques...</p>
        @endif
    </div>
    <div class="row mb-3">
        <h2 class="text-center mb-3">Horaire d'animes</h2>
        @if($user?->horaires->isEmpty() !== true)
            @foreach($user?->horaires as $horaire)
                <div class="container col-md-3 mb-5 text-center">
                    <h3 class="text-center mb-2 custom-height">{{$horaire->anime?->titre}}</h3>
                    <div class="text-center justify-content-center mb-3 mt-3">
                        <img src="{{url('/images/animes/'.$horaire->anime?->image)}}" class="img-thumbnail" width="260px" alt="Anime {{$horaire->anime?->titre}}">
                        <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('animes.show', $horaire->anime?->id)}}">Afficher les détails</a>
                    </div>
                </div>
            @endforeach
        @else
            <p class="custom-font-size2 mb-1 text-center italic">Cet utilisateur ne possède pas d'animes à son horaire...</p>
        @endif
    </div>
    <x-modal-suppression route="users.destroy" id="{{$user->id}}" nom="{{$user->name}}" typeObjet="l'utilisateur"></x-modal-suppression>
</x-app-layout>
