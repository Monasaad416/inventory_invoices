<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between py-3">
                        @if($products->count() > 0)
                            @can('EXCEL تصدير المنتجات الي')
                                <button type="button" class="btn bg-gradient-success mx-2" wire:click="exportProducts">
                                    <span>تصدير إلي EXCEL</span>
                                </button>
                            @endcan
                            @can('EXCEL استيراد المنتجات من')
                                <button type="button" class="btn bg-gradient-warning mx-2" data-toggle="modal" wire:click="$dispatch('importProducts')">
                                استيراد من  EXCEL
                                </button>
                            @endcan
                            @can('PDF تصدير المنتجات الي')
                                <button type="button" class="btn bg-gradient-danger mx-2" wire:click="exportToPDF">
                                    <span>تصدير إلي PDF</span>
                                </button>
                            @endcan
                        @endif
                   @can('إضافة منتج')
                    <button type="button" class="btn btn-lg bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة منتج">
                        <span style="font-weight: bolder; font-size:">+</span>
                    </button>
                    @endcan

                </div>




            </div>

            <div class="card-body">
                    <div class="d-flex my-3">
                        <input type="text" class="form-control w-25" placeholder="بحث بالإسم او الكود" wire:model.live="searchItem">
                        <select class="form-control w-25 mx-5" wire:model.live="filter">
                            <option value="">كل المنتجات</option>
                            <option value="inside_invoices">المجرودة</option>
                            <option value="outside_invoices">الغيرمجرودة</option>
                        </select>
                    </div>

          
                @if($products->count() > 0)

                    <style>
                        .table thead tr th{
                            text-align:center;
                        }
                    </style>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th>
                                الكود
                            </th>
                            <th>الإسم</th>
                            <th>الوحدة</th>
                            <th>الشد</th>
                            <th>سعر التكلفة</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                     @foreach ($products as $product)
                        <tr>
                            <td style="width:2%">{{$loop->iteration}}</td>
                            <td class="text-center" style="width:10%">
                                @if( $product->code_type == '1D')
                                    @php
                                        echo DNS1D::getBarcodeSVG($product->code, 'C39',1,45);
                                    @endphp
                                @endif

                                @if( $product->code_type == '2D')
                                    @php
                                        echo DNS2D::getBarcodeSVG($product->code ,'QRCODE',2,2)
                                    @endphp
                                    <br>
                                    <p class="text-center" style="font-size:12px;">{{$product->code}}</p>
                                @endif 
                            </td>
                            <td style="width:30%">{{ $product->name }}</td>
                            <td class="text-center" style="width:8%">{{ $product->unit->name }}</td>
                            <td style="width:10%">{{ $product->tension }}</td>
                            <td style="width:10%">{{ $product->price }}</td>
                            <td class="text-center" style="width:10%">
                                @can('تعديل منتج')
                                <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل"
                                    data-toggle="modal"
                                    wire:click="$dispatch('editProduct',{id:{{$product->id}}})">
                                    <i class="far fa-edit"></i>
                                </button>
                                @endcan
                                @can('حذف منتج')
                                <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                    data-toggle="modal"
                                    wire:click="$dispatch('deleteProduct',{id:{{$product->id}}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                                {{-- <button type="button" class="btn btn-outline-success btn-sm mx-1"  title="تغيير نوع الكود  "
                                    data-toggle="modal"
                                    wire:click="changeCode({{ $product->id }})">
                                    <i class="fas fa-exchange-alt"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="h4 text-muted text-center">لا يوجد منتجات للعرض</p>
                @endif


                <div class="d-flex justify-content-center my-4">
                    {{$products->links()}}
                </div>

            </div>
        </div>
    </div>

</div>





