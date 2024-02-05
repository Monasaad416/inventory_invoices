<?php

namespace App\Livewire\Invoices;

use Throwable;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use Alert;

class DeleteItem extends Component
{
    protected $listeners = ['deleteItem'];
    public $invoice ,$invoiceNumber,$itemName,$item;

    public function deleteItem($id)
    {   
        $this->dispatch('deleteModalToggle');
        $this->item = InvoiceProduct::where('id',$id)->first();
        $this->itemName = $this->item->product_name;
        $this->invoice = Invoice::where('id',$this->item->invoice_id)->first();
    }


    public function delete()
    {
        try{
            if ($this->invoice->products()->count() == 1 ) {
 
                $this->item->delete();
                $this->invoice->delete();
           

                $this->dispatch('deleteModalToggle');


                Alert::success('تم حذف البند و فاتورة الجرد بنجاح');
                return redirect()->route('invoices');

            } else {

                    $this->item->delete();

                    $this->dispatch('deleteModalToggle');

                    Alert::success('تم حذف بند من الفاتورة بنجاح');
                    return redirect()->route('invoices.show',['id'=>$this->item->invoice_id]);
            }

        } catch (Throwable $e) {
            DB::rollBack();
            report($e);

            return false;
        }
    }
    public function render()
    {
        return view('livewire.invoices.delete-item');
    }
}
