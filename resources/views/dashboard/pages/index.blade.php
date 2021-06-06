@extends(config('dashboard.resource_folder').'partials.layout')
@section('content')
@section('page_path')
<!--begin::Title-->
<h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{trans(config('dashboard.trans_file').'pages')}}</h1>
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
    <li class="breadcrumb-item text-dark">{{trans(config('dashboard.trans_file').'pages')}}</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
@endsection
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{trans(config('dashboard.trans_file').'pages')}}</h3>
            <span class="text-muted mt-1 fw-bold fs-7">{{trans(config('dashboard.trans_file').'total_results', ['val' => $totalResults])}}</span>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="export_menu dropdown dropdown-inline mr-2" style="margin:0 10px 0 10px;">
                <button disabled class="btn btn-light-primary font-weight-bolder">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
                                icon += '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
                                icon += '<rect x="0" y="0" width="24" height="24"></rect>';
                                icon += '<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>';
                                icon += '<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>';
                                icon += '</g></svg>
            {{trans(config('dashboard.trans_file').'export')}}
        </button>
            </div>
            <!--end::Dropdown-->
            <!--begin::Button-->
            @if(auth()->guard('admin')->user()->can('page-create'))
            <a href="{{route('pages.create')}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                {{trans(config('dashboard.trans_file').'add_new')}}
            </a>
            @endif
            <!--end::Button-->
        </div>
    </div>
</div>
<div class="col-xl-12">
    <!--begin::Tables Widget 9-->
    <div class="card card-xxl-stretch mb-5 mb-xl-8">
        <!--begin::Body-->
        <div class="card-body py-3">
            <form class="mb-15" action="{{route('pages.index')}}" method="GET">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>{{trans(config('dashboard.trans_file').'search_keyword')}}</label>
                        <input type="text" value="{{request()->search_keyword}}" name="search_keyword" class="form-control datatable-input" placeholder="{{trans(config('dashboard.trans_file').'search_keyword')}}" data-col-index="0">
                    </div>

                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>{{trans(config('dashboard.trans_file').'status')}}</label>
                        <select name="status" class="form-select">
                            <option value="">{{trans(config('dashboard.trans_file').'all')}}</option>
                            <option @if(request()->status === '1') {{'selected'}} @endif value="1">{{trans(config('dashboard.trans_file').'active')}}</option>
                            <option @if(request()->status === '0') {{'selected'}} @endif value="0">{{trans(config('dashboard.trans_file').'deactivate')}}</option>
                        </select>
                    </div>

                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>{{trans(config('dashboard.trans_file').'is_web')}}</label>
                        <select name="is_web" class="form-select">
                            <option value="">{{trans(config('dashboard.trans_file').'all')}}</option>
                            <option @if(request()->is_web === '1') {{'selected'}} @endif value="1">{{trans(config('dashboard.trans_file').'active')}}</option>
                            <option @if(request()->is_web === '0') {{'selected'}} @endif value="0">{{trans(config('dashboard.trans_file').'deactivate')}}</option>
                        </select>
                    </div>

                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>{{trans(config('dashboard.trans_file').'is_mobile')}}</label>
                        <select name="is_mobile" class="form-select">
                            <option value="">{{trans(config('dashboard.trans_file').'all')}}</option>
                            <option @if(request()->is_mobile === '1') {{'selected'}} @endif value="1">{{trans(config('dashboard.trans_file').'active')}}</option>
                            <option @if(request()->is_mobile === '0') {{'selected'}} @endif value="0">{{trans(config('dashboard.trans_file').'deactivate')}}</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-8">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-primary--icon" id="kt_search">
                        <span>
                        <i class="la la-search"></i>
                        <span>{{trans(config('dashboard.trans_file').'search')}}</span>
                        </span>
                        </button>
                        <button type="reset" class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                        <span>
                        <i class="la la-close"></i>
                        <span>{{trans(config('dashboard.trans_file').'reset')}}</span>
                        </span>
                        </button>
                    </div>
                </div>
            </form>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="kt_datatable_example_1" class="table table-striped table-bordered table-hover table-checkable dataTable dtr-inline">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold fs-6 text-muted">
                            <th class="min-w-20px" data-column-name="index">#</th>
                            <th class="min-w-150px" data-column-name="title">{{trans(config('dashboard.trans_file').'title')}}</th>
                            <th class="min-w-100px" data-column-name="is_web">{{trans(config('dashboard.trans_file').'is_web')}}</th>
                            <th class="min-w-100px" data-column-name="is_mobile">{{trans(config('dashboard.trans_file').'is_mobile')}}</th>
                            <th class="min-w-100px" data-column-name="status">{{trans(config('dashboard.trans_file').'status')}}</th>
                            @if(auth()->guard('admin')->user()->can('page-edit') || auth()->guard('admin')->user()->can('page-delete'))
                            <th class="min-w-190px" data-column-name="operation">{{trans(config('dashboard.trans_file').'actions')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <!--end::Table head-->
                </table>
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

<script src="{{asset('plugins/dashboard/datatables/datatables.bundle.js')}}"></script>

<script>
    var title = "{{trans(config('dashboard.trans_file').'delete_question')}}";

    function loadData()
    {
        var dataTable = $("#kt_datatable_example_1").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            stateSave: true,
            contentType: "application/json",
            order: [[1, "desc"]],
            initComplete: function( settings, json ) {
                var detached =  $(".export_btn").detach();
                var icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
                icon += '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
                icon += '<rect x="0" y="0" width="24" height="24"></rect>';
                icon += '<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>';
                icon += '<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>';
                icon += '</g></svg> ';
                detached.prepend(icon);

                $(".export_menu button").remove();
                $(".export_menu").append(detached);
            },
            ajax: {
                url: "{{route('pages.index')}}",
                data: $('form').formToJson(),
            },
            columns:[{data: 'index'}, {data: 'title'}, {data: 'is_web'}, {data: 'is_mobile'}, {data: 'status'}, {data: 'action'}],
            dom: 'frtipB',
            language: {url: @if(config('app.locale') === 'en') "//cdn.datatables.net/plug-ins/1.10.16/i18n/English.json" @else "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json" @endif},
            lengthMenu: [[10, 25, 50, 100, 500],['10', '25', '50', '100', '500']],
            columnDefs: [
                {targets: 0, orderable: false, searchable: false, render: function (data, type, full, meta) {return data;}},
                {targets: -1, orderable: false, searchable: false, render: function (data, type, full, meta) {
                    var editUrl = "";
                    var deleteUrl = "";
                    var csrfToken = "{{csrf_token()}}";
                    @if(auth()->guard('admin')->user()->can('page-edit'))
                        var editRoute = '{{ route("pages.edit", ":id") }}'.replace(':id', data);
                        editUrl = '<a href="'+editRoute+'" class="btn btn-sm btn-clean btn-icon"><i class="edit_row la la-edit"></i></a>';
                    @endif
                    @if(auth()->guard('admin')->user()->can('page-delete'))
                        var deleteRoute = '{{ route("pages.destroy", ":id") }}'.replace(':id', data);
                        deleteUrl = "<a href='#' onclick=deleteRow('"+deleteRoute+"','"+csrfToken+"') class='btn btn-sm btn-clean btn-icon'><i class='delete_row la la-trash'></i></a>";
                    @endif
                    return editUrl+deleteUrl;
                }},
            ],

            buttons: [
                {extend: 'collection', text: 'Export', className:"export_btn btn btn-light", fade: true,
                    buttons:[
                        {extend: "pageLength", className: 'btn btn-default btn-sm-menu', text: "{{trans(config('dashboard.trans_file').'page_length')}}", exportOptions: {stripHtml: true, columns: ':visible'}},
                        {extend: "print", className: 'btn btn-default btn-sm-menu', text: "{{trans(config('dashboard.trans_file').'print')}}", exportOptions: {stripHtml: true, columns: ':visible'}},
                        {
                            text: "{{trans(config('dashboard.trans_file').'pdf')}}",
                            className: 'btn btn-default btn-sm-menu',
                            action: function()
                            {
                                var colsNames = [];
                                var colsIndexName = [];
                                for(var i=0; i< $('#kt_datatable_example_1 > thead > tr > th').length; i++)
                                {
                                    var currentColumn = $('#kt_datatable_example_1 > thead > tr > th')[i];
                                    colsNames.push($(currentColumn).text());
                                    colsIndexName.push($(currentColumn).data('column-name'));
                                }
                                colsIndexName.push('ajax_request');

                                $.ajax({
                                    type: 'GET',
                                    url: "{{route('download-page-pdf')}}?"+$.param($('#kt_datatable_example_1').DataTable().ajax.params()),
                                    contentType: "application/json",
                                    dataType: "json",
                                    data: jsonConcat({'visibleColsNames': colsNames, 'colsIndexName': colsIndexName}, $('form').formToJson()),
                                    complete: function (res) {
                                        var path = res.responseJSON.path;
                                        var link = document.createElement('a');
                                        link.href = path;
                                        link.download = 'download.pdf';
                                        link.target = '_blank';
                                        link.click();
                                    }
                                })
                            }
                        },
                        {extend: "excel", className: 'btn btn-default btn-sm-menu', text: "{{trans(config('dashboard.trans_file').'excel')}}", exportOptions: {stripHtml: true, columns: ':visible'}},
                        {extend: "colvis", className: 'btn btn-default btn-sm-menu', text: "{{trans(config('dashboard.trans_file').'columns')}}", exportOptions: {stripHtml: true, columns: ':visible'}},
                    ]
                }
            ],
        });
    }

    $(document).ready(function() {
        loadData();
    })
</script>
@endpush
