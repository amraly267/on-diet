<div class="tab-pane fade show" id="contacts_info">

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'address')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'address')}}" value="{{$submitFormMethod == 'put' ? $settings->address : old('address')}}">
            <span class="help-block error-help-block input-error address-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'country')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="country_id" data-control="select2" class="countries form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-country_id" tabindex="-1" aria-hidden="true">
            @foreach($countries as $country)
            <option @if($submitFormMethod == 'put' && $settings->country_id == $country->id) {{'selected'}} @endif value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
            </select>
            <span class="help-block error-help-block input-error country_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'city')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="city_id" data-control="select2" class="cities form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-city_id" tabindex="-1" aria-hidden="true">
            </select>
            <span class="help-block error-help-block input-error city_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'area')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <select name="area_id" data-control="select2" class="areas form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-jdo1-area_id" tabindex="-1" aria-hidden="true">
            </select>
            <span class="help-block error-help-block input-error area_id-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'contact_us_email')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="email" name="contact_us_email" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'contact_us_email')}}" value="{{$submitFormMethod == 'put' ? $settings->contact_us_email : old('contact_us_email')}}">
            <span class="help-block error-help-block input-error contact_us_email-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'contact_us_mobile')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="tel" minlength="9" maxlength="12" name="contact_us_mobile" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'contact_us_mobile')}}" value="{{$submitFormMethod == 'put' ? $settings->contact_us_mobile : old('contact_us_mobile')}}">
            <span class="help-block error-help-block input-error contact_us_mobile-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 col-form-label fw-bold fs-6">{{trans(config('dashboard.trans_file').'whatsapp_number')}}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-10 fv-row fv-plugins-icon-container">
            <input type="tel" minlength="9" maxlength="12" name="whatsapp_number" class="form-control form-control-lg form-control-solid" placeholder="{{trans(config('dashboard.trans_file').'whatsapp_number')}}" value="{{$submitFormMethod == 'put' ? $settings->whatsapp_number : old('whatsapp_number')}}">
            <span class="help-block error-help-block input-error whatsapp_number-error" style="color: red;"></span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>

@push('footer-scripts')
<script>
    $(document).ready(function () {
        $('.countries').change(function(){
            var url = '{{ route("admin-country-cities", ":id") }}'.replace(':id', $(this).val());
            var setting_city_id = "{{$settings->city_id}}";

            $('.cities').empty();
            $('.areas').empty();

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(response){
                    var data = [];
                    for(var i=0; i<response['cities'].length; i++)
                    {
                        var name = response['cities'][i]['name']['{{config("app.locale")}}'];
                        data.push({id:response['cities'][i]['id'], text: name, selected: response['cities'][i]['id'] == setting_city_id ? true : false});
                    }

                    $('.cities').select2({data: data});
                    changeCity($('.cities'));
                }
            })
        }).change();

        $('.cities').change(function(){
            changeCity(this);
        })

        function changeCity(_this)
        {
            var url = '{{ route("admin-city-areas", ":id") }}'.replace(':id', $(_this).val());
            var setting_area_id = "{{$settings->area_id}}";

            $('.areas').empty();

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(response){
                    var data = [];
                    for(var i=0; i<response['areas'].length; i++)
                    {
                        var name = response['areas'][i]['name']['{{config("app.locale")}}'];
                        data.push({id:response['areas'][i]['id'], text: name, selected: response['areas'][i]['id'] == setting_area_id ? true : false});
                    }

                    $('.areas').select2({data: data});
                }
            })
        }
    })
</script>
@endpush
