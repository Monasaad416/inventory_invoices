@extends('admin.layouts.layout')

@section('title')
الرئيسية
@endsection

@section('content')


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">لوحة التحكم</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
              <li class="breadcrumb-item active">لوحة التحكم </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{App\Models\Product::count()}}</h3>

                <p>إجمالي عدد الاصناف </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('products')}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{App\Models\Unit::count()}}</h3>

                <p>عدد الوحدات</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('units')}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

<style>
  .bg-custom {
      background-color: #6962AD;
  }
</style>
          
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              @php
                  $invoiceProducts = App\Models\InvoiceProduct::pluck('product_id', 'id')->toArray();
                  $notInInvoiceProductsCount = App\Models\Product::whereNotIn('id', array_values($invoiceProducts))->count();
              @endphp

              <h3>{{ $notInInvoiceProductsCount }}</h3>

                <p>عدد الاصناف الغير مجرودة</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('products',['filter'=>'outside_invoices'])}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


        
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-custom">
              <div class="inner">
                <h3>{{App\Models\Invoice::all()->count()}}</h3>

                <p>عدد الفواتير </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('invoices',['statusFilter'=>''])}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
     

          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{App\Models\Invoice::where('status','open')->get()->count()}}</h3>

                <p>عدد الفواتير المفتوحة</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
                  <a href="{{route('invoices',['statusFilter'=>'open'])}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{App\Models\Invoice::where('status','archived')->get()->count()}}</h3>

                <p>عدد الفواتير المرحلة</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
                  <a href="{{route('invoices',['statusFilter'=>'archived'])}}" class="small-box-footer">المزيد<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    
          <!-- ./col -->

        </div>


        <!-- /.row -->
        <!-- Main row -->
        {{-- <div class="row">

          <!-- left col -->
          <section class="col-6 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  {{ trans('admin.latest_clients') }}
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: auto; width: 100%;">

                    <div class="">
                        <ul>
                        
                               <li> tt</li>
                                <li>yyy</li>
                
                        </ul>

                    </div></div>
              </div>
              <!-- /.card-body-->

            </div>
          </section>
          <!-- left col -->

            <!-- right col -->
          <section class="col-6 connectedSortable">
            <!-- Map card -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fa fa-users" aria-hidden="true"></i>
      
                 
                    {{ trans('admin.latest_products') }}
                   
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: auto; width: 100%;">

                    <div>
                        <ul>
    
                                @foreach (App\Models\Product::latest()->get()->take(10) as $product )
                               
                                            <li> {{$product->name}}</li>
                                 
                                @endforeach
                      
                        </ul>

                    </div>
                </div>
              </div>
              <!-- /.card-body-->

            </div>
          </section>
          <!-- right col -->
        </div> --}}
        <!-- /.row (main row) -->


        <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card card-dashboard-map-one d-flex justify-contenr-center align-items-center">
                {{-- <div style="width:75%; height: 60vh">
                    {!! $chartjs->render() !!}
                </div> --}}
            </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 
    <!-- /.content -->
  </div>

@endsection
