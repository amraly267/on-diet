@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')
@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'home')}}</h1>
<!--end::Title-->
@endsection

@if(auth()->guard('admin')->user()->can('statistics-list'))
<div class="row g-5 g-xl-8">
    <div class="col-xl-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                            <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"/>
                            <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-danger fw-bolder fs-2 mb-2 mt-5">{{trans(config('dashboard.trans_file').'total_admins')}}</div>
                <div class="fw-bold text-inverse-danger fs-7">{{$totalAdmins}}</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-03-183419/theme/html/demo2/dist/../src/media/svg/icons/Home/Key.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <polygon fill="#000000" opacity="0.3" transform="translate(8.885842, 16.114158) rotate(-315.000000) translate(-8.885842, -16.114158) " points="6.89784488 10.6187476 6.76452164 19.4882481 8.88584198 21.6095684 11.0071623 19.4882481 9.59294876 18.0740345 10.9659914 16.7009919 9.55177787 15.2867783 11.0071623 13.8313939 10.8837471 10.6187476"/>
                            <path d="M15.9852814,14.9852814 C12.6715729,14.9852814 9.98528137,12.2989899 9.98528137,8.98528137 C9.98528137,5.67157288 12.6715729,2.98528137 15.9852814,2.98528137 C19.2989899,2.98528137 21.9852814,5.67157288 21.9852814,8.98528137 C21.9852814,12.2989899 19.2989899,14.9852814 15.9852814,14.9852814 Z M16.1776695,9.07106781 C17.0060967,9.07106781 17.6776695,8.39949494 17.6776695,7.57106781 C17.6776695,6.74264069 17.0060967,6.07106781 16.1776695,6.07106781 C15.3492424,6.07106781 14.6776695,6.74264069 14.6776695,7.57106781 C14.6776695,8.39949494 15.3492424,9.07106781 16.1776695,9.07106781 Z" fill="#000000" transform="translate(15.985281, 8.985281) rotate(-315.000000) translate(-15.985281, -8.985281) "/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-primary fw-bolder fs-2 mb-2 mt-5">{{trans(config('dashboard.trans_file').'total_roles')}}</div>
                <div class="fw-bold text-inverse-primary fs-7">{{$totalRoles}}</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-info hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                <span class="svg-icon svg-icon-muted svg-icon-2hx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" fill="#000000"/>
                        <path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" fill="#000000" opacity="0.3"/>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-primary fw-bolder fs-2 mb-2 mt-5">{{trans(config('dashboard.trans_file').'total_countries')}}</div>
                <div class="fw-bold text-inverse-primary fs-7">{{$totalCountries}}</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
    <div class="col-xl-3">
        <!--begin::Statistics Widget 5-->
        <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotone/Design/PenAndRuller.svg-->
                <span class="menu-icon">
                    <!--begin::Svg Icon | path: assets/media/icons/duotone/Communication/Archive.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2hx">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" fill="#000000"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Svg Icon-->
                <div class="text-inverse-primary fw-bolder fs-2 mb-2 mt-5">{{trans(config('dashboard.trans_file').'total_static_pages')}}</div>
                <div class="fw-bold text-inverse-primary fs-7">{{$totalPages}}</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget 5-->
    </div>
</div>
@endif

@endsection
