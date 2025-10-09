<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4">Écrire une Critique</h1>
    <p class="text-center custom-font-size2 italic text-danger">* Veuillez remplir les champs requis</p>
    <form method="post" action="{{route('critiques.store')}}">
        @csrf
        <div class="row mt-3">
            <label for="titre" class="form-label">Titre<sup class="text-danger">*</sup></label>
            <input id="titre" name="titre" class="form-control" type="text" minlength="2" maxlength="50" required>
            @error('titre')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="anime_id" class="form-label">Anime<sup class="text-danger">*</sup></label>
            <select class="form-select" id="anime_id" name="anime_id" required>
                @foreach($animes as $anime)
                    <option value="{{$anime->id}}">{{$anime->titre}}</option>
                @endforeach
            </select>
            @error('anime_id')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="score" class="form-label">Score<sup class="text-danger">*</sup></label>
            <select class="form-select" id="score" name="score" required>
                <!--https://stackoverflow.com/questions/40716464/php-loop-1-to-10-->
                @for($i = 1; $i<=10; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            @error('score')
            <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="texte" class="form-label">Texte<sup class="text-danger">*</sup></label>
            <textarea id="texte" name="texte" class="form-control" type="text" minlength="10" maxlength="1000" rows="5" cols="50" required></textarea>
            @error('texte')
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
            <button type="submit" class="btn btn-primary mt-3">Publier</button>
        </div>
    </form>
</x-app-layout>
