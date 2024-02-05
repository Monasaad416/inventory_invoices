<?php

namespace App\Livewire\Invoices;

use Throwable;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceProduct;
use Alert;

class UpdateItem extends Component
{

    protected $listeners = ['editItem'];

    public $qty,$show1D,$show2D,$item,$product;

    public function addDigit ($digit)
    {
        $this->qty .= $digit;
    }

    public function clearQty ()
    {
        $this->qty = "";
    }
    public function editItem($id)
    {
        $this->item = InvoiceProduct::findOrFail($id);
        $this->product = Product::where('id',$this->item->product_id)->first();

        $this->qty = $this->item->qty;


        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [

            'qty' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'qty.required' => 'كمية المنتج  يجب أن تكون رقم ',
        ];

    }


    public function update()
    {
        $data = $this->validate($this->rules() ,$this->messages());

        try {
            //update item qty in pivot table
            $this->item->update($data);


            $this->reset(['qty']);
            //dispatch browser events (js)
            //add event to toggle update modal after save
            $this->dispatch('editModalToggle');

       
        Alert::success('تم تعديل كمية المنتج بنجاح');
        return redirect()->route('invoices.show',['id'=>$this->item->invoice_id]);
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    public function render()
    {
        return view('livewire.invoices.update-item');
    }
}
