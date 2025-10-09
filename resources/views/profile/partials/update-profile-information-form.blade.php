<div>
    <h2>Information du profile</h2>
    <p class="justify">Mettre à jour votre nom et adresse courriel.</p>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        <div class="row mb-4">
            <label for="name" class="col-md-2 col-form-label">{{ __('Nom :') }}</label>
            <div class="col-md-5">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
            </div>
            <x-input-error class="text-danger text-bold mt-1 custom-font-size2" :messages="$errors->get('name')" />
        </div>
        <div class="row mb-4">
            <label for="email" class="col-md-2 col-form-label">{{ __('Courriel :') }}</label>
            <div class="col-md-5">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
            </div>
            <x-input-error class="text-danger text-bold mt-1 custom-font-size2" :messages="$errors->get('email')" />
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
