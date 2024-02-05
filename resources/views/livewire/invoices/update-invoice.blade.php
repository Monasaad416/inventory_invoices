<x-update-modal-component title="تعديل بنود الفاتورة">
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='name'>الإسم</label><span class="text-danger"> *</span>
            <input type="text" wire:model='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم المنتج">
        </div>
        @include('inc.livewire_errors',['property'=>'name'])
    </div>

    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='code'>الكود</label><span class="text-danger"> *</span>
            <input type="text" wire:model='code' class= 'form-control mt-1 mb-3 @error('code') is-invalid @enderror' placeholder = "كود المنتج">
        </div>
        @include('inc.livewire_errors',['property'=>'code'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='unit'>الوحدة </label><span class="text-danger"> *</span>
            <input type="text" wire:model='unit' class= 'form-control mt-1 mb-3 @error('unit') is-invalid @enderror' placeholder = "وحدة القياس">
        </div>
        @include('inc.livewire_errors',['property'=>'unit'])
    </div>

      <div class="col-12 mb-2">
        <div class="form-group">
            <label for='tension'>الشد</label><span class="text-danger"> *</span>
            <input type="number" min="0" step="any" wire:model='tension' class= 'form-control mt-1 mb-3 @error('tension') is-invalid @enderror' placeholder = "الشد">
        </div>
        @include('inc.livewire_errors',['property'=>'tension'])
    </div>
</x-update-modal-component>
