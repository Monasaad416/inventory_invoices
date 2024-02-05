<?php

namespace App\Livewire\Invoices;

use Alert;
use Excel;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\InvoiceImport;
use App\Imports\InvoiceItemsImport;
use App\Notifications\InvoiceCreated;
use App\Events\NewInvoiceCreatedEvent;
use App\Livewire\Invoices\ShowInvoice;
use Illuminate\Support\Facades\Notification;

class ImportNewInvoice extends Component
{
    use WithFileUploads;
    public $file ;
    protected $listeners = ['importNewInvoiceFromExcel'];



    public function importNewInvoiceFromExcel()
    {
        $this->reset(['file']);
        $this->resetValidation();

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
    public function storeImportedInvoice()
    {
        $this->validate($this->rules() ,$this->messages());
        //dd ($this->file);
        Excel::import(new InvoiceImport(), $this->file);

        $this->reset(['file']);
        $this->resetValidation();
        //dispatch browser events (js)
        //add event to toggle import modal after save
        $this->dispatch('importModalToggle');


        //refrsh data after adding new row
        $this->dispatch('refreshData')->to(DisplayInvoices::class);



        $this->dispatch(
           'alert',
            text: 'تم إضافة فاتورة جرد جديدة بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }


    public function render()
    {
        return view('livewire.invoices.import-new-invoice');
    }
}
