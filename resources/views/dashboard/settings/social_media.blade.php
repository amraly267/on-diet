<div class="tab-pane fade show" id="social_media">

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'facebook_url')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="url" name="facebook_url" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'facebook_url')}}" value="{{$submitFormMethod == 'put' ? $settings->facebook_url : old('facebook_url')}}">
            <span class="help-block error-help-block input-error facebook_url-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'twitter_url')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="url" name="twitter_url" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'twitter_url')}}" value="{{$submitFormMethod == 'put' ? $settings->twitter_url : old('twitter_url')}}">
            <span class="help-block error-help-block input-error twitter_url-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'youtube_url')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="url" name="youtube_url" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'youtube_url')}}" value="{{$submitFormMethod == 'put' ? $settings->youtube_url : old('youtube_url')}}">
            <span class="help-block error-help-block input-error youtube_url-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'instagram_url')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="url" name="instagram_url" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'instagram_url')}}" value="{{$submitFormMethod == 'put' ? $settings->instagram_url : old('instagram_url')}}">
            <span class="help-block error-help-block input-error instagram_url-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'snapchat_url')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="url" name="snapchat_url" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'snapchat_url')}}" value="{{$submitFormMethod == 'put' ? $settings->snapchat_url : old('snapchat_url')}}">
            <span class="help-block error-help-block input-error snapchat_url-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
