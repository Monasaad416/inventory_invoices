<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;

class DeleteUnit extends Component
{
    protected $listeners = ['deleteUnit'];
    public $unit ,$unitName;

    public function deleteUnit($id)
    {
        $this->unit = Unit::where('id',$id)->first();
    //dd($this->unit);
        $this->unitName = $this->unit->name;
        $this->dispatch('deleteModalToggle');

    }


    public function delete()
    {
        $unit = Unit::where('id',$this->unit->id)->first();

        $products = Product::where('unit_id',$this->unit->id)->get();
        if($products->count() > 0) {
            $this->dispatch('deleteModalToggle');
            $this->dispatch(
            'alert',
                text: 'عفوا لايمكن حذف وحدة القياس لوجود منتجات مرتبطة بها',
                icon: 'error',
                confirmButtonText: 'تم'

            );
        } else {
            $unit->delete();
            $this->reset('unit');
            //dispatch browser events (js)
            //add event to toggle delete modal after remove row
            $this->dispatch('deleteModalToggle');

            //refrsh data after delete row
            $this->dispatch('refreshData')->to(DisplayUnits::class);

            $this->dispatch(
            'alert',
                text: 'تم حذف وحدة القياس بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'

        );
        }


    }
    public function render()
    {
        return view('livewire.units.delete-unit');
    }
}
