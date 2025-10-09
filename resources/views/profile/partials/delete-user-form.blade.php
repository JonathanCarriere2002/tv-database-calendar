<div>
    <h2>Supprimer votre Compte</h2>
    <p class="justify text-danger">Attention! Votre compte et l'ensemble de vos données seront supprimées.</p>
    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')
        <div class="row mb-4">
            <label for="password" class="col-md-2 col-form-label">{{ __('Mot de Passe :') }}</label>
            <div class="col-md-5">
                <input id="password" type="password" class="form-control" name="password" autocomplete="password" required autofocus>
            </div>
            <x-input-error :messages="$errors->userDeletion->get('password')" class="text-danger text-bold mt-1 custom-font-size2" />
        </div>
        <div class="row mb-4">
            <div class="col-md-7 text-center">
                <button type="submit" class="btn btn-danger w-100">
                    {{ __('Supprimer') }}
                </button>
            </div>
        </div>
    </form>
</div>
