@extends('admin.layouts.layout')
@push('css')
    <style>
        @media print {
            /* body {
            -webkit-print-color-adjust: exact !important;
              -webkit-print-color-adjust:exact !important;
            -webkit-print-color-adjust:exact !important;
            } */
            #print_button {
                display: none;
            }

            thead {
                text-align: center;
            }

            .borded_page{
                border: 1px dotted #bec3c9 !important;
                width: 100vw;
                height: 100vh;
            }
            .title{
                text-align:center;
                color: #bec3c9;
                text-decoration: underline;

            }

            .inv_text{
                font-weight: bolder;
                color: #bec3c9;
            }
            .inv_total{
                text-align:center  !important;
                font-weight:bolder  !important;
                font-size: 40px  !important;
                color:#bec3c9  !important;
            }

            /* .inv_total td{
                text-align:center  !important;
                font-weight:bolder  !important;
                font-size: 200x  !important;
                color:#bec3c9  !important;
                background-color: gray  !important;
            } */
        }
        .table thead th  {
            text-align: center;
        }
    </style>
    <style media="print" type="text/css">
        .inv_total td {
            background-color: gray !important;
        }
    </style>
@endpush
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
                        <div class="card" id="print">
                            <div class="borded_page">
                                <div class="card-body">
                                    <div class="row my-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <h2 class="title">فاتورة جرد</h2>
                                            </div>
                                        </div>
                                    </div>   
                
                                    <div class="row  my-5">
                                        <div class="col">
                                            <div class="text-center">
                                                <p>
                                                <span class="inv_text"> رقم الجرد </span> : {!! "&nbsp;" !!}{{$invoice->inv_number}}
                                                </p>
                                                @if($invoice->status == "open")
                                                    <p>
                                                        <span class="inv_text">التاريخ </span> : {!! "&nbsp;" !!}{{$invoice->created_at}}
                                                    </p>
                                                @else
                                                    <p>
                                                        <span class="inv_text">التاريخ </span> : {!! "&nbsp;" !!}{{$invoice->inv_post_date_time}}
                                                    </p>
                                                @endif
                                                <p>
                                                    <span class="inv_text">الحالة  </span>:
                                                    <span class="text-{{$invoice->status == "open" ? "success":"danger"}}" >{!! "&nbsp;" !!}{{$invoice->status == "open" ? "فاتورة مفتوحة":"فاتورة مرحلة"}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                
                                    <table class="table table-bordered  my-5">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%">#</th>
                                                <th style="width: 18%">الكود</th>
                                                <th style="width: 35%">الصنف</th>
                                                <th style="width: 8%">الوحدة</th>
                                                <th style="width: 8%">الشد</th>
                                                <th style="width: 8%">الكمية</th>
                                                <th style="width: 8%">السعر</th>
                                                <th style="width: 8%">الإجمالي</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoiceProducts as $item)
                                                <tr>
                                                    <td style="width: 2%">{{$loop->iteration}}</td>
                                                    <td style="width: 18% ; text-align:center">
                                                        @if($item['code_type'] == '1D')
                                                            @php
                                                                echo DNS1D::getBarcodeSVG($item->product_code, 'C39',1.5,45);
                                                            @endphp
                                                        @endif

                                                        @if($item['code_type'] == '2D')
                                                            @php
                                                                echo DNS2D::getBarcodeSVG($item->product_code ,'QRCODE',3,3)
                                                            @endphp
                                                            <br>
                                                            <span style="font-size:12px;">{{$item->product_code}}</span>
                                                        @endif                                                                    
                                                    </td>
                                                    <td style="width:35%">{{ $item->product_name }}</td>
                                                    <td style="width: 8% ; text-align:center;">{{ $item->unit }}</td>
                                                    <td style="width: 8%">{{ $item->tension }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td style="width: 8%">
                                                        {{number_format( $item->unit_price,2)}}
                                                    </td>
                                                    <td style="width: 8%">
                                                        {{ number_format(($item->unit_price * $item->qty)  ,2)}}
                                                    </td>
                                                </tr>
                                   
                                            @endforeach
                                            @php
                                                $totalPrice = 0;
                                                foreach($invoiceProducts as $item) {
                                                    $subTotal = $item->unit_price * $item->qty;
                                                    $totalPrice += $subTotal;
                                                }

                                            @endphp
                                            <tr class="inv_total"> 
                                                <td colspan="6">الإجمالي</td>
                                                <td  colspan="5">
                                                    {{ number_format($totalPrice,2)}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-secondary  float-left mt-3 mr-2" id="print_button" onclick="printDiv()"> <i class="fas fa-print ml-1"></i>طباعة</button>
            </div>
        </section>
        

              
    </div>
   
@endsection


@push('script')
     <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            
            location.reload();
        }
    </script>
@endpush
