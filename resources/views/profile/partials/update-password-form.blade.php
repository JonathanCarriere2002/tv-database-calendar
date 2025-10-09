<div>
    <h2>Modifier le Mot de Passe</h2>
    <p class="justify">Veuillez vous assurez d'utiliser un mot de passe sécuritaire.</p>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="row mb-4">
            <label for="current_password" class="col-md-2 col-form-label">{{ __('Mot de Passe :') }}</label>
            <div class="col-md-5">
                <input id="current_password" type="password" class="form-control" name="current_password" autocomplete="current-password" required autofocus>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger text-bold mt-1 custom-font-size2" />
        </div>
        <div class="row mb-4">
            <label for="password" class="col-md-2 col-form-label">{{ __('Nouveau mdp :') }}</label>
            <div class="col-md-5">
                <input id="password" type="password" class="form-control" name="password" autocomplete="password" required autofocus>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="text-danger text-bold mt-1 custom-font-size2" />
        </div>
        <div class="row mb-4">
            <label for="password_confirmation" class="col-md-2 col-form-label">{{ __('Confirmation :') }}</label>
            <div class="col-md-5">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" autocomplete="password_confirmation" required autofocus>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-danger text-bold mt-1 custom-font-size2" />
        </div>
        <div class="row mb-4">
            <div class="col-md-7 text-center">
                <button type="submit" class="btn btn-primary w-100">
                    {{ __('Enregistrer') }}
                </button>
            </div>
        </div>
    </form>
</div>
