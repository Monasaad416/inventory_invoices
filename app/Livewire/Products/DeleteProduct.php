<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceProduct;

class DeleteProduct extends Component
{
    protected $listeners = ['deleteProduct'];
    public $product ,$productName;

    public function deleteProduct($id)
    {
        $this->product = Product::where('id',$id)->first();

        $this->productName = $this->product->name;
        $this->dispatch('deleteModalToggle');

    }


    public function delete()
    {
        $prod = Product::where('id',$this->product->id)->first();

        $invoiceProducts = InvoiceProduct::where('product_id' ,$prod->id)->get();
        if( $invoiceProducts->count() > 0 ){
           $this->dispatch('deleteModalToggle');
                $this->dispatch(
                'alert',
                text: ' عفوا لايمكن حذف المنتج لوجود فواتير جرد مرتبطة به ',
                icon: 'error',
                confirmButtonText: 'تم'
            );
        } else {

            $prod->delete();
            $this->reset('product');
            //dispatch browser events (js)
            //add event to toggle delete modal after remove row
            $this->dispatch('deleteModalToggle');

            //refrsh data after delete row
            $this->dispatch('refreshData')->to(DisplayProducts::class);

            $this->dispatch(
            'alert',
                text: 'تم حذف المنتج بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'

            );
        }

    }
    public function render()
    {
        return view('livewire.products.delete-product');
    }
}
