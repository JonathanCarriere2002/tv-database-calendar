<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Utilisateurs</h1>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a href="{{route('users.create')}}" class="btn btn-light btn-width2">Ajouter un Utilisateur</a>
        </div>
    @endcan
    <p class="justify mb-5">Cette page permet aux administrateurs de AniListe d’effectuer la gestion des utilisateurs. En
        effet, les administrateurs peuvent afficher les détails d’un utilisateur à partir de cette page. Ils peuvent également
        ajouter, modifier ainsi que supprimer des utilisateurs.</p>
    <!--https://getbootstrap.com/docs/5.0/components/accordion/-->
    <div class="accordion mb-3" id="accordionUsers">
        @foreach($objets as $user)
            <div class="accordion-item bg-dark text-light">
                <div class="accordion-header" id="panelsStayOpen-heading{{$user->id}}">
                    <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$user->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{$user->id}}">
                        <div class="overflow-hidden custom-font-size">{{$user->name}}</div>
                    </button>
                </div>
                <div id="panelsStayOpen-collapse{{$user->id}}" class="accordion-collapse collapse mb-3" aria-labelledby="panelsStayOpen-heading{{$user->id}}">
                    <div class="accordion-body">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <p class="custom-font-size3">Informations : </p>
                                <ul>
                                    <li class="justify mb-1">Administrateur : {{$user->is_admin}}</li>
                                    <li class="justify mb-1">Courriel : {{$user->email}}</li>
                                    <li class="justify mb-1">Identifiant : {{($user->id)}}</li>
                                    <li class="justify mb-1">Nom : {{$user->name}}</li>
                                </ul>
                            </div>
                            <div class="col-md-7">
                                @can('isAdmin')
                                    <a class="btn btn-light mt-3 d-grid" href="{{route('users.show', $user->id)}}">Afficher</a>
                                    <a class="btn btn-light mt-3 d-grid" href="{{route('users.edit', $user->id)}}">Modifier</a>
                                    <a class="btn btn-danger mt-3 d-grid" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$user->id}}" href="{{route("critiques.destroy", $user->id)}}">Supprimer</a>
                                    <x-modal-suppression route="users.destroy" id="{{$user->id}}" nom="{{$user->name}}" typeObjet="l'utilisateur" idSupplementaire="{{$user->id}}"></x-modal-suppression>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (session('message'))
        <x-toast message="{{session('message')}}"></x-toast>
    @endif
</x-app-layout>
