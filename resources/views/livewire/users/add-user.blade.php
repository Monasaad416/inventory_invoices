<x-create-modal-component title="إضافة مستخدم ">
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='name'>الإسم</label><span class="text-danger"> *</span>
            <input type="text" wire:model='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم المستخدم">
        </div>
        @include('inc.livewire_errors',['property'=>'name'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='email'>البريد الإلكتروني</label><span class="text-danger"> *</span>
            <input type="email"  wire:model='email' class= 'form-control mt-1 mb-3 @error('email') is-invalid @enderror' placeholder = "البريد الإلكتروني">
        </div>
        @include('inc.livewire_errors',['property'=>'email'])
    </div>

    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='password'> كلمة المرور</label><span class="text-danger"> *</span>
            <input type="password" wire:model='password' class= 'form-control mt-1 mb-3 @error('password') is-invalid @enderror' placeholder = "كلمة المرور ">
        </div>
        @include('inc.livewire_errors',['property'=>'password'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='password_confirmation'> تأكيد كلمة المرور</label><span class="text-danger"> *</span>
            <input type="password" wire:model='password_confirmation' class= 'form-control mt-1 mb-3 @error('password_confirmation') is-invalid @enderror' placeholder = "تأكيد كلمة المرور">
        </div>
        @include('inc.livewire_errors',['property'=>'password_confirmation'])
    </div>
    <div class="col-12 mb-2">
        <div class="form-group">
            <label for='roles_name'>المهمة </label><span class="text-danger"> *</span>
            <select wire:model='roles_name' class= 'form-control mt-1 mb-3 @error('roles_name') is-invalid @enderror'>
                <option value="">إختر مهمة المستخدم </option>
                @foreach ( Spatie\Permission\Models\Role::all() as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        @include('inc.livewire_errors',['property'=>'roles_name'])
    </div>
</x-create-modal-component>
