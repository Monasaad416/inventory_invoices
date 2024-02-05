<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExportMultibleSheets implements WithMultipleSheets
{
    public $inv_number, $inv_post, $inv_post_date_time, $status;

    public function __construct($inv_number)
    {
        $this->inv_number = $inv_number;
    }

    public function sheets(): array
    {
        $sheets = [];
        $invoice = Invoice::where('inv_number', $this->inv_number)
            ->first();

        // Add the Invoice sheet
        $sheets[] = new InvoiceSheet($invoice);

        // Add the InvoiceItems sheet
        $sheets[] = new InvoiceItemsSheet($invoice);

        return $sheets;
    }
}

class InvoiceSheet implements FromCollection, WithHeadings
{
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function collection()
    {
        return collect([
            [$this->invoice->inv_number,
                $this->invoice->inv_post,
                $this->invoice->inv_post_date_time,
                $this->invoice->status,
                $this->invoice->created_at 
            ]
        ]);
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

class InvoiceItemsSheet implements FromCollection, WithHeadings
{
    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function collection()
    {
        // dd($this->invoice->id);
        $invoiceItems = InvoiceProduct::where('invoice_id', $this->invoice->id)
        ->select('product_code','product_name','unit','tension','qty','unit_price','code_type')
        ->get();
        return $invoiceItems;
    }

    public function headings(): array
    {
        return [
            'الكود',
            'الاسم',
            'الوحدة',
            'الشد',
            'الكمية',
            'سعر تكلفة الوحدة',
            'نوع الكود'
        ];
    }
}