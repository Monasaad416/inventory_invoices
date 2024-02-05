<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Livewire\Component;

class DeleteInvoice extends Component
{
    protected $listeners = ['deleteInvoice'];
    public $invoice ,$invoiceNumber,$productId;

    public function deleteInvoice($id)
    {
        $this->invoice = Invoice::where('id',$id)->first();
        $this->invoiceNumber = $this->invoice->inv_number;
        $this->dispatch('deleteModalToggle');
    }


    public function delete()
    {
        Invoice::where('id',$this->invoice->id)->first();
        $items = InvoiceProduct::where('invoice_id',$this->invoice->id)->get();
        foreach($items as $item) {
            $item->delete();
        }

        $this->invoice->delete();
        $this->reset('invoice');
        //dispatch browser events (js)
        //add event to toggle delete modal after remove row
        $this->dispatch('deleteModalToggle');

        //refrsh data after delete row
        $this->dispatch('refreshData')->to(DisplayInvoices::class);

        $this->dispatch(
           'alert',
            text: 'تم حذف فاتورة الجرد بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }
    public function render()
    {
        return view('livewire.invoices.delete-invoice');
    }
}
