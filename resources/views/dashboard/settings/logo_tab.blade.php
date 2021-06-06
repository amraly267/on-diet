<div class="tab-pane fade show active" id="logo">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'logo')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-image.svg')}})">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $settings->logo_path : asset('img/dashboard/default-image.svg')}})"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="logo_remove">
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
            <span class="help-block error-help-block input-error logo-error" style="color: red;"></span>
            <!--end::Image input-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'white_logo')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-image.svg')}})">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $settings->white_logo_path : asset('img/dashboard/default-image.svg')}})"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="white_logo" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="white_logo_remove">
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
            <span class="help-block error-help-block input-error white_logo-error" style="color: red;"></span>
            <!--end::Image input-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'app_icon')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-image.svg')}})">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $settings->app_icon_path : asset('img/dashboard/default-image.svg')}})"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="app_icon" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="app_icon_remove">
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
            <span class="help-block error-help-block input-error app_icon-error" style="color: red;"></span>
            <!--end::Image input-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'favicon')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Image input-->
            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{asset('img/dashboard/default-image.svg')}})">
                <!--begin::Preview existing avatar-->
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$submitFormMethod == 'put' ? $settings->favicon_path : asset('img/dashboard/default-image.svg')}})"></div>
                <!--end::Preview existing avatar-->
                <!--begin::Label-->
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="{{trans(config('dashboard.trans_file').'change_image')}}">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input type="file" name="favicon" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="favicon_remove">
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
            <span class="help-block error-help-block input-error favicon-error" style="color: red;"></span>
            <!--end::Image input-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
