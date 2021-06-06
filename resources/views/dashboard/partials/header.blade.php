<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>{{$title}}</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="shortcut icon" href="{{$favicon}}" />

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->

<link href="{{asset('plugins/dashboard/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@if(config('app.locale') == 'ar')
<link href="{{asset('plugins/dashboard/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/dashboard/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<style>
    body{
        font-family: 'Cairo';
    }
</style>
@else
<link href="{{asset('plugins/dashboard/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/dashboard/style.bundle.css')}}" rel="stylesheet" type="text/css" />
@endif
<link href="{{asset('css/dashboard/custome.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->

