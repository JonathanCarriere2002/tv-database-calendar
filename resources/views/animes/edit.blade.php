<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4">Modifier '{{$anime->titre}}'</h1>
    <p class="text-center custom-font-size2 italic text-danger">* Veuillez remplir les champs requis</p>
    <form method="post" enctype="multipart/form-data" action="{{route('animes.update', $anime->id)}}">
        @csrf
        @method('PUT')
        <div class="row mt-3">
            <label for="titre" class="form-label">Titre<sup class="text-danger">*</sup></label>
            <input id="titre" name="titre" class="form-control" type="text" minlength="2" maxlength="50" value="{{$anime->titre}}" required>
            @error('titre')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="image" class="form-label">Image</label>
            <input id="image" name="image" class="form-control" type="file" accept="image/png, image/jpg, image/jpeg">
            @error('image')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="genre" class="form-label">Genre<sup class="text-danger">*</sup></label>
            <select class="form-select" id="genre" name="genre" required>
                @foreach($genres as $genre)
                    <option value="{{$genre}}" @if($anime->genre == $genre) selected="selected" @endif>{{$genre}}</option>
                @endforeach
            </select>
            @error('genre')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="description" class="form-label">Description<sup class="text-danger">*</sup></label>
            <textarea id="description" name="description" class="form-control" type="text" minlength="10" maxlength="500" rows="3" cols="50" required>{{$anime->description}}</textarea>
            @error('description')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="studio" class="form-label">Studio<sup class="text-danger">*</sup></label>
            <input id="studio" name="studio" class="form-control" type="text" minlength="2" maxlength="50" value="{{$anime->studio}}" required>
            @error('studio')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="saisons" class="form-label">Saisons<sup class="text-danger">*</sup></label>
            <input id="saisons" name="saisons" class="form-control" type="number" min="1" max="50" value="{{$anime->saisons}}" required>
            @error('saisons')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="episodes" class="form-label">Episodes<sup class="text-danger">*</sup></label>
            <input id="episodes" name="episodes" class="form-control" type="number" min="1" max="1000" value="{{$anime->episodes}}" required>
            @error('episodes')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="duree_episode" class="form-label">Durée d'un épisode (minutes)<sup class="text-danger">*</sup></label>
            <input id="duree_episode" name="duree_episode" class="form-control" type="number" min="1" max="60" value="{{$anime->duree_episode}}" required>
            @error('duree_episode')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="date_debut" class="form-label">Date de début<sup class="text-danger">*</sup></label>
            <input id="date_debut" name="date_debut" class="form-control" type="date" value="{{$anime->date_debut->format('Y-m-d')}}" required>
            @error('date_debut')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
