<?php

namespace App\Livewire\Products;

use Excel;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use PDF;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\Response;

class DisplayProducts extends Component
{
    use WithPagination;
    public $listeners = ['refreshData' =>'$refresh'];

    public $product,$name,$code,$unit_id,$tension,$price,$code_type ,$searchItem,$filter;

    
    public function mount($filter = null)
    {
        $this->filter = $filter;
    }

    public function changeFilter($value)
    {
        $this->filter = $value;
        $this->emit('updateQueryString', ['filter' => $value]);
    }


    

    public function updatingSearchItem()
    {
        $this->resetPage();
    }

    // protected $queryString = [
    //     'filter' => [

    //     ]
    //     ];


    // public function changeCode($id)
    // {
    //     $this->product = Product::findOrFail($id);

    //     $this->product->update([
    //         'show1D' => !$this->product['show1D'],
    //         'show2D' => !$this->product['show2D'],
    //     ]);
    // }


    public function exportProducts()
    {

        $name= $this->name;
        $code = $this->code;
        $unit_id = $this->unit_id;
        $tension = $this->tension;
        $price = $this->price;
        $code_type = $this->code_type;
        $filter = $this->filter;
        //dd($filter);

        return Excel::download(new ProductsExport( $filter), 'products.xlsx');
    }




    public function exportToPDF()
    {
            $products = Product::select('id','name','unit_id','price','tension','code','code_type')->where( function($query) {
            $invoiceProducts = InvoiceProduct::pluck('product_id', 'id')->toArray();
                if(!empty($this->filter) ) {
                    if($this->filter == "" ){   
                        $query->get();
                    }
                    if($this->filter == "inside_invoices" ){ 
                        $query->whereIn('id', array_values($invoiceProducts));
                    }

                    if($this->filter == "outside_invoices"){ 
                        $query->whereNotIn('id', array_values($invoiceProducts));
                    }
                };
     
         })->latest()->paginate(config('constants.paginationNo'));
        $pdf = PDF::loadView('admin.pages.products.export_to_pdf', compact('products'));

        return response()->streamDownload(function () use ($pdf) {
            $pdf->stream();
            }, 'products.pdf');


    //    return response()->stream(function () use ($pdf) {
    //         $pdf->stream();
    //     }, 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'attachment; filename="products.pdf"',
    //     ]);
    }
    public function render()
    {
        
         $products = Product::select('id','name','unit_id','price','tension','code','code_type')->where( function($query) {
            $invoiceProducts = InvoiceProduct::pluck('product_id', 'id')->toArray();
                           if(!empty($this->searchItem )){ 
                        $query->where('name','like','%'.$this->searchItem.'%')->orWhere('code','like','%'.$this->searchItem.'%');
                    }
                if(!empty($this->filter) ) {
                    if($this->filter == "" ){   
                        $query->get();
                    }
                    if($this->filter == "inside_invoices" ){ 
                        $query->whereIn('id', array_values($invoiceProducts));
                    }

                    if($this->filter == "outside_invoices"){ 
                        $query->whereNotIn('id', array_values($invoiceProducts));
                    }
                };
     
         })->latest()->paginate(config('constants.paginationNo'));


            // $productsInInvoices = Product::whereIn('id', array_values($invoiceProducts))->paginate(config('constants.paginationNo'));
            // $productsOutsideInvoices = Product::whereNotIn('id', array_values($invoiceProducts))->paginate(config('constants.paginationNo'));



        return view('livewire.products.display-products',[
            'products'=> $products,'filter'=>$this->filter]);
    }
}
