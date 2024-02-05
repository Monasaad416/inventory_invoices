<x-create-modal-component title="إضافة وحدة قياس">
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='name'>إسم الوحدة</label><span class="text-danger"> *</span>
            <input type="text" wire:model='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم الوحدة ">
        </div>
        @include('inc.livewire_errors',['property'=>'name'])
    </div>
</x-create-modal-component>
