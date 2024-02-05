@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">

        @include('inc.errors')
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            {{-- <h1>قائمة المهام</h1> --}}
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
            <li class="breadcrumb-item active">المهام</li>
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
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">قائمة المهام </h4>

                                    <button type="button" class="btn btn-lg bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة مهمة">
                                        <span style="font-weight: bolder; font-size:">+</span>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body">
                                @if($roles->count() > 0)
                                    <style>
                                        tr , .table thead th  {
                                            text-align: center;
                                        }
                                    </style>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th style="width: 10px">#</th>
                                            <th>الإسم</th>
                                            <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>

                                                    @can('تفاصيل المهمة')
                                                    <button type="button" class="btn btn-outline-secondary btn-sm mx-1"  title="التفاصيل"
                                                        data-toggle="modal"
                                                        data-target="#show_modal_{{ $role->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @endcan
                                                    @can('تعديل مهمة')
                                                    <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل"
                                                        data-toggle="modal"
                                                        data-target="#edit_modal_{{$role->id}}">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    @endcan
                                                    @can('حذف مهمة')
                                                    <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                                        data-toggle="modal"
                                                        data-target="#delete_modal_{{$role->id}}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @endcan
                                                </td>

                                                @include('inc.show_role')
                                                @include('inc.edit_role')
                                                @include('inc.delete_role')
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <p class="h4 text-muted text-center">لا يوجد مهمات للعرض</p>
                                @endif


                                <div class="d-flex justify-content-center my-4">
                                    {{$roles->links()}}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @include('inc.create_role')
        </section>
    </div>
@endsection

@push('script')
    <script>
        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
