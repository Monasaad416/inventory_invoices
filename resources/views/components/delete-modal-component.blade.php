<div class="modal" id="delete_modal" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
           
                <form wire:submit.prevent="delete">
                    @csrf
                     
                     {{$slot}}
                </form>
            
        </div>
    </div>
</div>