<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\InvoiceProduct;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithMapping,WithHeadings
{
    public $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
        // dd($this->name);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        //Product::with('unit')->select('name','code','unit_id','tension','price','code_type')->get();

            $products = Product::with('unit')->select('name','code','unit_id','tension','price','code_type')->where( function($query) {
                $invoiceProducts = InvoiceProduct::pluck('product_id', 'id')->toArray();
                //dd($invoiceProducts);
          
                    if($this->filter == "inside_invoices" ){ 
                    
                        $query->whereIn('id', array_values($invoiceProducts));
                    }

                    if($this->filter == "outside_invoices"){ 
                         
                        $query->whereNotIn('id', array_values($invoiceProducts));
                    }
          
     
         })->latest()->paginate(config('constants.paginationNo'));
         return $products;
    }


        public function map($product) : array {
            return [
                $product->name,
                $product->code,
                $product->unit['name'],
                $product->tension,
                $product->price,
                $product->code_type,
            ];
        }

        public function headings(): array
        {
              return [
                'name',
                'code',
                'unit',
                'tension',
                'price',
                'code type'
            ];
        }
}
