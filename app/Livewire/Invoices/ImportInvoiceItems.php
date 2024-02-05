<?php

namespace App\Livewire\Invoices;
use Livewire\WithFileUploads;
use Livewire\Component;
use Excel;
use App\Imports\InvoiceItemsImport;
use App\Models\Invoice;
use App\Models\Product;
use App\Livewire\Invoices\ShowInvoice;
use Alert;

class ImportInvoiceItems extends Component
{
    use WithFileUploads;
    public $file ,$invoice_id;
    protected $listeners = ['importInvoiceItemsFromExcel'];



    public function importInvoiceItemsFromExcel($id)
    {
        $this->reset(['file']);
        $this->resetValidation();
        $this->invoice_id = $id;

        $this->dispatch('importModalToggle');
    }
    public function rules() {
        return [
            'file'=>'required|max:50000|mimes:xlsx,application/excel,csv'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'لم يتم اختيار ملف للتحميل',
            'file.max' => 'أقصي حجم للملف يجب الا يتعدي 50MB',
            'file.mimes' => 'يجب تحميل ملف إكسل  ذات امتداد .xlsx',
        ];

    }
    public function storeImportedItems()
    {
        $this->validate($this->rules() ,$this->messages());
        //dd ($this->file);
        Excel::import(new InvoiceItemsImport($this->invoice_id), $this->file);

        $this->reset(['file']);
        $this->resetValidation();
        //dispatch browser events (js)
        //add event to toggle import modal after save
        $this->dispatch('importModalToggle');


        //refrsh data after adding new row
        // $this->dispatch('refreshData')->to(ShowInvoice::class);

        //$this->dispatch('refreshShowInvoiceComponent', id: $this->invoice_id);
        Alert::success('تم إستيراد بنود إضافية للفاتورة بنجاح');
        return redirect()->route('invoices.show',['id'=>$this->invoice_id]);
    }


    
    public function render()
    {
        return view('livewire.invoices.import-invoice-items');
    }
}
