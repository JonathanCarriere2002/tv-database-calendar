<!--@author Jonathan Carrière-->
<header>
    <nav class="navbar navbar-expand-md navbar-toggleable-md navbar-dark bg-dark border-bottom box-shadow mb-3 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" id="nav00" href="{{ url('/') }}">
                {{ config('AniListe', 'AniListe') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-md-inline-flex justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item"><a class="nav-link text-light" id="nav01" href="{{ url('/animes') }}">{{ config('Animes', 'Animes') }}</a></li>
                    <li class="nav-item"><a class="nav-link text-light" id="nav02" href="{{ url('/calendrier') }}">{{ config('Calendrier', 'Calendrier') }}</a></li>
                    <li class="nav-item"><a class="nav-link text-light" id="nav03" href="{{ url('/critiques') }}">{{ config('Critiques', 'Critiques') }}</a></li>
                    <li class="nav-item"><a class="nav-link text-light" id="nav04" href="{{ url('/doubleurs') }}">{{ config('Doubleurs', 'Doubleurs') }}</a></li>
                    <li class="nav-item"><a class="nav-link text-light" id="nav05" href="{{ url('/personnages') }}">{{ config('Personnages', 'Personnages') }}</a></li>
                    <li class="nav-item"><a class="nav-link text-light" id="nav06" href="{{ url('/plateformes') }}">{{ config('Plateformes', 'Plateformes') }}</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-light" id="nav07" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" id="nav08" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-dark text-light" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item bg-dark text-light" id="nav09" href="{{ route('horaires.index') }}">
                                    {{ __('Horaire') }}
                                </a>
                                <a class="dropdown-item bg-dark text-light" id="nav10" href="{{ route('profile.edit') }}">
                                    {{ __('Profil') }}
                                </a>
                                <a class="dropdown-item bg-dark text-light" id="nav11" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Se déconnecter') }}
                                </a>
                                @can('isAdmin')
                                    <a class="dropdown-item bg-dark text-light" id="nav12" href="{{ route('users.index') }}">
                                        {{ __('Utilisateurs') }}
                                    </a>
                                @endcan
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
