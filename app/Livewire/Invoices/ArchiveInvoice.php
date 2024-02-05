<?php

namespace App\Livewire\Invoices;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvoiceArchived;
use App\Events\InvoiceArchivedEvent;

class ArchiveInvoice extends Component
{
    protected $listeners = ['archiveInvoice'];
    public $invoice ,$invoiceNumber,$productId;


    public function archiveInvoice($id)
    {
        $this->invoice = Invoice::findOrFail($id);
        $this->invoiceNumber = $this->invoice->inv_number;
        $this->dispatch('archiveModalToggle');
    }

    public function archive()
    {
        $this->invoice->update([
            'inv_post' => true,
            'inv_post_date_time' => Carbon::now() ,
            'status' => 'archived',

        ]);

        $this->dispatch('archiveModalToggle');


        $admins = User::where('roles_name','superadmin')->get();
        Notification::send($admins, new InvoiceArchived($this->invoice));
        InvoiceArchivedEvent::dispatch($this->invoice);



        //refrsh data after adding update row
        $this->dispatch('refreshData')->to(DisplayInvoices::class);

        $this->dispatch(
           'alert',
            text: 'تم ترحيل فاتروة الجرد بنجاح ',
            icon: 'success',
            confirmButtonText: 'تم'

        );
    }

    public function render()
    {
        return view('livewire.invoices.archive-invoice');
    }
}
