<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceProduct;

class PrintInvoiceController extends Controller
{
    public function print ($id)
    {
        $invoice = Invoice::where('id',$id)->first();
        $invoiceProducts = InvoiceProduct::where('invoice_id',$invoice->id)->get();
        return view('admin.pages.invoices.print',compact('invoice','invoiceProducts'));
    }
}
