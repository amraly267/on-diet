<div class="tab-pane fade show" id="custome_css_js">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-12 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'css_in_header')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-12 fv-row fv-plugins-icon-container">
            <textarea name="css_in_header" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'css_in_header')}}" rows="8">{{$submitFormMethod == 'put' ? $settings->css_in_header : old('css_in_header')}}</textarea>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-12 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'js_before_header')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-12 fv-row fv-plugins-icon-container">
            <textarea name="js_before_header" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'js_before_header')}}" rows="8">{{$submitFormMethod == 'put' ? $settings->js_before_header : old('js_before_header')}}</textarea>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-12 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'js_before_body')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-12 fv-row fv-plugins-icon-container">
            <textarea name="js_before_body" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'js_before_body')}}" rows="8">{{$submitFormMethod == 'put' ? $settings->js_before_body : old('js_before_body')}}</textarea>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
