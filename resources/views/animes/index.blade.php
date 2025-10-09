<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Animes</h1>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a href="{{route('animes.create')}}" class="btn btn-light btn-width2">Ajouter un Anime</a>
        </div>
    @endcan
    @if (Auth::check())
        <div class="text-center mb-3" id="erreurajouthoraire">
            @error('anime_id')
            <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
    @endif
    <p class="justify mb-5">Cette page affiche l’ensemble des animes présentement disponibles sur AniListe. En appuyant
        sur le bouton <span class="italic">Afficher les détails</span>, une page contenant les informations d’un anime sera
        affichée. De plus, si vous vous êtes connectés, vous pouvez ajouter un anime à votre horaire en appuyant sur le
        bouton <span class="italic">Ajouter à mon horaire</span>. (source : <a href="https://www.crunchyroll.com/" target="_blank" rel="noreferrer noopener">images</a>)</p>
    <div class="row mb-3">
        @foreach($objets as $anime)
            <div class="container col-md-3 mb-5 text-center">
                <h2 class="overflow-hidden custom-height">{{$anime->titre}}</h2>
                <img src="{{url('/images/animes/'.$anime->image)}}" class="img-thumbnail" width="260px" alt="Anime {{$anime->titre}}">
                <a class="btn btn-light btn-width mt-2 d-grid" href="{{route('animes.show', $anime->id)}}">Afficher les détails</a>
                <!--https://stackoverflow.com/questions/37355733/how-to-check-if-user-is-connected-in-view-laravel-->
                @if (Auth::check())
                    <form id="formAnimeIndex{{$anime->id}}" method="post" action="{{route('horaires.store')}}">
                        @csrf
                        <input id="anime_id" name="anime_id" value="{{$anime->id}}" type="hidden" required>
                        <input id="user_id" name="user_id" value="{{ Auth::user()->id }}" type="hidden" required>
                    </form>
                    <button class="btn btn-light btn-width mt-2 d-grid" form="formAnimeIndex{{$anime->id}}" type="submit">Ajouter à mon horaire</button>
                @endif
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
