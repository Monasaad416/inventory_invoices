@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.4px;">

        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            {{-- <h1> المنتجات</h1> --}}
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
            <li class="breadcrumb-item active">المنتجات</li>
            </ol>
            </div>
            </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
  
                <livewire:products.display-products :filter="$filter ?? ''" :key="$filter?? ''" />
            </div>
        </section>

        <livewire:products.add-product/>
        <livewire:products.update-product/>
        <livewire:products.delete-product/>
        <livewire:products.import-products/>
    </div>
@endsection
