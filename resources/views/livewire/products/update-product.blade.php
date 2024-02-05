<x-update-modal-component title="تعديل المنتج">
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='code'>الكود</label><span class="text-danger"> *</span>
            <input type="text" wire:model='code' class= 'form-control mt-1 mb-3 @error('code') is-invalid @enderror' placeholder = "كود المنتج">
        </div>
        @include('inc.livewire_errors',['property'=>'code'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='name'>الإسم</label><span class="text-danger"> *</span>
            <input type="text" wire:model='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم المنتج">
        </div>
        @include('inc.livewire_errors',['property'=>'name'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='unit_id'>الوحدة </label><span class="text-danger"> *</span>
            <select wire:model='unit_id' class= 'form-control mt-1 mb-3 @error('unit_id') is-invalid @enderror'>
                <option value="">إختر وحدة القياس</option>
                @foreach (App\Models\Unit::aLL() as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>


        </div>
        @include('inc.livewire_errors',['property'=>'unit_id'])
    </div>

      <div class="col-12 mb-2">
        <div class="form-group">
            <label for='tension'>الشد</label><span class="text-danger"> *</span>
            <input type="number" min="0" step="any" wire:model='tension' class= 'form-control mt-1 mb-3 @error('tension') is-invalid @enderror' placeholder = "الشد">
        </div>
        @include('inc.livewire_errors',['property'=>'tension'])
    </div>

    
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='price'>سعر التكلفة</label><span class="text-danger"> *</span>
            <input type="number" min="0" step="any" wire:model='price' class= 'form-control mt-1 mb-3 @error('price') is-invalid @enderror' placeholder = "سعر التكلفة">
        </div>
        @include('inc.livewire_errors',['property'=>'price'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='code_type'>نوع الكود </label><span class="text-danger"> *</span>
            <select wire:model='code_type' class= 'form-control mt-1 mb-3 @error('type') is-invalid @enderror'>
                <option value="">إختر نوع الكود</option>
                <option value="1D">1D</option>
                <option value="2D">2D</option>
            </select>
        </div>
        @include('inc.livewire_errors',['property'=>'code_type'])
    </div>
</x-update-modal-component>
