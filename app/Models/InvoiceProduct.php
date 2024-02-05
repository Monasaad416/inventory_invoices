<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InvoiceProduct extends Pivot
{
    protected $table="invoice_product";
    protected $incremanting = true;

    use HasFactory;
    // protected $fillable=['product_name','product_code','qty'];


    public function product()
    {
       return $this->belongsTo('App\Models\Product')->withDefault([
        'name' => $this->product_name ,
       ]);
    }

    public function invoice()
    {
       return $this->belongsTo(Invoice::class);
    }
    public function unit ()
    {
        return $this->belongsTo(Unit::class, 'unit_id','id');
    }

}
