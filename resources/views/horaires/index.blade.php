<!--@author Jonathan Carrière-->
<x-app-layout>
    @vite('resources/js/horaires_script.js')
    <h1 class="text-center mt-4 mb-4">Horaire de {{ Auth::user()->name }}</h1>
    <p class="justify mb-3">Cette page contient un calendrier permettant d’afficher les dates de diffusion pour les animes
        qui sont présentement à votre horaire. De plus, vous pouvez également effectuer la gestion de votre horaire en ajoutant
        ou supprimant des animes de ce dernier. Cette page contient aussi une liste des animes qui se retrouvent à votre horaire.
        (source : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">images</a>)</p>
    @if(Auth::user()?->horaires->isEmpty() !== true)
        <div class="text-center mb-4 mt-4">
            <div id="spinner" class="d-flex align-items-center">
                <h2><strong>Chargement du calendrier...</strong></h2>
                <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
            </div>
            <div class="mb-4" id='calendar'></div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-3 mb-2 text-center">Ajouter un Anime</h2>
            <form method="post" action="{{route('horaires.store')}}">
                @csrf
                <div class="row mt-3">
                    <label for="anime_id" class="form-label">Anime</label>
                    <select class="form-select" id="anime_id" name="anime_id" required>
                        @foreach($animes as $anime)
                            <option value="{{$anime->id}}">{{$anime->titre}}</option>
                        @endforeach
                    </select>
                    @error('anime_id')
                        <div class="text-danger text-bold mt-1">* {{$message}}</div>
                    @enderror
                </div>
                <div class="row">
                    <input id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden required>
                    @error('user_id')
                        <div class="text-danger text-bold mt-1">* {{$message}}</div>
                    @enderror
                </div>
                <div class="row mt-3">
                    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <h2 class="text-center mt-4 mb-4">Animes à votre Horaire</h2>
        @if(Auth::user()?->horaires->isEmpty() !== true)
            @foreach($animesUser as $horaire)
                <div class="container col-md-3 mb-5 text-center">
                    <h3 class="text-center mb-2 custom-height">{{$horaire->anime?->titre}}</h3>
                    <div class="text-center justify-content-center mb-3 mt-3">
                        <img src="{{url('/images/animes/'.$horaire->anime?->image)}}" class="img-thumbnail" width="260px" alt="Anime {{$horaire->anime?->titre}}">
                        <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('animes.show', $horaire->anime?->id)}}">Afficher les détails</a>
                        <a class="btn btn-danger btn-width mt-2 d-grid" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$horaire->id}}" href="{{route("horaires.destroy", $horaire->id)}}">Retirer de l'Horaire</a>
                        <x-modal-suppression route="horaires.destroy" id="{{$horaire->id}}" nom="{{$horaire->anime?->titre}}" typeObjet="l'anime" idSupplementaire="{{$horaire->id}}"></x-modal-suppression>
                    </div>
                </div>
            @endforeach
        @else
            <p class="custom-font-size2 mb-1 text-center italic">Vous ne possédez pas d'animes à votre horaire...</p>
        @endif
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
</x-app-layout>
