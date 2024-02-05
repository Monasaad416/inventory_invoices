<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UpdateUser extends Component
{
    protected $listeners = ['editUser'];
    public $name, $user,$email,$roles_name;


    public function editUser($id)
    {
        $this->user = User::findOrFail($id);

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->roles_name = $this->user->roles_name;

        //return dd($this->is_active);

        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [
            'name' => [
                'string',
                'max:100',
            ],
            'email' => [
                'email',
                'max:2100',
                Rule::unique('users')->ignore($this->user->id, 'id')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'إسم المستخدم يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المستخدم 100 حرف',


            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique' => 'البريد الإلكتروني الذي تم إدخالة بالفعل مسجل في قاعدة البيانات',
        ];

    }

    public function update()
    {
        $data = $this->validate($this->rules() ,$this->messages());



        $this->user->update($data);

        $this->reset(['name']);
        //dispatch browser events (js)
        //add event to toggle update modal after save
        $this->dispatch('editModalToggle');

        //refrsh data after adding update row
        $this->dispatch('refreshData')->to(DisplayUsers::class);

        $this->dispatch(
           'alert',
            text: 'تم تعديل بيانات المستخدم بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }
    public function render()
    {
        return view('livewire.users.update-user');
    }
}
