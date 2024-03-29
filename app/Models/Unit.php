<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable=['name'];
    use HasFactory;

    public function products ()
    {
        return $this->hasMany(Product::class);
    }
}
