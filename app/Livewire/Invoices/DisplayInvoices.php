<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayInvoices extends Component
{
    use WithPagination;
    public $searchItem;
    public $statusFilter;
    public $listeners = ['refreshData' =>'$refresh'];


    
    public function render($statusFilter='')
    {
        $invoices = Invoice::select('id','inv_number','inv_post','inv_post_date_time','status')
         ->where( function($query) {
            if(!empty($this->searchItem)){
                $query->where('inv_number','like','%'.$this->searchItem.'%');

            }
            if(!empty($this->statusFilter) ) {
                if($this->statusFilter == "" ){   
                    $query->get();
                }
                if($this->statusFilter == "open" ){ 
                    //dd('open');
                    $query->where('status','open');
                }

                if($this->statusFilter == "archived"){ 
                    // dd('archived');
                    $query->where('status', 'archived');
                }
            };

        })->latest()->paginate(config('constants.paginationNo'));

        return view('livewire.invoices.display-invoices', ['invoices'=>$invoices]);
}

}
