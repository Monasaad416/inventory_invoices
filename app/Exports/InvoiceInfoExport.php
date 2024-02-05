<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceInfoExport implements FromCollection, WithHeadings
{
    public $inv_number;


    public function __construct($inv_number)
    {
        $this->inv_number = $inv_number;
    }
    public function collection()
    {
        return Invoice::where('inv_number',$this->inv_number)
        ->select('inv_number','inv_post','inv_post_date_time','status','created_at')
        ->get();
    }


      public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'مرحلة',
            'وقت تاريخ الترحيل',
            'الحالة',
            'تاريخ الإنشاء',
        ];
    }
}
