<!--@author Jonathan Carrière-->
<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <div class="text-center mt-4 mb-3">
                        <h1>Vérification de votre Adresse Courriel</h1>
                    </div>
                    <div class="card-body">
                        <p class="mb-4 justify2">Merci de vous être inscrit(e) sur AniListe! Afin d'accéder à certains de nos services, veuillez
                            vérifier votre adresse courriel en appuyant sur le lien envoyé par AniListe à l'adresse utilisée lors de la création
                            de ce compte. Si vous n'avez pas reçu ce courriel, appuyez sur le bouton ci-dessous pour en obtenir un nouveau.</p>
                        @if (session('status') == 'verification-link-sent')
                            <p class="mb-4 justify2">Un nouveau lien de vérification a été envoyé à votre adresse courriel!</p>
                        @endif
                        <div class="mt-4 mb-3 text-center">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button class="btn btn-light p-3" id="btnCourriel" type="submit">Envoyer un Courriel de Vérification</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
