<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <h1 class="text-center mb-4 mt-4">Connexion</h1>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-4">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Courriel') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de Passe') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center justify-content-center align-items-center mb-4">
                                <div class="col-md-12">
                                    <input class="checkbox-inline" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label custom-checkbox-margin" for="remember">
                                        {{ __('Se Souvenir de Moi') }}
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary w-75">
                                        {{ __('Se Connecter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
