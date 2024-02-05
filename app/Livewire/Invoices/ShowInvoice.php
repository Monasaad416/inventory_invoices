<?php

namespace App\Livewire\Invoices;

use Throwable;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;
use App\Livewire\Invoices\DisplayInvoices;
use App\Livewire\Products\DisplayProducts;
use App\Traits\AddInvoiceItem;
use PDF;
use Excel;
use App\Exports\InvoiceExport;
use App\Exports\InvoiceInfoExport;
use App\Exports\InvoiceItemsExport;
use Livewire\Attributes\On;

class ShowInvoice extends Component
{
    public $product, $product_id,$product_name, $product_code, $unit,$tension ,$qty='',$price,$code_type,$invoice_products=[],$invoice;
    // public $listeners = [''];
    // #[On('refreshShowInvoiceComponent.{invoice.id}')] 
    // public function refreshShowInvoiceComponent()
    // {
    //     dd('kkkk');
    //     $this->mount($this->invoice);
    // }




    public function mount($invoice)
    {
        //dd($this->invoice);
        $this->invoice = $invoice;
        $this->invoice_products = InvoiceProduct::where('invoice_id',$this->invoice->id)->get();
        //dd($this->invoice_products);
    }

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
        // Implement your logic here to retrieve the product name based on the product code
        // For example, you can fetch the product name from the database using the product code
        $product = Product::where('code', $this->product_code)->first();
        $this->product_name = $product ? $product->name : null;
    }
    public function rules() {
        return [
            // 'product_id' => "required|numeric|exists:products,id",
            'product_code' => "required|string|max:20|exists:products,code",
            'qty' => "required|numeric|between:0,999999.99",
         

        ];
    }

    public function messages()
    {
        return [
            // 'product_id.required' => 'إسم المنتج مطلوب',
            // 'product_id.exists' => 'إسم المنتج يجب أن يكون مسجل بقاعدة البيانات  ',

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

        $pivotRow = InvoiceProduct::where('product_id',$this->product->id)->where('invoice_id',$this->invoice->id)->first();
        if($pivotRow) {
            $pivotRow->update([
                'qty' => $pivotRow->qty + $this->qty
            ]);
        } else {
            InvoiceProduct::create([
                'invoice_id' => $this->invoice->id,
                'product_id' => $this->product->id,
                'product_code'=> $this->product_code,
                'product_name'=> $this->product->name,
                'unit' => $this->product->unit->name,
                'tension' => $this->product->tension,
                'qty' => $this->qty ,
                'unit_price' => $this->product->price,
                'code_type' => $this->product->code_type,
            ]);


        }

        $this->mount($this->invoice);

        $this->dispatch(
           'alert',
            text: 'تم إضافة بند لفاتورة الجرد بنجاح',
            icon: 'success',
            confirmButtonText: 'تم',
            timer : 5000

        );


         $this->clearInputs();
    }



    //Info Andd Items In 1 File(2sheets)
    // public function exportInvoiceToExcel()
    // {
    //     $inv_number= $this->invoice->inv_number;
    //     return Excel::download(new InvoiceExportMultibleSheets( $inv_number), 'invoice.xlsx');
    // }

    //Invoice Info Only(1 sheet in file)
    public function exportInvoiceInfoToExcel()
    {
        $inv_number= $this->invoice->inv_number;
        return Excel::download(new InvoiceInfoExport( $inv_number), 'invoiceInfo.xlsx');
    }


    //Invoice Items Only(1 sheet in file)
    public function exportInvoiceItemsToExcel()
    {
        $invoice_id = $this->invoice->id;
        return Excel::download(new InvoiceItemsExport($invoice_id), 'invoiceItems.xlsx');
    }



    public function exportInvoiceToPDF()
    {
        $invoiceProducts = InvoiceProduct::where('invoice_id',$this->invoice->id)->get();
        $pdf = PDF::loadView('admin.pages.invoices.export_to_pdf', ['invoiceProducts'=>$invoiceProducts , 'invoice' =>$this->invoice]);

        return response()->streamDownload(function () use ($pdf) {
            $pdf->stream();
            }, 'invoice.pdf');
    }





    public function render()
    {
        return view('livewire.invoices.show-invoice');
    }
}
