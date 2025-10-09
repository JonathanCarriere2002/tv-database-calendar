<!--@author Jonathan Carrière -->
@if($idSupplementaire !== 0)
    <div class="modal fade " id="staticBackdrop{{$idSupplementaire}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
@else
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
@endif
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-light">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel">Supprimer cet élément?</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-3">
                <p>Souhaitez-vous vraiment supprimer {{$typeObjet}} '{{str_replace("&#039;","'",$nom)}}'?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="post" action="{{route("$route", $id)}}">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
