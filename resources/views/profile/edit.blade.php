<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Profil de {{Auth::user()->name}}</h1>
    <p class="justify mb-5">Cette page vous permet d’effectuer la gestion de votre compte d’utilisateur. En effet, il est
        possible de mettre à jour votre nom ou adresse courriel ainsi que changer votre mot de passe. De plus, vous pouvez
        également supprimer votre compte, ce qui supprimera vos données de manières définitives.</p>
    <div class="row mt-4">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="row mt-5">
        @include('profile.partials.update-password-form')
    </div>
    <div class="row mt-5 mb-3">
        @include('profile.partials.delete-user-form')
    </div>
    @if (session('status'))
        <x-toast message="Le compte de {{Auth::user()->name}} a été mis à jour."></x-toast>
    @endif
</x-app-layout>
