


<!DOCTYPE html>
<html dir="rtl">

    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="text-muted">
        <div class="wrapper">
            <div class="content-wrapper" style="min-height: 1302.4px;">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">       
                                        <style>
                                             .table thead th , {
                                                text-align: center;
                                            }
                                            table td, table th, table tr {
                                                border: 1px solid #c9c9c9 !important
                                            }
                                        </style>
                                        <h1 class="my-3">قائمة المنتجات</h1>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:2%">#</th>
                                                    <th style="width:28%">
                                                        الكود
                                                    </th>
                                                    <th style="width:40%">الإسم</th>
                                                    <th style="width:10%">الوحدة</th>
                                                    <th style="width:10%">الشد</th>
                                                    <th style="width:10%">السعر</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td style="width:2%">{{$loop->iteration}}</td>
                                                        <td style="width:28%; text-align:center">
                                                            @if($product->code_type == '1D')
                                                               
                                                                    {!! str_replace('<?xml version="1.0" standalone="no"?>', '', DNS1D::getBarcodeSVG($product->code, 'C39',1,44)) !!} 
                                                               
                                                            @endif

                                                            @if($product->code_type == '2D')
                                                              
                                                                {!! str_replace('<?xml version="1.0" standalone="no"?>', '', DNS2D::getBarcodeSVG($product->code ,'QRCODE',3,3)) !!} 
                                                                <div class="text-center">
                                                                    <span style="font-size:10px">{{$product->code}}</span>
                                                                </div>
                                                             
                                                            @endif 
                                                                       
                                                        </td>

                                                        <td style="width:40%">{{ $product->name }}</td>
                                                        <td style="width:10%;text-align:center">{{ $product->unit->name }}</td>
                                                        <td style="width:10% ; padding-right: 20px;">{{ $product->tension }}</td>
                                                        <td style="width:12% ; padding-right: 20px;">{{ $product->price }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

