<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <h1 class="text-center mb-3 mt-3">Oublié votre mot de passe?</h1>
                    <h5 class="text-center">Veuillez entrer votre adresse courriel afin de réinitialiser votre mot de passe.</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Adresse Courriel') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('name') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary mt-3">
                                        {{ __('Envoyer le lien de réinitialisation') }}
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
