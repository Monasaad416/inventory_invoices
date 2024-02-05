@extends('admin.layouts.layout')

@push('css')

@endpush

@section('title')
    تعديل الإعدادات
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1345.6px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">  تعديل الإعدادات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row my-auto">
                    <div class="col-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                            <h3 class="card-title"> تعديل الإعدادات</h3>
                            </div>
                            <div class="bg-danger-outline">
                            @include('inc.errors')
                            </div>


                            <div class="card-body">
                                <form action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                     
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for='company_name_ar'>إسم الشركة</label><span class="text-danger">*</span>
                                                    <input type='text' name='company_name_ar' value="{{ old('company_name_ar',$settings->company_name_ar) }}" class= 'form-control mt-1 mb-3 @error('company_name_ar') is-invalid @enderror' placeholder = " {{ trans('admin.company_name_ar') }}">
                                                </div>
                                            </div>
                                    </div>
{{-- 
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for='phone'> {{ trans('admin.company_phone') }}</label><span class="text-danger">*</span>
                                                <input type='text' name='phone' value="{{ old('phone',$settings->phone) }}" class='form-control mt-1 mb-3 @error('phone') is-invalid @enderror' placeholder = "{{ trans('admin.company_phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for='email'>{{ trans('admin.company_email') }}</label>
                                                <input type='email' name='email' value="{{ old('email',$settings->email) }}" class='form-control mt-1 mb-3 @error('email') is-invalid @enderror' placeholder = "{{ trans('admin.company_email') }}">
                                            </div>
                                        </div>
                                    </div> --}}



                                   <div class="col">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">شعار الشركة</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mt-3">
                                                    <div class="col-lg-12 col-md-12">
                                                        <input type="file" name="testimonial_bg" class="dropify" data-show-loader="true" />
                                                    </div>
                                                </div>
                                            </div>

                                            @if($settings->testimonial_bg)
                                                <div class="d-flex justify-content-center mt-4">
                                                    <div style="display: block;">
                                                        <span class="dropify-render">
                                                            <img src="{{ asset('uploads/settings/'.$settings->testimonial_bg) }}"  width="300" alt="{{ $settings->company_name }}">
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>



                                <div class="col">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ trans('admin.footer_bg') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-md-12">
                                                    <input type="file" name="footer_bg" class="dropify" data-show-loader="true" />
                                                </div>
                                            </div>
                                        </div>

                                        @if($settings->footer_bg)
                                            <div class="d-flex justify-content-center mt-4">
                                                <div style="display: block;">
                                                    <span class="dropify-render">
                                                        <img src="{{ asset('uploads/settings/'.$settings->footer_bg) }}"  width="300" alt="{{ $settings->company_name }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ trans('admin.logo_head') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-md-12">
                                                    <input type="file" name="logo_head" class="dropify" data-show-loader="true" />
                                                </div>
                                            </div>
                                        </div>

                                        @if($settings->logo_head)
                                            <div class="d-flex justify-content-center mt-4">
                                                <div style="display: block;">
                                                    <span class="dropify-render">
                                                        <img src="{{ asset('uploads/settings/'.$settings->logo_head) }}"  width="300" alt="{{ $settings->company_name }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ trans('admin.logo_footer') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-md-12">
                                                    <input type="file" name="logo_footer" class="dropify" data-show-loader="true" />
                                                </div>
                                            </div>
                                        </div>

                                        @if($settings->logo_footer)
                                            <div class="d-flex justify-content-center mt-4">
                                                <div style="display: block;">
                                                    <span class="dropify-render">
                                                        <img src="{{ asset('uploads/settings/'.$settings->logo_footer) }}"  width="300" alt="{{ $settings->company_name }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ trans('admin.footer_slider_images') }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-md-12">
                                                    <input type="file" name="footer_slider_images[]"  class="dropify" data-show-loader="true" multiple/>
                                                </div>
                                            </div>
                                        </div>

                                        @if($settings->footer_slider_images)
                                            <div class="d-flex justify-content-center mt-4">
                                                <div style="display: block;">
                                                    <span class="dropify-render">
                                                        <img src="{{ asset('uploads/settings/'.$settings->footer_slider_images) }}"  width="300" alt="{{ $settings->company_name }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                    <input type="hidden" name="settings_id" value="{{$settings->id}}" />

                                    <div class="col-xs-12 col-sm-12 col-md-12 my-4 text-center">
                                        <button type="submit" class="btn btn-secondary">{{ trans('admin.edit') }}</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
        </section>

    </div>
@endsection

@push('script')

@endpush

