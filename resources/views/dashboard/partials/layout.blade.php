<!DOCTYPE html>
<html @if(config('app.locale') == 'ar') direction="rtl" dir="rtl" style="direction: rtl" @endif>
    <head>
    @include(config('dashboard.resource_folder').'partials.header')
    </head>

    @if(auth()->guard('admin')->check())
    <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <div class="d-flex flex-column flex-root">
            <div class="page d-flex flex-row flex-column-fluid">
                @include(config('dashboard.resource_folder').'partials.side_menu')
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper" style="padding-top: calc(1px + var(--kt-toolbar-height))">
                    @include(config('dashboard.resource_folder').'partials.top_nav')
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-fluid">
                                @yield('content')
                            </div>
                            <!--end::Container-->
                            <!--end::Post-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include(config('dashboard.resource_folder').'partials.footer')
    </body>
    @else
    <body id="kt_body" class="bg-white header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
            @yield('content')
		</div>
        @include(config('dashboard.resource_folder').'partials.footer')
    </body>
    @endif
</html>
