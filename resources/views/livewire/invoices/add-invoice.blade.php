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

    </style>
    <form wire:submit.prevent="create">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
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
            </div>
            <div class="col-3"></div>

        </div>

        @if(count($invoice_products) > 0)
            <div class="card-body">
                <style>
                    tr , .table thead th  {
                        text-align: center;
                    }
                </style>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>الكود</th>
                        <th>الصنف</th>
                        <th>الوحدة</th>
                        <th>الشد</th>
                        <th>الكمية</th>
                        <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice_products as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>

                                <td>
                                    <div style="display: flex; justify-content: center; margin:10px 0 ;">
                                    @php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                    @endphp
                                        @if($item['code_type'] == '1D')
                                            {!! $generator->getBarcode($product->code, $generator::TYPE_CODE_128) !!}
                                        @endif
                                        @if($item['code_type'] == '2D')
                                            {!! DNS2D::getBarcodeHTML($item['product_code'] ,'QRCODE',3,3) !!}
                                        @endif
                                    </div>
                                    <p>{{ $item['product_code'] }}</p>
                                </td>
                                <td>{{ $item['product_name'] }}</td>
                                <td>{{ $item['unit']}}</td>
                                <td>{{ $item['tension'] }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>
                               <button type="button" class="btn btn-outline-danger btn-sm mx-1" title="حذف"
                                    data-toggle="modal" wire:click="removeItem({{ $loop->iteration}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">حفظ الفاتورة</button>
            </div>
        @endif
    </form>



</div>
