<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Products\DisplayProducts;

class AddProduct extends Component
{
    public $name, $code, $unit_id, $tension,$price,$code_type;

    public function rules() {
        return [
            'name' => "required|string|max:50",
            'code' => "required|string|max:20|unique:products",
            'unit_id' => "required|exists:units,id",
            'tension' => "required|numeric",
            'price' => "required|numeric|min:0",
            'code_type' => "required|in:1D,2D"

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'إسم المنتج مطلوب',
            'name.string' => 'إسم المنتج يجب أن يتكون من أحرف',
            'name.max' => 'أقصي عدد احرف لإسم المنتج 50 حرف',

            'code.required' => 'كود المنتج مطلوب',
            'code.string' => 'كود المنتج يجب أن يتكون من أحرف',
            'code.max' => 'أقصي عدد احرف لكود المنتج 20 حرف',
            'code.unique' => 'الكود الذي تم إدخالة بالفعل مسجل في قاعدة البيانات',

            'unit_id.required' => 'وحدة قياس المنتج مطلوبة',
            'unit_id.exists' => 'وحدة القياس المدخلة غير موجودة بقاعدة البيانات',

            'tension.required' => 'الشد  مطلوب',
            'tension.numeric' => 'الشد  يجب أن يكون رقم ',

            'price.required' => 'سعر تكلفة المنتج مطلوب',
            'price.numeric' => 'سعر التكلفة يجب ان يكون رقم',
            'price.min' => 'سعر التكلفة يجب ان يكون أكبر من صفر',


            'code_type.required' => 'نوع كود المنتج مطلوب',
            'code_type.in' => 'نوع الكود يجب أن يكون واحد من [1D,2D]',
        ];

    }

    public function create()
    {
        $this->validate($this->rules() ,$this->messages());
        //return dd($this->unit_id);

//   $path = Storage::putFile("exams", $request->file('img'));

        $product  = Product::create([
            'name' => $this->name,
            'code' => $this->code,
            'unit_id' => $this->unit_id,
            'tension' => $this->tension,
            'price' => $this->price,
            'code_type' => $this->code_type,
        ]);

        $this->reset(['name','code','unit_id','tension','price','code_type']);



        //dispatch browser events (js)
        //add event to toggle create modal after save
        $this->dispatch('createModalToggle');


        //refrsh data after adding new row
        $this->dispatch('refreshData')->to(DisplayProducts::class);

        $this->dispatch(
           'alert',
            text: 'تم إضافة منتج جديد بنجاح',
            icon: 'success',
            confirmButtonText: 'تم'
        );



    }

    public function render()
    {
        return view('livewire.products.add-product');
    }
}
