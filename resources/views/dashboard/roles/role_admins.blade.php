@extends(config('dashboard.resource_folder').'partials.layout')

@section('content')

@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{$pageTitle}}</h1>
<!--end::Title-->
<!--begin::Separator-->
<span class="h-20px border-gray-200 border-start mx-4"></span>
<!--end::Separator-->
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin-home')}}" class="text-muted text-hover-primary">{{trans(config('dashboard.trans_file').'home')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-dark">{{$pageTitle}}</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
@endsection

<div class="col-xl-12">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">{{$pageTitle}}</span>
                <span class="text-muted mt-1 fw-bold fs-7">{{trans(config('dashboard.trans_file').'total_results', ['val' => $totalResults])}}</span>
            </h3>

            @if(auth()->guard('admin')->user()->can('admin-create'))
            <div class="card-toolbar">
                <a href="{{route('admins.create', ['role_id' => $roleId])}}" class="btn btn-sm btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-03-183419/theme/html/demo2/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                    {{trans(config('dashboard.trans_file').'add_new')}}
                    <!--end::Svg Icon-->
                </a>
            </div>
            @endif
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-25px">#</th>
                            <th class="min-w-150px">{{trans(config('dashboard.trans_file').'name')}}</th>
                            <th class="min-w-150px">{{trans(config('dashboard.trans_file').'role')}}</th>
                            <th class="min-w-140px">{{trans(config('dashboard.trans_file').'email')}}</th>
                            <th class="min-w-120px">{{trans(config('dashboard.trans_file').'mobile')}}</th>
                            @if(auth()->guard('admin')->user()->can('admin-edit') || auth()->guard('admin')->user()->can('admin-delete'))
                            <th class="min-w-100px text-end">{{trans(config('dashboard.trans_file').'actions')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @if(count($admins) == 0)
                        <td colspan="100%">
                            <h3 class="col-12 text-center">{{trans(config('dashboard.trans_file').'no_result')}}</h3>
                        </td>
                        @else
                        @foreach ($admins as $index => $admin)
                        <tr>
                            <td>
                                <p class="text-dark fw-bolder d-block fs-6">{{++$index}}</p>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px me-5">
                                        <img src="{{$admin->image_path}}" alt="{{$admin->name}}">
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <p class="text-dark fw-bolder fs-6">{{$admin->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-dark fw-bolder d-block fs-6">{{$admin->roles[0]->name}}</p>
                            </td>
                            <td>
                                <p class="text-dark fw-bolder d-block fs-6">{{$admin->email}}</p>
                            </td>
                            <td>
                                <p class="text-dark fw-bolder d-block fs-6">{{$admin->mobile}}</p>
                            </td>
                            @if(auth()->guard('admin')->user()->can('admin-edit') || auth()->guard('admin')->user()->can('admin-delete'))
                            <td class="text-end">
                                @if(auth()->guard('admin')->user()->can('admin-edit'))
                                <a href="{{route('admins.edit', $admin->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @endif

                                @if(auth()->guard('admin')->user()->can('admin-delete'))
                                <a href="#" onclick="deleteRow('{{route('admins.destroy', $admin->id)}}', '{{csrf_token()}}')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <!--end::Table body-->
                </table>
                {{$admins->links("pagination::bootstrap-4")}}
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 9-->
</div>
@endsection

@push('footer-scripts')
    <script>
    var title = "{{trans(config('dashboard.trans_file').'delete_question')}}";
    </script>
@endpush
