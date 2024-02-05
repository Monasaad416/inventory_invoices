<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddRole extends Component
{
    public $name,$role,$permissions , $new_permissions=[];

    public function rules() {
        return [
            'name' => 'required|string|max:255|unique:roles,name',
            'new_permissions' => 'required|array',
        ];
    }

    public function mount()
    {
        $this->permissions = Permission::all();
        // dd($this->permissions);
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم المهمة مطلوب',
            'name.string' => 'إسم المهمة يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المهمة 255 حرف',
            'name.unique' => 'إسم المهمة الذي تم إدخالة بالفعل مسجل في قاعد البيانات',
            'new_permissions.required' => 'الصلاحيات مطلوبة',
        ];

    }

    public function create()
    {
        $this->validate($this->rules() ,$this->messages());


        $role  = Role::create([
            'name' => $this->name,
        ]);
        //dd($this->new_permissions);

        $role->syncPermissions($this->new_permissions);

        $this->reset(['name','new_permissions']);



        //dispatch browser events (js)
        //add event to toggle create modal after save
        $this->dispatch('createModalToggle');


        //refrsh data after adding new row
        $this->dispatch('refreshData')->to(DisplayRoles::class);

        $this->dispatch(
           'alert',
            text: 'تم إضافة مهمة جديدة بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'
        );



    }


    public function render()
    {
        return view('livewire.roles.add-role');
    }
}
