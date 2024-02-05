@extends('admin.layouts.layout')
@section('content')
    
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <div class="py-2">
            @include('inc.messages')
        </div>
       
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            {{-- <h1>قائمة فولاتير الجرد</h1> --}}
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
            @php
                $invoice = App\Models\Invoice::where('id',$id)->first();
            @endphp
            <li class="breadcrumb-item active"> تفاصيل فاتورة جرد رقم {!! "&nbsp;" !!}{{ $invoice->inv_number }}   </li>
            </ol>
            </div>
            </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            {{-- <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">قائمة فواتير الجرد</h4>
                                    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة بند للفاتورة">
                                        <span style="font-weight: bolder; font-size:">+</span>
                                    </button>
                                </div>

                            </div> --}}

                            <div class="card-body">
                                <livewire:invoices.show-invoice :invoice="$invoice"/>
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:invoices.update-item/>
                <livewire:invoices.delete-item/>
                <livewire:invoices.import-invoice-items @saved="$refresh"/>
            </div>
        </section>
    </div>
@endsection
