<!--@author Jonathan Carrière-->
<x-app-layout>
    <h1 class="text-center mt-4 mb-4">Plateformes</h1>
    @can('isAdmin')
        <div class="text-center mb-4">
            <a href="{{route('plateformes.create')}}" class="btn btn-light btn-width2">Ajouter une Plateforme</a>
        </div>
    @endcan
    <p class="justify mb-5">Cette page afficher l’ensemble des plateformes qui diffusent des animes présentement disponibles
        sur AniListe. De plus, vous pouvez également appuyer sur le bouton <span class="italic">Afficher les détails</span>
        afin de visionner des informations sur une plateforme, comme sa liste d’émissions diffusées.</p>
    <!--https://getbootstrap.com/docs/5.0/components/accordion/-->
    <div class="accordion mb-3" id="accordionPlateformes">
        @foreach($objets as $plateforme)
            <div class="accordion-item bg-dark text-light">
                <div class="accordion-header" id="panelsStayOpen-heading{{$plateforme->id}}">
                    <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$plateforme->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{$plateforme->id}}">
                        <div class="overflow-hidden custom-font-size">{{$plateforme->nom}}</div>
                    </button>
                </div>
                <div id="panelsStayOpen-collapse{{$plateforme->id}}" class="accordion-collapse collapse show mb-3" aria-labelledby="panelsStayOpen-heading{{$plateforme->id}}">
                    <div class="accordion-body">
                        <div class="row text-center justify-content-center align-items-center">
                            <div class="col-md-2">
                                <img src="{{url('/images/plateformes/'.$plateforme->image)}}" class="img-thumbnail mb-3" width="150px" height="150px" alt="Plateforme {{$plateforme->nom}}">
                            </div>
                            <div class="col-md-10">
                                <p class="justify">{{$plateforme->description}} (sources : <a href="https://en.wikipedia.org/wiki/Main_Page" target="_blank" rel="noreferrer noopener">description</a>,
                                    <a href="https://en.wikipedia.org/wiki/Main_Page" target="_blank" rel="noreferrer noopener">image</a>)</p>
                                <a class="btn btn-light btn-width mt-4 d-grid w-75" href="{{route('plateformes.show', $plateforme->id)}}">Afficher les détails</a>
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
