<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4">Ajouter une Utilisateur</h1>
    <p class="text-center custom-font-size2 italic text-danger">* Veuillez remplir les champs requis</p>
    <form method="post" action="{{route('users.store')}}">
        @csrf
        <div class="row mt-3">
            <label for="name" class="form-label">Nom<sup class="text-danger">*</sup></label>
            <input id="name" name="name" class="form-control" type="text" maxlength="50" minlength="5" required>
            @error('name')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="email" class="form-label">Adresse Courriel<sup class="text-danger">*</sup></label>
            <input id="email" name="email" class="form-control" type="email" maxlength="50" pattern="^.+@.+\..+$" required>
            @error('email')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="password" class="form-label">Mot de Passe<sup class="text-danger">*</sup></label>
            <input id="password" name="password" class="form-control" type="password" minlength="8" required>
            @error('password')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
