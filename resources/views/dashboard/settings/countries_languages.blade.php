<div class="tab-pane fade show" id="countries_languages">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'supported_countries')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input class="form-control form-control-solid" name="supported_countries" value="{{$tagifyCountriesValues}}" id="supported_countries"/>
            <span class="help-block error-help-block input-error supported_countries-error" style="color: red;"></span>
        </div>
    </div>
    <!--end::Col-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'default_country')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="default_country_id" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-country" tabindex="-1" aria-hidden="true">
            @foreach($countries as $country)
            <option @if($submitFormMethod == 'put' && $settings->default_country_id == $country->id) {{'selected'}} @endif value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
            </select>
            <span class="help-block error-help-block input-error default_country_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'supported_locales')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input class="form-control form-control-solid" name="supported_locales" value="{{$settings->supported_locales}}" id="supported_locales"/>
            <span class="help-block error-help-block input-error supported_locales-error" style="color: red;"></span>
        </div>
    </div>
    <!--end::Col-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'default_locale')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="default_locale" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-locale" tabindex="-1" aria-hidden="true">
                <option @if($submitFormMethod == 'put' && $settings->default_locale == 'en') {{'selected'}} @endif value="en">{{trans(config('dashboard.trans_file').'english')}}</option>
                <option @if($submitFormMethod == 'put' && $settings->default_locale == 'ar') {{'selected'}} @endif value="ar">{{trans(config('dashboard.trans_file').'arabic')}}</option>
            </select>
            <span class="help-block error-help-block input-error default_language-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'default_timezone')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="timezone_id" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-timezone" tabindex="-1" aria-hidden="true">
            @foreach($timezones as $timezone)
            <option @if($submitFormMethod == 'put' && $settings->timezone_id == $timezone->id) {{'selected'}} @endif value="{{$timezone->id}}">{{$timezone->name}}</option>
            @endforeach
            </select>
            <span class="help-block error-help-block input-error timezone_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'customer_role')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="customer_role_id" data-control="select2" class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-customer_role" tabindex="-1" aria-hidden="true">
            @foreach($roles as $role)
            <option @if($submitFormMethod == 'put' && $settings->customer_role_id == $role->id) {{'selected'}} @endif value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
            </select>
            <span class="help-block error-help-block input-error customer_role_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->


</div>
