@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')

@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'roles')}}</h1>
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
        <a href="{{route('roles.index')}}" class="text-muted text-hover-primary">{{trans(config('dashboard.trans_file').'roles')}}</a>
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
    @include(config('dashboard.resource_folder').'roles.side_menu')

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
        <form action="{{$submitFormRoute}}" method="POST" id="adminForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            @csrf @method($submitFormMethod)
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <div class="tab-pane fade show active" id="more_info">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-1 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'name')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-11 fv-row fv-plugins-icon-container">
                            <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'name')}}" value="{{$submitFormMethod == 'put' ? $role->name : old('name')}}">
                            <span class="help-block error-help-block input-error name-error" style="color: red;"></span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-12 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'permissions')}}</label>
                        <span class="help-block error-help-block input-error permissions-error" style="color: red;"></span>
                        <!--end::Label-->
                    </div>
                    <!--end::Input group-->

                    @foreach($permissions as $key => $permission)
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Checkbox-->
                        <label class="mb-2 col-12 form-check form-check-custom form-check-solid me-10">
                            <span class="form-check-label fw-bold">{{trans(config('dashboard.trans_file').$permission->name)}}</span>
                        </label>
                        @foreach($permission->relatedPerm as $related)
                        <label class="mb-2 col-2 form-check form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-20px w-20px"{{$submitFormMethod == 'put' && in_array($related->id, $relatedPermissions)? 'checked':''}} type="checkbox" name="permissions[]" value="{{$related->id}}">
                            <span class="form-check-label fw-bold">{{$related->name}}</span>
                        </label>
                        @endforeach
                        <!--end::Checkbox-->
                    </div>
                    @endforeach
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
