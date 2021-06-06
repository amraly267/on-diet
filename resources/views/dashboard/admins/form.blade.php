@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')

@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'admins')}}</h1>
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
        <a href="{{route('admins.index')}}" class="text-muted text-hover-primary">{{trans(config('dashboard.trans_file').'admins')}}</a>
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
    @include(config('dashboard.resource_folder').'admins.side_menu')

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
        <!--begin::Content-->
        <div id="kt_account_profile_details" class="collapse show">
            <!--begin::Form-->
            <form action="{{$submitFormRoute}}" method="POST" id="adminForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf @method($submitFormMethod)
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="tab-pane fade show active" id="more_info">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'image')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-user.svg')}})">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $admin->image_path : asset('img/dashboard/default-user.svg')}})"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="image_remove">
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
                                <span class="help-block error-help-block input-error image-error" style="color: red;"></span>
                                <!--end::Image input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'name')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'name')}}" value="{{$submitFormMethod == 'put' ? $admin->name : old('name')}}">
                                <span class="help-block error-help-block input-error name-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'country')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <select id="country_id" name="country_id" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-country" tabindex="-1" aria-hidden="true">
                                @foreach($countries as $country)
                                <option data-phone_code="{{$country->phone_code}}" @if($submitFormMethod == 'put' && $admin->country_id == $country->id) {{'selected'}} @endif value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                                </select>
                                <span class="help-block error-help-block input-error country_id-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6 mobile">{{trans(config('dashboard.trans_file').'mobile')}} {{'('.$countries[0]['phone_code'].')'}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <input type="tel" minlength="9" maxlength="12" name="mobile" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mobile')}}" value="{{$submitFormMethod == 'put' ? $admin->mobile : old('mobile')}}">
                                <span class="help-block error-help-block input-error mobile-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'email')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'email')}}" value="{{$submitFormMethod == 'put' ? $admin->email : old('email')}}">
                                <span class="help-block error-help-block input-error email-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'password')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'password')}}" value="">
                                @if($submitFormMethod == 'put')
                                <span class="help-block error-help-block" style="color: rgb(167, 161, 161);">
                                {{trans(config('dashboard.trans_file').'let_password_empty')}}
                                </span><br>
                                @endif
                                <span class="help-block error-help-block input-error password-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'confirm_password')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <input type="password" name="confirm_password" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'confirm_password')}}" value="">
                                @if($submitFormMethod == 'put')
                                <span class="help-block error-help-block" style="color: rgb(167, 161, 161);">
                                {{trans(config('dashboard.trans_file').'let_password_empty')}}
                                </span><br>
                                @endif
                                <span class="help-block error-help-block input-error confirm_password-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'gender')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <select name="gender" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-gender" tabindex="-1" aria-hidden="true">
                                <option @if($submitFormMethod == 'put' && $admin->gender == 'male') {{'selected'}} @endif value="male">{{trans(config('dashboard.trans_file').'male')}}</option>
                                <option @if($submitFormMethod == 'put' && $admin->gender == 'female') {{'selected'}} @endif value="female">{{trans(config('dashboard.trans_file').'female')}}</option>
                                </select>
                                <span class="help-block error-help-block input-error gender-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'role')}}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                <select @if(request()->has('role')) {{'disabled'}} @endif name="role" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-role" tabindex="-1" aria-hidden="true">
                                @foreach($roles as $role)
                                <option @if(($submitFormMethod == 'put' && $admin->roles[0]->id == $role->id) || request()->role == $role->name || request()->role_id == $role->id ) {{'selected'}} @endif value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                                </select>
                                <span class="help-block error-help-block input-error role-error" style="color: red;"></span>
                            </div>
                            <!--end::Col-->
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
        <!--end::Content-->
    </div>
</div>

@endsection

@push('footer-scripts')
    <script>
        // === Get selected country phone code ===
        $('#country_id').change(function(){
            var phoneCode = $(this).find(":selected").data('phone_code');
            $('.mobile').append('('+phoneCode+')');
        });
        // === End script ===

        // === save changes ===
        $('#saveBtn').on('click', function(){
            function beforeSend()
            {
                $('.input-error').hide();
                $('#saveBtn .spinner-border').removeClass('d-none');
                $('#adminForm *').prop('disabled', true);
            }
            function afterComplete()
            {
                $('#saveBtn .spinner-border').addClass('d-none');
                $('#adminForm *').prop('disabled', false);
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
                    if($('.'+index+'-error').length)
                    {
                        var parents = $('.'+index+'-error').parents().find('.tab-pane')
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
            submitForm($('#adminForm')[0], beforeSend, afterComplete, successResponse, errorResponse)
        })
        // === End script ===
    </script>
@endpush
