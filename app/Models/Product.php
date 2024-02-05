<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','code','unit_id','tension','price','code_type'];


    public function invoices ()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product')
        // ->with('timestamps')
        ->using(InvoiceProduct::class)
        ->withPivot('product_name','product_code','unit_id','tension','qty','code_type','price');
    }


    public function unit ()
    {
        return $this->belongsTo(Unit::class, 'unit_id','id')->withDefault([
        'name' => 'لايوجد',
        ]);
    }
}
