<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InvoiceProduct;

class ProductOutsideInvoiceController extends Controller
{
    public function filterProducts()
    {
        $invoiceProducts = InvoiceProduct::pluck('product_id', 'id')->toArray();
        $products = Product::whereNotIn('id', array_values($invoiceProducts))->paginate(15);
        return view('admin.pages.products.outside_invoices',compact('products'));
    }
}
