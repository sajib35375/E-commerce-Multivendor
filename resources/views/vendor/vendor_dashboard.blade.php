<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('AdminBackend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('AdminBackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('AdminBackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('AdminBackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('AdminBackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('AdminBackend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('AdminBackend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('AdminBackend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminBackend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminBackend/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminBackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('AdminBackend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('AdminBackend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('AdminBackend/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('AdminBackend/assets/css/header-colors.css') }}" />
    <link rel="stylesheet" href="{{ asset('AdminBackend/font/css/font-awesome.min.css') }}">
    <title>Bengal Solutions Vendor</title>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    @include('vendor.body.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('vendor.body.header')
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        @yield('vendor')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('vendor.body.footer')
</div>
<!--end wrapper-->
<!--start switcher-->

<!--end switcher-->
{{--custom js--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{ asset('AdminBackend/vendor.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/js/validate.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('AdminBackend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('AdminBackend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminBackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<script src="{{ asset('AdminBackend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('AdminBackend/assets/js/code.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
<script>
    $(function() {
        $(".knob").knob();
    });
</script>
<script src="{{ asset('AdminBackend/assets/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('AdminBackend/assets/js/app.js') }}"></script>
</body>

</html>
