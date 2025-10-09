<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4">Modifier '{{$user->name}}'</h1>
    <p class="text-center custom-font-size2 italic text-danger">* Veuillez remplir les champs requis</p>
    <form method="post" action="{{route('users.update', $user->id)}}">
        @csrf
        @method('PUT')
        <div class="row mt-3">
            <label for="name" class="form-label">Nom<sup class="text-danger">*</sup></label>
            <input id="name" name="name" class="form-control" type="text" maxlength="50" minlength="5" value="{{$user->name}}" required>
            @error('name')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="email" class="form-label">Adresse Courriel<sup class="text-danger">*</sup></label>
            <input id="email" name="email" class="form-control" type="email" maxlength="50" pattern="^.+@.+\..+$" value="{{$user->email}}" required>
            @error('email')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="password" class="form-label">Mot de Passe</label>
            <input id="password" name="password" class="form-control" type="password" minlength="8">
            @error('password')
                <div class="text-danger text-bold mt-1">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="is_admin" class="form-label">Données les permissions d'administrateurs<sup class="text-danger">*</sup></label>
            <select class="form-select" id="is_admin" name="is_admin" required>
                <option value="0">Non</option>
                <option value="1" @if($user->is_admin == 1) selected="selected" @endif>Oui</option>
            </select>
            @error('is_admin')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <label for="email_verified_at" class="form-label">Vérifier l'adresse courriel de l'utilisateur<sup class="text-danger">*</sup></label>
            <select class="form-select" id="email_verified_at" name="email_verified_at" required>
                <option value="0">Non</option>
                <option value="1" @if($user->email_verified_at != null) selected="selected" @endif>Oui</option>
            </select>
            @error('email_verified_at')
                <div class="text-danger text-bold mt-1 custom-font-size2">* {{$message}}</div>
            @enderror
        </div>
        <div class="row mt-3">
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
        </div>
    </form>
</x-app-layout>
