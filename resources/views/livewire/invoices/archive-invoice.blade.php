<div class="modal" id="archive_modal" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <form wire:submit.prevent="archive">
                @csrf
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <div class="modal-header">
                        <h5 class="tx-danger mg-b-20 mx-3 my-3">ترحيل فاتورة من قائمة فواتير الجرد</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>هل انت متاكد من ترحيل فاتورة الجرد رقم  {!! "&nbsp;" !!}{!! "&nbsp;" !!} {{$invoiceNumber}} </p>

                            <div class="form-row">
                                <div class="col">
                                    <input type="hidden" wire:model="productId">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                <button type="submit" class="btn btn-info">
                                    <span wire:loading.remove>
                                        ترحيل
                                    </span>

                                    <div class="text-center" wire:loading wire:target="delete">
                                        <div class="spinner-border text-warning" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>    
            </form>
            
        </div>
    </div>
</div>