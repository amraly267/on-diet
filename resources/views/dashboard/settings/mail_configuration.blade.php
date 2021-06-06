<div class="tab-pane fade show" id="mail_configuration">

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_from_address')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="email" name="mail_from_address" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_from_address')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_from_address : old('mail_from_address')}}">
            <span class="help-block error-help-block input-error mail_from_address-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_from_name')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="text" name="mail_from_name" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_from_name')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_from_name : old('mail_from_name')}}">
            <span class="help-block error-help-block input-error mail_from_name-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_host')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="text" name="mail_host" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_host')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_host : old('mail_host')}}">
            <span class="help-block error-help-block input-error mail_host-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_port')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="text" maxlength="5" name="mail_port" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_port')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_port : old('mail_port')}}">
            <span class="help-block error-help-block input-error mail_port-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_username')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="text" name="mail_username" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_username')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_username : old('mail_username')}}">
            <span class="help-block error-help-block input-error mail_username-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_password')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="password" name="mail_password" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'mail_password')}}" value="{{$submitFormMethod == 'put' ? $settings->mail_password : old('mail_password')}}">
            <span class="help-block error-help-block input-error mail_password-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'mail_encryption')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="mail_encryption" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-mail_encryption" tabindex="-1" aria-hidden="true">
                <option @if($submitFormMethod == 'put' && $settings->mail_encryption == 'SSL') {{'selected'}} @endif value="SSL">SSL</option>
                <option @if($submitFormMethod == 'put' && $settings->mail_encryption == 'TLS') {{'selected'}} @endif value="TLS">TLS</option>
            </select>
            <span class="help-block error-help-block input-error default_country_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <div class="form-check form-switch form-check-custom form-check-solid">
            <label class="form-check-label col-lg-2 col-form-label fw-bold fs-6" for="flexSwitchDefault">
                {{trans(config('dashboard.trans_file').'send_welcome_email')}}
            </label>
            <input class="form-check-input" {{$submitFormMethod == 'put' && $settings->send_welcome_email == 0 ? '' : 'checked'}} type="checkbox" name="send_welcome_email" value="1" id="flexSwitchDefault"/>
        </div>
    </div>
    <!--end::Input group-->



</div>
