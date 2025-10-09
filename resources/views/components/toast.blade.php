<!--@author Jonathan Carrière-->
<div class="position-fixed bottom-0 end-0 p-3">
    <div id="messageToast" class="toast show border border-2 border-light">
        <div class="toast-header bg-dark text-light">
            <strong class="me-auto">Confirmation</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-light bg-dark">
            {{str_replace("&#039;","'",$message)}}
        </div>
    </div>
</div>
