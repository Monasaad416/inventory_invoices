<?php

namespace App\Exports;

use App\Models\InvoiceProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoiceItemsExport implements FromCollection, WithHeadings ,WithMapping
{
    public $invoice_id;

    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }
    public function collection()
    {

        return InvoiceProduct::with('invoice')
            ->where('invoice_id',$this->invoice_id)
            ->select('invoice_id','product_code','product_name','unit','tension','qty','unit_price','code_type')
            ->get();
    }

        public function map($item) : array {
            return [
                $item->product_name,
                $item->product_code,
                $item->unit,
                $item->tension,
                $item->qty,
                $item->unit_price,
                $item->code_type,
                $item->invoice['inv_number'],
            ];
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
            'code_type',
            'inv_number',
        ];
    }
}
