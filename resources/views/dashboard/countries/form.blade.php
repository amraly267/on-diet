@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')

@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'countries')}}</h1>
<!--end::Title-->
<!--begin::Separator-->
<span class="h-20px border-gray-200 border-start mx-4"></span>
<!--end::Separator-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin-home')}}" class="text-muted text-hover-primary">{{trans(config('dashboard.trans_file').'home')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('countries.index')}}" class="text-muted text-hover-primary">{{trans(config('dashboard.trans_file').'countries')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-dark">{{$pageTitle}}</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
@endsection

<div class="row">
    @include(config('dashboard.resource_folder').'countries.side_menu')
    <div class="card col-10 mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{$pageTitle}}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form action="{{$submitFormRoute}}" method="POST" id="countryForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            @csrf @method($submitFormMethod)
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <div class="tab-pane fade show active" id="more_info">
                    <!--begin::Input group-->
                    <div class="card-toolbar mb-5">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                            <li class="nav-item">
                                <a id="name_en_tab" class="nav-link active" data-bs-toggle="tab" href="#name_en">{{trans(config('dashboard.trans_file').'name_en')}}</a>
                            </li>
                            <li class="nav-item">
                                <a id="name_ar_tab" class="nav-link" data-bs-toggle="tab" href="#name_ar">{{trans(config('dashboard.trans_file').'name_ar')}}</a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'flag')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-flag.svg')}})">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $country->flag_path : asset('img/dashboard/default-flag.svg')}})"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="flag" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="flag_remove">
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'cancel')}}">
                                <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'remove_image')}}">
                                <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <br>
                            <span class="help-block error-help-block input-error flag-error" style="color: red;"></span>
                            <!--end::Image input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="name_en" role="tabpanel">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'name_en')}}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                    <input type="text" name="name[en]" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'name_en')}}" value="{{$submitFormMethod == 'put' ? $country->getTranslation('name', 'en') : old('name_en')}}">
                                    <span class="help-block error-help-block input-error name-en-error" style="color: red;"></span>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="tab-pane fade" id="name_ar" role="tabpanel">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'name_ar')}}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                    <input type="text" name="name[ar]" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'name_ar')}}" value="{{$submitFormMethod == 'put' ? $country->getTranslation('name', 'ar') : old('name_ar')}}">
                                    <span class="help-block error-help-block input-error name-ar-error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'name_code')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-10 fv-row fv-plugins-icon-container">
                            <input type="text" minlength="2" maxlength="3" name="name_code" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'name_code')}}" value="{{$submitFormMethod == 'put' ? $country->name_code : old('name_code')}}">
                            <span class="help-block error-help-block input-error name_code-error" style="color: red;"></span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'phone_code')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-10 fv-row fv-plugins-icon-container">
                            <input type="tel" minlength="3" maxlength="3" name="phone_code" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'phone_code')}}" value="{{$submitFormMethod == 'put' ? $country->phone_code : old('phone_code')}}">
                            <span class="help-block error-help-block input-error phone_code-error" style="color: red;"></span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <label class="form-check-label col-lg-2 col-form-label fw-bold fs-6" for="flexSwitchDefault">
                                {{trans(config('dashboard.trans_file').'status')}}
                            </label>
                            <input class="form-check-input" {{$submitFormMethod == 'put' && $country->status == 0 ? '' : 'checked'}} type="checkbox" name="status" value="1" id="flexSwitchDefault"/>
                        </div>
                    </div>
                    <!--end::Input group-->
                </div>
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-white btn-active-light-primary me-2" onclick="window.location.reload()">{{trans(config('dashboard.trans_file').'cancel')}}</button>
                <button type="submit" class="btn btn-primary" id="saveBtn">
                    <span class="spinner-border spinner-border-sm align-middle ms-2 d-none"></span>
                    {{trans(config('dashboard.trans_file').'save')}}
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
    </div>
</div>

@endsection

@push('footer-scripts')
    <script>
        // === save changes ===
        $('#saveBtn').on('click', function(){

            function beforeSend()
            {
                $('.input-error').hide();
                $('#saveBtn .spinner-border').removeClass('d-none');
                $('#countryForm *').prop('disabled', true);
                $('#name_en-tab').removeAttr('style');
                $('#name_ar-tab').removeAttr('style');
            }
            function afterComplete()
            {
                $('#saveBtn .spinner-border').addClass('d-none');
                $('#countryForm *').prop('disabled', false);
            }
            function successResponse()
            {
                Swal.fire({
                    icon: 'success',
                    title: callResponse.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
            function errorResponse()
            {
                $.each(callResponse.responseJSON.errors, function(index, value) {
                    index = index.replace(".", "-");

                    if($('.'+index+'-error').length)
                    {
                        var parents = $('.'+index+'-error').parents().find('.tab-pane');

                        console.log(parents);

                        parents.each(function(i, obj){
                            if($(obj).find($('.'+index+'-error')).length)
                            {
                                $(document).ready(function(){
                                    $('[href="#'+$(obj).attr('id')+'"]').tab('show');
                                });
                            }
                        })

                        $('.'+index+'-error').show();
                        $('.'+index+'-error').text(value);
                    }
                });
            }
            submitForm($('#countryForm')[0], beforeSend, afterComplete, successResponse, errorResponse)
        })
        // === End script ===
    </script>
@endpush
