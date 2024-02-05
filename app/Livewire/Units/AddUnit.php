<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;
use Illuminate\Validation\Rule;

class AddUnit extends Component
{
    public $name,$id;

    public function rules() {
        return [
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('units')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم الوحدة مطلوب',
            'name.string' => 'إسم الوحدة يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم الوحدة 10 أحرف',
            'name.unique' => 'وحدة القياس المدخلة بالفعل مسجلة في قاعدة البيانات',
        ];

    }

    public function create()
    {
        $this->validate($this->rules() ,$this->messages());
        //return dd($this->is_active);



        Unit::create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);



        //dispatch browser events (js)
        //add event to toggle create modal after save
        $this->dispatch('createModalToggle');


        //refrsh data after adding new row
        $this->dispatch('refreshData')->to(DisplayUnits::class);

        $this->dispatch(
           'alert',
            text: 'تم إضافة وحدة قياس جديدة بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'
        );
    }


    public function render()
    {
        return view('livewire.units.add-unit');
    }
}
