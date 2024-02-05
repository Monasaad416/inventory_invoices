<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\InvoiceProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=['inv_number','inv_post','inv_post_date_time','status'];

    public function products ()
    {
        return $this->belongsToMany(Product::class, 'invoice_product')
        // ->with('timestamps')
        ->using(InvoiceProduct::class)
        ->withPivot('product_name','product_code','unit','tension','qty');
    }

        public static function getNextInvoiceNumber()
        {
            $year = Carbon::now()->year;
            $currentInvoiceNumber = Invoice::whereYear('created_at',$year)->max('inv_number');
            if($currentInvoiceNumber) {
                return $currentInvoiceNumber + 1;
            }

            return $year . '00001';
        }
}
