
<script src="{{asset('plugins/dashboard/global/plugins.bundle.js')}}"></script>
<script src="{{asset('js/dashboard/scripts.bundle.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dashboard/formToJson.min.js')}}"></script>
<script src="{{asset('js/dashboard/bootstrap.bundle.min.js')}}"></script>

<!--end::Global Javascript Bundle-->
<script>
    var baseUrl = "{{URL::to('/')}}/admin";
</script>
@stack('footer-scripts')
<script type="text/javascript" src="{{asset('js/dashboard/custome.js')}}"></script>
