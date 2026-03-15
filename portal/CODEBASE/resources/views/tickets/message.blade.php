<div class="modal-content file-manager-application">
    <div class="modal-header">
        <h4 class="modal-title text-primary" id="myModalLabel1">Message</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body p-2">
            @if(isset($ticket))
            {{$ticket->issue}}
            @endif
    </div>
</div>