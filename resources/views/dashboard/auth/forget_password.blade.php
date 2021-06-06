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
            <form id="forgetPasswordForm" action="{{route('admin-submit-forget-password')}}" method="post">
                @csrf @method('post')
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">{{trans(config('dashboard.trans_file').'forget_password')}}</h1>
                    <div class="text-gray-400 fw-bold fs-4">{{trans(config('dashboard.trans_file').'enter_email_to_reset_password')}}</div>
                    <!--end::Title-->
                    <span class="help-block error-help-block input-error credential-error" style="color: red;"></span>
                </div>
                <!--begin::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="form-label fs-6 fw-bolder text-dark">{{trans(config('dashboard.trans_file').'email')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input class="form-control form-control-lg form-control-solid" type="email" placeholder="{{trans(config('dashboard.trans_file').'email')}}" name="email" autocomplete="off" />
                    <!--end::Input-->
                    <span class="help-block error-help-block input-error email-error" style="color: red;"></span>
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <!--begin::Submit button-->
                    <button type="submit" id="forgetPasswordBtn" class="btn btn-lg btn-primary w-100 mb-5">
                        {{trans(config('dashboard.trans_file').'send_reset_password_link')}}
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
        // === Forget password ===
        $('#forgetPasswordBtn').on('click', function(){
            function beforeSend()
            {
                $('.input-error').hide();
                $('#forgetPasswordBtn .spinner-border').removeClass('d-none');
                $('#forgetPasswordForm *').prop('disabled', true);
            }
            function afterComplete()
            {
                $('#forgetPasswordBtn .spinner-border').addClass('d-none');
                $('#forgetPasswordForm *').prop('disabled', false);
            }
            function successResponse()
            {
                Swal.fire({
                    icon: 'success',
                    title: callResponse.message,
                    confirmButtonText: "{{trans(config('dashboard.trans_file').'ok')}}",
                });
                // $('#forgetPasswordForm')[0].reset();
            }
            function errorResponse()
            {
                $.each(callResponse.responseJSON.errors, function(index, value) {
                    if($('.'+index+'-error').length)
                    {
                        $('.'+index+'-error').show();
                        $('.'+index+'-error').text(value);
                    }
                });
            }
            submitForm($('#forgetPasswordForm')[0], beforeSend, afterComplete, successResponse, errorResponse)
        })
        // === End script ===
    </script>
@endpush
