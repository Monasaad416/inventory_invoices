@extends('admin.layouts.layout')
@section('content')



    <div class="content-wrapper" style="min-height: 1302.4px;">
        <div class="my-2">
            @include('inc.messages')
        </div>
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            {{-- <h1> فواتير الجرد</h1> --}}
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
            <li class="breadcrumb-item active">فواتير الجرد </li>
            </ol>
            </div>
            </div>
            </div>
        </section>

        <section class="content">

            <div class="container-fluid">
                <livewire:invoices.display-invoices :statusFilter="$statusFilter ?? ''"/>
            </div>
        </section>

        <livewire:invoices.update-invoice/>
        <livewire:invoices.delete-invoice/>
        <livewire:invoices.archive-invoice/>
        <livewire:invoices.import-new-invoice/>


    </div>
@endsection


