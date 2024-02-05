<?php

namespace App\Livewire\Invoices;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use App\Notifications\InvoiceCreated;
use App\Events\NewInvoiceCreatedEvent;
use App\Livewire\Invoices\DisplayInvoices;
use App\Livewire\Products\DisplayProducts;
use Illuminate\Support\Facades\Notification;
use Alert;


class AddInvoice extends Component
{

    public $product, $product_id,$product_name, $product_code, $unit,$tension ,$qty='',$price,$code_type,$invoice_products=[];


    public function addDigit ($digit)
    {
        $this->qty .= $digit;
    }

    public function clearInputs ()
    {
        $this->product_code = "";
        $this->qty = "";
        $this->product_name = "";
    }

    public function clearQty ()
    {
        $this->qty = "";
    }


    public function fetchProductName()
    {
        //retrieve the product name based on the product code
        $product = Product::where('code', $this->product_code)->first();
        $this->product_name = $product ? $product->name : null;
    }
    public function rules() {
        return [
            'product_code' => "required|string|max:20|exists:products,code",
            'qty' => "required|numeric|between:0,999999.99",
        ];
    }

    public function messages()
    {
        return [
            'product_code.required' => 'كود المنتج مطلوب',
            'product_code.string' => 'كود المنتج يجب أن يتكون من أحرف',
            'product_code.max' => 'أقصي عدد احرف لكود المنتج 20 حرف',
            'product_code.exists' => 'الكود المدخل غير موجود بقاعدة البيانات',

            'qty.required' => 'كمية المنتج مطلوبة',
            'qty.numeric' => 'كمية المنتج  يجب أن تكون رقم ',
            'qty.between' =>'الكمية يجب ان تكون رقم بين 0-999999.99',
        ];
    }

    public function update() {
        $this->validate($this->rules(),$this->messages());

        $this->product = Product::where('code',$this->product_code)->first();
        $this->invoice_products[] = [
                'product_id'=> $this->product->id,
                'product_code'=> $this->product_code,
                'product_name'=> $this->product->name,
                'unit' => $this->product->unit->name,
                'tension' => $this->product->tension,
                'qty' => $this->qty ,
                'price' => $this->product->price,
                'code_type' => $this->product->code_type,
        ];
        //return dd($this->invoice_products);
         $this->clearInputs();
    }

// public function confirmDeleteItem()
// {
//     $confirmation = 'Are you sure you want to delete this item?';

//      $this->dispatch('confirmDelete', ['message' => $confirmation]);
// }
    public function removeItem($index)
    {
        unset($this->invoice_products[$index -1]);
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

    public function create() {
        DB::beginTransaction();
        try{


            $invoice = Invoice::create([
                'inv_number' => $this->getNextInvoiceNumber(),
                'inv_post' =>false,
                'status' => 'open',
            ]);
            foreach ($this->invoice_products as $item){
                InvoiceProduct::create([
                    'product_id'=> $item['product_id'],
                    'invoice_id'=> $invoice->id,
                    'product_code'=> $item['product_code'],
                    'product_name'=> $item['product_name'],
                    'unit' => $item['unit'],
                    'tension' => $item['tension'],
                    'qty' => $item['qty'] ,
                    'unit_price' => $item['price'] ,
                    'code_type' => $item['code_type'] ,
                ]);
            }

            $admins = User::where('roles_name','superadmin')->get();
            Notification::send($admins, new InvoiceCreated($invoice));

            NewInvoiceCreatedEvent::dispatch($invoice);
            //event(new NewInvoiceCreatedEvent($invoice));

            DB::commit();

            //session()->flash('success', 'تم إضافة فاتورة جرد جديدة بنجاح');
            Alert::success('تم إضافة فاتورة جرد جديدة بنجاح');

            return redirect()->route('invoices') ;




        } catch (Throwable $e) {
            DB::rollBack();
            report($e);

            return false;
        }
    }



    public function render()
    {
        return view('livewire.invoices.add-invoice');
    }
}
