<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4">Modifier '{{$doubleur->prenom}} {{$doubleur->nom}}'</h1>
    <p class="text-center custom-font-size2 italic text-danger">* Veuillez remplir les champs requis</p>
    <form method="post" enctype="multipart/form-data" action="{{route('doubleurs.update', $doubleur->id)}}">
        @csrf
        @method("put")
        <div class="row mt-3">
            <label for="nom" class="form-label">Nom<sup class="text-danger">*</sup></label>
            <input id="nom" name="nom" class="form-control" type="text" minlength="2" maxlength="50" value="{{$doubleur->nom}}" required>
            @error('nom')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="prenom" class="form-label">Prénom<sup class="text-danger">*</sup></label>
            <input id="prenom" name="prenom" class="form-control" type="text" minlength="2" maxlength="50" value="{{$doubleur->prenom}}" required>
            @error('prenom')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="image" class="form-label">Image</label>
            <input id="image" name="image" class="form-control" type="file" accept="image/png, image/jpg, image/jpeg">
            @error('image')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="date_naissance" class="form-label">Date de Naissance<sup class="text-danger">*</sup></label>
            <input id="date_naissance" name="date_naissance" class="form-control" type="date" value="{{$doubleur->date_naissance}}" required>
            @error('date_naissance')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="lieu_naissance" class="form-label">Lieu de Naissance<sup class="text-danger">*</sup></label>
            <input id="lieu_naissance" name="lieu_naissance" class="form-control" type="text" minlength="2" maxlength="50" value="{{$doubleur->lieu_naissance}}" required>
            @error('lieu_naissance')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="annees_pratique" class="form-label">Années de Pratique<sup class="text-danger">*</sup></label>
            <input id="annees_pratique" name="annees_pratique" class="form-control" type="number" min="1" max="50" value="{{$doubleur->annees_pratique}}" required>
            @error('annees_pratique')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
