<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UpdateUnit extends Component
{
    protected $listeners = ['editUnit'];
    public $name, $unit;

    public function editUnit($id)
    {
        $this->unit = Unit::findOrFail($id);

        $this->name = $this->unit->name;



        //return dd($this->is_active);

        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('units')->ignore($this->unit->id, 'id')
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'إسم الوحدة يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم الوحدة 10 أحرف',
            'name.unique' => 'وحدة القياس المدخلة بالفعل مسجلة في قاعدة البيانات',
        ];

    }

    public function update()
    {
        $data = $this->validate($this->rules() ,$this->messages());



        $this->unit->update($data);

        $this->reset(['name']);
        //dispatch browser events (js)
        //add event to toggle update modal after save
        $this->dispatch('editModalToggle');

        //refrsh data after adding update row
        $this->dispatch('refreshData')->to(DisplayUnits::class);

        $this->dispatch(
           'alert',
            text: 'تم تعديل وحدة القياس بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }
    public function render()
    {
        return view('livewire.units.update-unit');
    }
}
