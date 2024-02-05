<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\InvoiceProduct;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoiceItemsImport implements ToModel,WithHeadingRow,WithHeadings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $products ,$invoice_id;

    public function __construct($invoice_id)
    {
        $this->products = Product::all();
        $this->invoice_id = $invoice_id;
    }

    public function model(array $row)
    {
        $product = $this->products->firstWhere('name', $row['product_name']);

        if (!$product) {
            // Product not found, you can handle the error here
            return null;
        }

        return new InvoiceProduct([
            'invoice_id' => $this->invoice_id,
            'product_id' => $product->id,
            'product_name' => $row['product_name'],
            'product_code' => $row['product_code'],
            'unit' => $row['unit'],
            'tension' => $row['tension'],
            'qty' => $row['qty'],
            'unit_price' => $row['unit_price'],
            'code_type' => $row['code_type'],
        ]);
    }


    public function headings(): array
    {
        return [
            'product_name',
            'product_code',
            'unit',
            'tension',
            'qty',
            'unit_price',
            'code_type ',
        ];
    }
}
