<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    @can('Excel استيراد فاتورة من')
                        <button type="button" class="btn bg-gradient-success mx-2" data-toggle="modal" wire:click="$dispatch('importNewInvoiceFromExcel')">
                            استيراد فاتورة من  EXCEL
                        </button>
                    @endcan
                    @can('إضافة فاتورة')
                    <a href="{{ route('invoices.create') }}" class="text-white">
                        <button type="button" class="btn bg-gradient-primary"  style="border-radius: 50%" title="إضافة فاتورة">
                            <span style="font-weight: bolder; font-size:">+</span>
                        </button>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                    <div class="d-flex my-3">
                        <input type="text" class="form-control w-25" placeholder="بحث  برقم الفاتورة " wire:model.live="searchItem">
        
                        <select class="form-control w-25 mx-4" wire:model.live="statusFilter">
                            <option value="all">بحث بحالة الفاتورة</option>
                            <option value="open">فاتورة مفتوحة</option>
                            <option value="archived">فاتورة مرحلة</option>
                        </select>
                    </div>
                @if($invoices->count() > 0)


                    <style>
                        tr , .table thead th  {
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th>رقم الفاتورة</th>
                            <th>تاريخ وتوقيت الفاتورة</th>
                            <th> الحالة</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{ $invoice->inv_number }}
                                    </td>
                                    <td>
                                    {{ Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y ') }}
                                    <br>
                                    {{ Carbon\Carbon::parse($invoice->created_at)->format('h:i A') }}
                                    </td>
           
                                    <td class="text-{{ $invoice->status == 'open' ? 'success': 'danger' }}">
                                        {{ $invoice->status == 'open' ? 'مفتوحة': 'مرحلة' }}
                                        <br>
                                        {{ $invoice->status == 'archived' ? Carbon\Carbon::parse($invoice->inv_post_date_time)->format('d-m-Y ') : ''}}
                                        <br>
                                        {{ $invoice->status == 'archived' ? Carbon\Carbon::parse($invoice->inv_post_date_time)->format('h:i A') : ''}}
                                    </td>
                                    <td>
                                        @can('تفاصيل الفاتورة')
                                        <a href="{{ route('invoices.show',['id' => $invoice->id]) }}">
                                            <button type="button" class="btn btn-outline-secondary btn-sm mx-1" title="إختيار">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>
                                        @endcan
                                        @can('حذف فاتورة')
                                        <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                            data-toggle="modal"
                                            {{-- data-target="#delete_modal"  --}}
                                            wire:click="$dispatch('deleteInvoice',{id:{{$invoice->id}}})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endcan
                                        @can('ترحيل فاتورة')
                                        <button type="button" class="btn btn-outline-info btn-sm mx-1" {{!$invoice->inv_post == true ? '' :'disabled'}}  title="ترحيل"
                                            data-toggle="modal"
                                            {{-- data-target="#delete_modal"  --}}
                                            wire:click="$dispatch('archiveInvoice',{id:{{$invoice->id}}})">
                                            <i class="fas fa-file-archive"></i>
                                        </button>
                                        @endcan
                                        @can('طباعة فاتورة')
                                        <a href="{{ route('invoices.print',['id' => $invoice->id]) }}">
                                            <button type="button" class="btn btn-outline-secondary btn-sm mx-1" title="طباعة">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </a>
                                        @endcan



                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="h4 text-muted text-center">لا يوجد فواتير للعرض</p>
                @endif


                <div class="d-flex justify-content-center my-4">
                    {{$invoices->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
