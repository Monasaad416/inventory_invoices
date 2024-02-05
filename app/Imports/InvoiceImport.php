<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceProduct;
use Illuminate\Support\Collection;
use App\Notifications\InvoiceCreated;
use App\Events\NewInvoiceCreatedEvent;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoiceImport implements ToModel, WithHeadingRow, WithHeadings
{
    private $invoice;

    public function __construct()
    {
        $year = Carbon::now()->year;
        $lastInvoiceNum = Invoice::whereYear('created_at', $year)->max('inv_number');
        $newInvoiceNum = $lastInvoiceNum ? $lastInvoiceNum + 1 : $year . '00001';

        $this->invoice = Invoice::create([
            'inv_number' => $newInvoiceNum,
            'inv_post' => 0,
            'inv_post_date_time' => null,
            'status' => 'open',
        ]);
    }

    public function model(array $row)
    {
        $product = Product::where('name', $row['product_name'])->first();
        $invoiceProduct = new InvoiceProduct([
            'invoice_id' => $this->invoice->id,
            'product_id' => $product->id,
            'unit' => $row['unit'],
            'product_name' => $row['product_name'],
            'product_code' => $row['product_code'],
            'tension' => $row['tension'],
            'qty' => $row['qty'],
            'unit_price' => $row['unit_price'],
            'code_type' => $row['code_type'],
        ]);

        $invoiceProduct->save();

        return $invoiceProduct;
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
        ];
    }
}
