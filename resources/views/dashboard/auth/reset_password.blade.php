@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{asset('img/dashboard/progress-hd.png')}})">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->
        <a href="#" class="mb-12">
            <img alt="Logo" src="{{$logo}}" class="h-45px" />
        </a>
        <!--end::Logo-->
        <!--begin::Wrapper-->
        <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form id="resetPasswordForm" action="{{route('admin-submit-reset-password')}}" method="post">
                @csrf @method('post')

                <input type="hidden" name="email" value="{{request()->email}}"/>
                <input type="hidden" name="token" value="{{request()->token}}"/>

                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">{{trans(config('dashboard.trans_file').'reset_password')}}</h1>
                    <!--end::Title-->
                    <span class="help-block error-help-block input-error credential-error" style="color: red;"></span>
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label fs-6 fw-bolder text-dark">{{trans(config('dashboard.trans_file').'password')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="{{trans(config('dashboard.trans_file').'password')}}" name="password" autocomplete="off" />
                    <!--end::Input-->
                    <span class="help-block error-help-block input-error password-error" style="color: red;"></span>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack mb-2">
                        <!--begin::Label-->
                        <label class="form-label fw-bolder text-dark fs-6 mb-0">{{trans(config('dashboard.trans_file').'confirm_password')}}</label>
                        <!--end::Label-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Input-->
                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="{{trans(config('dashboard.trans_file').'confirm_password')}}" name="confirm_password" autocomplete="off" />
                    <!--end::Input-->
                    <span class="help-block error-help-block input-error confirm_password-error" style="color: red;"></span>
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" id="resetPasswordBtn" class="btn btn-lg btn-primary w-100 mb-5">
                        {{trans(config('dashboard.trans_file').'save')}}
                        <span class="spinner-border spinner-border-sm align-middle ms-2 d-none"></span></span>
                    </button>
                    <!--end::Submit button-->
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
</div>
@endsection

@push('footer-scripts')
    <script>
        // === Reset password ===
        $('#resetPasswordBtn').on('click', function(){

            function beforeSend()
            {
                $('.input-error').hide();
                $('#resetPasswordBtn .spinner-border').removeClass('d-none');
                $('#resetPasswordForm *').prop('disabled', true);
            }
            function afterComplete()
            {
                $('#resetPasswordBtn .spinner-border').addClass('d-none');
                $('#resetPasswordForm *').prop('disabled', false);
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
                    window.location.href = callResponse.redirect;
                }, 1000);
            }
            function errorResponse()
            {
                $.each(callResponse.responseJSON.errors, function(index, value) {
                    if(index == 'email' || index == 'token')
                    {
                        window.location.reload();
                    }
                    else if($('.'+index+'-error').length)
                    {
                        $('.'+index+'-error').show();
                        $('.'+index+'-error').text(value);
                    }
                });
            }
            submitForm($('#resetPasswordForm')[0], beforeSend, afterComplete, successResponse, errorResponse)
        })
        // === End script ===
    </script>
@endpush
