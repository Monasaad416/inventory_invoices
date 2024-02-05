<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use App\Models\Invoicerole;
use Spatie\Permission\Models\Role;
use App\Livewire\roles\DisplayRoles;

class DeleteRole extends Component
{
    protected $listeners = ['deleteRole'];
    public $role ,$roleName,$roleId;

    public function deleteRole($id)
    {
        $this->role = Role::where('id',$id)->first();

        $this->roleName = $this->role->name;
        $this->dispatch('deleteModalToggle');

    }


    public function delete()
    {
        Role::where('id',$this->role->id)->first()->delete();

            $this->reset('role');
            //dispatch browser events (js)
            //add event to toggle delete modal after remove row
            $this->dispatch('deleteModalToggle');

            //refrsh data after delete row
            $this->dispatch('refreshData')->to(DisplayRoles::class);

            $this->dispatch(
            'alert',
                text: 'تم حذف المهمة بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'

            );


    }
    public function render()
    {
        return view('livewire.roles.delete-role');
    }
}
