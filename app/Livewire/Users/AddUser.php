<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Livewire\Users\DisplayUsers;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    public $name, $email, $password,$password_confirmation, $roles_name,$price,$email_type;

    public function rules() {
        return [
            'name' => "required|string|max:100",
            'email' => "required|string|email|max:100|unique:users,email",
            'password' => "required|string|min:5|max:25",
            'password_confirmation' => 'required|same:password',
            'roles_name' => "required|exists:roles,name",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم المستخدم مطلوب',
            'name.string' => 'إسم المستخدم يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المستخدم 100 حرف',

            'email.required' => 'البريد الإلكتروني للمستخدم مطلوب',
            'email.string' => 'البريد الإلكتروني  يجب أن يتكون من أحرف',
            'email.max' => 'أقصي عدد احرف للبريد الإلكتروني  100 حرف',
            'email.unique' => 'البريد الإلكتروني الذي تم إدخالة بالفعل مسجل في قاعدة البيانات',

            'password.required' => 'كلمة المرور مطلوبة',
            'password.string' => ' كلمة المرور يجب أن يتكون من أحرف وأرقام',
            'password.min' => ' كلمة المرور يجب أن لا تقل عن 5 أحرف    ',
            'password.max' => ' كلمة المرور يجب أن لا تزيد عن 25 حرف    ',
            'password_confirmation.same' => 'كلمة المرور وتأكيد كلمة المرور غير متطابقين ',
            'password_confirmation.required' => ' تأكيد  كلمة المرور مطلوب',

            'roles_name.required' => 'مهمة المستخدم مطلوبة ',
            'roles_name.exists' => 'مهمة المستخدم التي تم اخيارها غير موجودة بقاعدة البيانات',
        ];

    }

    public function create()
    {
        $this->validate($this->rules() ,$this->messages());
        //return dd($this->password);

//   $path = Storage::putFile("exams", $request->file('img'));

        $user  = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'roles_name' => $this->roles_name,
        ]);



        $user->assignRole($this->roles_name);

        $this->reset(['name','email','password','roles_name']);





        //dispatch browser events (js)
        //add event to toggle create modal after save
        $this->dispatch('createModalToggle');


        //refrsh data after adding new row
        $this->dispatch('refreshData')->to(DisplayUsers::class);

        $this->dispatch(
           'alert',
            text: 'تم إضافة مستخدم جديد بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'
        );



    }

    public function render()
    {
        return view('livewire.users.add-user');
    }
}
