<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class DeleteUser extends Component
{
    protected $listeners = ['deleteUser'];
    public $user,$userName;

    public function deleteUser($id)
    {
        $this->user = User::where('id',$id)->first();
    //dd($this->user);
        $this->userName = $this->user->name;
        $this->dispatch('deleteModalToggle');

    }


    public function delete()
    {
        $user = User::where('id',$this->user->id)->delete();
            $this->reset('user');
            //dispatch browser events (js)
            //add event to toggle delete modal after remove row
            $this->dispatch('deleteModalToggle');

            //refrsh data after delete row
            $this->dispatch('refreshData')->to(DisplayUsers::class);

            $this->dispatch(
            'alert',
                text: 'تم حذف المستخدم بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'

            );
        }


    public function render()
    {
        return view('livewire.users.delete-user');
    }
}
