<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{
    protected $listeners = ['showProduct'];
    public $name, $code, $unit, $tension, $product;


    public function showProduct($id)
    {
        $this->product = Product::findOrFail($id);

        $this->name = $this->product->name;
        $this->code = $this->product->code;
        $this->unit = $this->product->unit;
        $this->tension = $this->product->tension;

    //return dd($this->product);




        //dispatch browser events (js)
        //add event to toggle show modal
        $this->dispatch('showModalToggle');

    }
    public function render()
    {
        return view('livewire.products.show-product');
    }
}
