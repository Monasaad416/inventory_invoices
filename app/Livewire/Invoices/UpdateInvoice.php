<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class UpdateInvoice extends Component
{
    protected $listeners = ['editInvoice'];
    public $inv_number, $product_name=[] ,$product_code=[],$qty=[], $invoice,$name,$code,$unit,$tension;


    public function editInvoice($id)
    {
        $this->invoice = Invoice::findOrFail($id);
        //return dd($this->invoice->products);

        $this->inv_number = $this->invoice->inv_number;
        foreach($this->invoice->products as $product) {
            $this->product_name = $product->name;
            $this->product_code = $product->code;
            $this->qty = $product->qty;
        }


        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [
            'inv_number' => "nullable|string",
        ];
    }

    public function messages()
    {
        return [
            'inv_number.string' => 'إسم المنتج يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المنتج 50 حرف',


        ];

    }

    public function update()
    {
        $data = $this->validate($this->rules() ,$this->messages());



        $this->invoice->update($data);

        $this->reset(['name','code','unit','tension']);
        //dispatch browser events (js)
        //add event to toggle update modal after save
        $this->dispatch('editModalToggle');

        //refrsh data after adding update row
        $this->dispatch('refreshData')->to(DisplayInvoices::class);

        $this->dispatch(
           'alert',
            text: 'تم تعديل المنتج بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }

    public function render()
    {
        return view('livewire.invoices.update-invoice');
    }
}
