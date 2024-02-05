<x-update-modal-component title="تعديل المهمة">

    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='name'>الإسم</label><span class="text-danger"> *</span>
            <input type="text" wire:model='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم المهمة">
        </div>
        @include('inc.livewire_errors',['property'=>'name'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <strong class="d-block my-2 "> إختر الصلاحيات :</strong>
            <br/>
            <input class="mb-4" type="checkbox" name="select-all" id="select-all" />
            <h5 class="d-inline my-4 text-muted mb-4">إختر الكل</h5>
            <br>


    @foreach($permissions as $permission)
        <label>
            <input type="checkbox" wire:model="role_permissions.{{ $permission->id }}" {{ in_array($permission->id ,$role_permissions) ? 'checked':'' }}>
               {{-- <input type="checkbox" wire:model="role_permissions.{{ $permission->id }}" {{ in_array($permission->id ,$role_permissions) ? 'checked':'' }}> --}}
            {{ $permission->name }}
        </label>
        <br/>
    @endforeach

            @include('inc.livewire_errors',['property'=>'role_permissions'])
     
        </div>
        
    </div>
</x-update-modal-component>
