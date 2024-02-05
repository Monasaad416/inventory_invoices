<div>
     <style>
        .calc table {
            border: none;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        .calc input[type="button"] {
            width: 100%;
            padding: 10px 5px;
            background-color: #92969f;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
        }

        /* .calc input[type="text"] {
            padding: 20px 30px;
            font-size: 24px;
            font-weight: bold;
            border: none;
            border-radius: 5px;

        }  */
            .table thead th  {
            text-align: center;
        }
    </style>
    <form>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">

                @if($invoice->inv_post == false)
                    <div class="row">

                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="code">كود المنتج</label><span class="text-danger">*</span>
                                <input type="text" wire:model.lazy="product_code" wire:change="fetchProductName" class="form-control mt-1 mb-3 @error('product_code') is-invalid @enderror" placeholder="كود المنتج">
                                @include('inc.livewire_errors', ['property' => 'product_code'])
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="name">إسم المنتج</label><span class="text-danger">*</span>
                                <input type="text" wire:model.defer="product_name" class="form-control mt-1 mb-3 @error('product_name') is-invalid @enderror" placeholder="إسم المنتج" readonly>
                                @include('inc.livewire_errors', ['property' => 'product_name'])
                            </div>
                        </div>

                        <div class="col-12 mb-2 calc">
                            <div class="form-group">
                                <label for='unit'>الكمية </label><span class="text-danger"> *</span>
                                <table id="calcu" >
                                    <tr>
                                        <td colspan="9">
                                            <input type="text" wire:model="qty" class="form-control" readonly id="result">
                                            @include('inc.livewire_errors',['property'=>'qty'])
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" value="1" wire:click="addDigit('1')"> </td>
                                        <td><input type="button" value="2" wire:click="addDigit('2')"> </td>
                                        <td><input type="button" value="3" wire:click="addDigit('3')"> </td>
                                        <td><input type="button" value="." wire:click="addDigit('.')"> </td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" value="4" wire:click="addDigit('4')"> </td>
                                        <td><input type="button" value="5" wire:click="addDigit('5')"> </td>
                                        <td><input type="button" value="6" wire:click="addDigit('6')"> </td>
                                        <td><input type="button" value="c" wire:click="clearQty()" /> </td>
                                    </tr>
                                    <tr>
                                        <td><input type="button" value="7" wire:click="addDigit('7')"> </td>
                                        <td><input type="button" value="8" wire:click="addDigit('8')"> </td>
                                        <td><input type="button" value="9" wire:click="addDigit('9')"> </td>
                                        <td><input type="button" value="0" wire:click="addDigit('0')"> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><input type="button" value="-" wire:click="addDigit('-')"> </td>
                                    </tr>

                                </table>
                            </div>
                            @include('inc.livewire_errors',['property'=>'unit'])
                        </div>



                        <div class="d-flex justify-content-center align-content-center">
                            <button wire:click.prevent="update" class="btn btn-warning mt-1">إضافة بند </button>
                        </div>
                    </div>
                    <hr>
                @endif
            </div>
            <div class="col-3"></div>
        </div>




        <div class="d-flex justify-content-right py-3">
            @can('Excel تصدير الفاتورة الي')
                <button type="button" class="btn bg-gradient-info mx-2" wire:click="exportInvoiceInfoToExcel">
                    <span>تصدير بيانات الفاتورة إلي EXCEL</span>
                </button>

                <button type="button" class="btn bg-gradient-success mx-2" wire:click="exportInvoiceItemsToExcel">
                    <span>تصدير بنود الفاتورة إلي EXCEL</span>
                </button>
            @endcan
            @can('Excel استيراد بنود للفاتورة من')
                @if(!$invoice->inv_post == 1)
                    <button type="button" class="btn bg-gradient-warning mx-2" data-toggle="modal" wire:click="$dispatch('importInvoiceItemsFromExcel',{ id: {{$invoice->id}} })">
                        استيراد بنود من  EXCEL
                    </button>
                @endif
            @endcan

            @can('PDF تصدير الفاتورة الي')
                <button type="button" class="btn bg-gradient-danger mx-2" wire:click="exportInvoiceToPDF()">
                    <span>تصدير بنود الفاتورة إلي PDF</span>
                </button>
            @endcan
        </div>



        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>الكود</th>
                    <th>الصنف</th>
                    <th>الوحدة</th>
                    <th>الشد</th>
                    <th>الكمية</th>
                    <th>سعر الوحدة</th>
                    <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($invoice_products as $item)
                        <tr>
                            <td style="width:2%">{{$loop->iteration}}</td>
                            <td style="width:14%;text-align:center">  
                                @if( $item['code_type'] == '1D')
                                    @php
                                        echo DNS1D::getBarcodeSVG($item->product_code, 'C39',2,45);
                                    @endphp
                                @endif

                                @if($item['code_type'] == '2D')
                                    @php
                                        echo DNS2D::getBarcodeSVG($item->product_code ,'QRCODE',2,2)
                                    @endphp
                                    <br>
                                    <span style="font-size:12px;">{{$item->product_code}}</span>
                                @endif
                            </td>
                            <td style="width:34%">{{ $item->product_name }}</td>
                            <td style="width:10%;text-align:center">{{ $item->unit }}</td>
                            <td style="width:10%">{{ $item->tension }}</td>
                            <td style="width:10%">{{ $item->qty }}</td>
                            <td style="width:10%">{{ $item->unit_price }}</td>
                            <td style="width:10% ;text-align:center">
                                @if($invoice->inv_post == false)
                                <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل الكمية"
                                    data-toggle="modal"
                                    wire:click="$dispatch('editItem',{id:{{$item->id}}})">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                    data-toggle="modal"
                                    wire:click="$dispatch('deleteItem',{id:{{$item->id}}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @else
                                    <p class="text-danger">فاتورة مرحلة</p>
                                       <br>
                                        {{ $invoice->status == 'archived' ? Carbon\Carbon::parse($invoice->inv_post_date_time)->format('d-m-Y ') : ''}}

                                        {{ $invoice->status == 'archived' ? Carbon\Carbon::parse($invoice->inv_post_date_time)->format('h:i A') : ''}}
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>


    </form>
</div>
