<?php

namespace App\Livewire\Roles;

use Throwable;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UpdateRole extends Component
{
    protected $listeners = ['editRole'];
    public $name,$role,$permissions,$id,$role_permissions=[] ,$new_permissions;



// public function mount($id)
// {
//     $this->id = $id;
//         $this->permissions = Permission::all();
//     $this->role_permissions = DB::table("role_has_permissions")
//         ->where("role_has_permissions.role_id", $id)
//         ->pluck('role_has_permissions.permission_id')
//         ->toArray();
//     }

public function mount()
{

    $this->permissions = Permission::all();
    // $this->role = Role::findOrFail($id);
    // $this->name = $this->role->name;

    // $existingPermissions = $this->role->permissions->pluck('id')->all();
    // $this->role_permissions = array_fill_keys($existingPermissions, true);
}

    public function initializeRolePermissions()
    {
        $this->role_permissions = $this->role->permissions->pluck('id')->all();

    }

    public function editRole($id)
    {
        $this->role = Role::findOrFail($id);
        $this->id = $this->role->id;
        // $this->role_permissions =  DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        // ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        // ->all();

        $this->permissions = $this->role->permissions;




        //dd($this->role_permissions);


        $this->name = $this->role->name;

        // $this->role_permissions =  DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        // ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        // ->all();


        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [
            'name' => [
                'string',
                'max:255',
                Rule::unique('roles')->ignore($this->id, 'id')
            ],
            'role_permissions' =>'required|array',

        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'إسم المهمة يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المهمة 255 حرف',
            'name.unique' => 'إسم المهمة الذي تم إدخالة بالفعل مسجل في قاعد البيانات',
        ];

    }

    public function update()
    {
           try {
        $data = $this->validate($this->rules() ,$this->messages());


        $role = Role::find($this->id);
        $role->name = $this->name;
        $role->save();




            $this->role->update($data);

            $this->reset(['name']);
            //dispatch browser events (js)
            //add event to toggle update modal after save

            $selectedPermissions = array_keys(array_filter($this->role_permissions));
            // $role->permissions->detach();
            $role->syncPermissions($selectedPermissions);

            $this->dispatch('editModalToggle');

            //refrsh data after adding update row
            $this->dispatch('refreshData')->to(DisplayRoles::class);

            $this->dispatch(
            'alert',
                text: 'تم تعديل المهمة بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'

            );

        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    public function render()
    {
        return view('livewire.roles.update-role');
    }
}
