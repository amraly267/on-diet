@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')
@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'settings')}}</h1>
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
    <li class="breadcrumb-item text-dark">{{$pageTitle}}</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
@endsection
<div class="row">

    @include(config('dashboard.resource_folder').'settings.side_menu')

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
                    <div class="tab-content">
                        @include(config('dashboard.resource_folder').'settings.logo_tab')
                        @include(config('dashboard.resource_folder').'settings.appearance_tab')
                        @include(config('dashboard.resource_folder').'settings.mail_configuration')
                        @include(config('dashboard.resource_folder').'settings.contacts_info')
                        @include(config('dashboard.resource_folder').'settings.social_media')
                        @include(config('dashboard.resource_folder').'settings.custome_css_js')
                        @include(config('dashboard.resource_folder').'settings.countries_languages')
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
    $(document).ready(function(){
        // The DOM elements you wish to replace with Tagify
        var supported_countries = document.querySelector("#supported_countries");
        new Tagify(supported_countries, {
            whitelist: {!! json_encode($tagifyCountriesNames) !!},
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false// <- do not hide the suggestions dropdown once an item has been selected
            }
        });

        var supported_locales = document.querySelector("#supported_locales");
        new Tagify(supported_locales, {
            whitelist: ['English', 'Arabic'],
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false// <- do not hide the suggestions dropdown once an item has been selected
            }
        });
    })

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
        submitForm($('#countryForm')[0], beforeSend, afterComplete, successResponse, errorResponse)
    })
    // === End script ===
</script>
@endpush
