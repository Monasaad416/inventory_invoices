<?php

namespace App\Imports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceImport implements WithMultipleSheets,WithHeadings
{
    public function sheets(): array
    {
        return [
            'invoice-info' => new InvoiceInfoImport(),
            'invoice-items' => new InvoiceItemsImport(),
        ];
    }
}




class InvoiceInfoImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        new Invoice([
            'inv_number'=> $rows['invoice_number'],
            'inv_post' => null,
            'invoice_post_date_time' =>null,
            'status'=> 'open',

        ]);
        
    }


    public function headings(): array
    {
        return [
            'invoice_number',
            'invoice_post',
            'invoice_post_date_time',
            'status',
        ];
    }
}


class InvoiceItemsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //
    }

    public function headings(): array
    {
        return [
            'invoice',
            'product_name',
            'product_code',
            'unit',
            'tesnsion',
            'qty',
            'unit_price',
            'code_type ',

        ];
    }
}
