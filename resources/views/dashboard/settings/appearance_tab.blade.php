<div class="tab-pane fade show" id="appearance">
    <!--begin::Input group-->
    <div class="card-toolbar mb-5">
        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
            <li class="nav-item">
                <a id="name_en_tab" class="nav-link active" data-bs-toggle="tab" href="#name_en">{{trans(config('dashboard.trans_file').'project_name_en')}}</a>
            </li>
            <li class="nav-item">
                <a id="name_ar_tab" class="nav-link" data-bs-toggle="tab" href="#name_ar">{{trans(config('dashboard.trans_file').'project_name_ar')}}</a>
            </li>
        </ul>
    </div>
    <!--end::Input group-->

    <div class="tab-content">
        <div class="tab-pane fade show active" id="name_en" role="tabpanel">
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'project_name_en')}}</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10 fv-row fv-plugins-icon-container">
                    <input type="text" name="project_name[en]" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'project_name_en')}}" value="{{$submitFormMethod == 'put' ? $settings->getTranslation('project_name', 'en') : old('project_name_en')}}">
                    <span class="help-block error-help-block input-error project_name-en-error" style="color: red;"></span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <div class="tab-pane fade" id="name_ar" role="tabpanel">
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'project_name_ar')}}</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-10 fv-row fv-plugins-icon-container">
                    <input type="text" name="project_name[ar]" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'project_name_ar')}}" value="{{$submitFormMethod == 'put' ? $settings->getTranslation('project_name', 'ar') : old('project_name_ar')}}">
                    <span class="help-block error-help-block input-error project_name-ar-error" style="color: red;"></span>
                </div>
            </div>
        </div>
    </div>
</div>
