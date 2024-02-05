<?php

namespace App\Livewire\Products;

use Throwable;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceProduct;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UpdateProduct extends Component
{
    protected $listeners = ['editProduct'];
    public $name, $code, $unit_id, $tension, $product,$price,$code_type;


    public function editProduct($id)
    {
        $this->product = Product::findOrFail($id);

        $this->name = $this->product->name;
        $this->code = $this->product->code;
        $this->unit_id = $this->product->unit_id;
        $this->tension = $this->product->tension;
        $this->price = $this->product->price;
        $this->code_type = $this->product->code_type;


        //return dd($this->is_active);

        $this->resetValidation();

        //dispatch browser events (js)
        //add event to toggle edit modal after save
        $this->dispatch('editModalToggle');

    }

    public function rules() {
        return [
            'name' => "string|max:50",
            'code' => [
                'string',
                'max:20',
                Rule::unique('products')->ignore($this->product->id, 'id')
            ],
            'unit_id' => "exists:units,id",
            'tension' => "numeric",
            'price' => "numeric|min:0",
            'code_type' => "in:1D,2D"
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'إسم المنتج يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المنتج 50 حرف',

            'code.string' => 'كود المنتج يجب أن يتكون من أحرف',
            'code.max' => 'أقصي عدد احرف لكود المنتج 20 حرف',
            'code.unique' => 'الكود الذي تم إدخالة بالفعل مسجل في قاعدة البيانات',

            'unit_id.exists' => 'وحدة القياس المدخلة غير موجودة بقاعدة البيانات',

            'tension.numeric' => 'الشد  يجب أن يكون رقم ',

            'price.numeric' => 'سعر التكلفة يجب ان يكون رقم',
            'price.min' => 'سعر التكلفة يجب ان يكون أكبر من صفر',

            'code_type.in' => 'نوع الكود يجب أن يكون واحد من [1D,2D]',
        ];

    }

    public function update()
    {
        $data = $this->validate($this->rules() ,$this->messages());

        try {
            DB::beginTransaction();
            //update product info in products table
            $this->product->update($data);

            //update product info in invoice_product table
            $productInInvoices = InvoiceProduct::where('product_id', $this->product->id)->get();
            foreach ($productInInvoices as $pivotRow) {
                $pivotRow->update([
                    'product_name' => $this->product->name,
                    'product_code' => $this->product->code,
                    'unit' => $this->product->unit->name,
                    'tension' => $this->product->tension,
                    'unit_price' => $this->product->price,
                    'code_type' => $this->product->code_type,
                ]);
            }

            $this->reset(['name','code','unit_id','tension','price','code_type']);
            //dispatch browser events (js)
            //add event to toggle update modal after save
            $this->dispatch('editModalToggle');

            //refrsh data after adding update row
            $this->dispatch('refreshData')->to(DisplayProducts::class);

            $this->dispatch(
            'alert',
                text: 'تم تعديل المنتج بنجاح',
                icon: 'success',
                confirmButtonText: 'تم'
            );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return false;
        }

    }

    public function render()
    {
        return view('livewire.products.update-product');
    }
}
