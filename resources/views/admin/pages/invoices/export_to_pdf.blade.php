


<!DOCTYPE html>
<html dir="rtl">

    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            thead {
                text-align: center;
            }

  
            .title{
                text-align:center;
                color: #bec3c9;
                text-decoration: underline;

            }

            .inv_text{
                font-weight: 900;
                color: #bec3c9;

            }
            .inv_total{
                text-align:center  !important;
                font-weight:bold  !important;
                font-size: 50px  !important;

            }

            .inv_total td {
                font-weight:bold;
                text-align:center;
                padding: 20px 0;
            }

            .text-success {
                color:green;
            }
              .text-danger {
                color:red;
            }



            table td, table th, table tr {
                border: 1px solid #c9c9c9 !important
            }
            table thead th{
                background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important;
                color: #fff !important;
                padding :20px 10px;
            }

            table td{
                padding :10px 5px;
            }

            .info{
                text-align:center;
            }

        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">       
                                    
                                                 
                                            
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <h2 class="title">فاتورة جرد</h2>
                                                    </div>
                                                         
                                            
                                                 
                                                     
                                                        <div class="info">
                                                            <h6>
                                                                <span class="inv_text"> رقم الجرد </span> : {!! "&nbsp;" !!}{{$invoice->inv_number}}
                                                            </h6>
                                                            @if($invoice->status == "open")
                                                                <h6>
                                                                    <span class="inv_text">التاريخ </span> : {!! "&nbsp;" !!}{{$invoice->created_at}}
                                                                </h6>
                                                            @else
                                                                <h6>
                                                                    <span class="inv_text">التاريخ </span> : {!! "&nbsp;" !!}{{$invoice->inv_post_date_time}}
                                                                </h6>
                                                            @endif
                                                            <h6>
                                                                <span class="inv_text">الحالة  </span>:<span class="text-{{$invoice->status == "open" ? "success" :"danger"}}"> {!! "&nbsp;" !!}{{$invoice->status == "open" ? "فاتورة مفتوحة":"فاتورة مرحلة"}}</span>
                                                            </h6>
                                                        </div>
                                                    
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:2%">#</th>
                                                                    <th style="width:18%">
                                                                        الكود
                                                                    </th>
                                                                    <th style="width:35%">الإسم</th>
                                                                    <th style="width:8%">الوحدة</th>
                                                                    <th style="width:8%">الشد</th>
                                                                    <th style="width:8%">السعر</th>
                                                                    <th style="width:8%">الإجمالي</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($invoiceProducts as $product)
                                                                    <tr>
                                                                        <td style="width:2%">{{$loop->iteration}}</td>
                                                                        <td style="width:18%;text-align:center">
                                                                            @if($product->code_type == '1D')
                                                                                {!! str_replace('<?xml version="1.0" standalone="no"?>', '', DNS1D::getBarcodeSVG($product->product_code, 'C39',1,44)) !!} 
                                                                            @endif

                                                                            @if($product->code_type == '2D')
                                                                                {!! str_replace('<?xml version="1.0" standalone="no"?>', '', DNS2D::getBarcodeSVG($product->product_code ,'QRCODE',3,3)) !!} 
                                                                                <br>
                                                                                <span style="font-size:12px;">{{$product->product_code}}</span>
                                                                            @endif       
                                                                        </td>

                                                                        <td style="width:35%">{{ $product->product_name }}</td>
                                                                        <td style="width:8% ;text-align:center">{{ $product->unit}}</td>
                                                                        <td style="width:8%">{{ $product->tension }}</td>
                                                                        <td style="width:8%">{{ number_format($product->unit_price,2) }}</td>
                                                                        <td style="width:8%">{{ number_format(($product->unit_price * $product->qty) ,2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                    @php
                                                                        $totalPrice = 0;
                                                                        foreach($invoiceProducts as $item) {
                                                                            $subTotal = $item->unit_price * $item->qty;
                                                                            $totalPrice += $subTotal;
                                                                        }

                                                                    @endphp
                                                                    <tr class="inv_total" style="background-color:#caced6"> 
                                                                        <td colspan="5">الإجمالي</td>
                                                                        <td  colspan="2">
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
                </section>
            </div>
        </div>
    </body>
</html>

