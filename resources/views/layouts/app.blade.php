<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    @include('layouts.favicon')
    <title>{{config('app.name')}}</title>
    <link href="{{asset('assets/node_modules/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/dist/css/pages/icon-page.css')}}" rel="stylesheet">
    <!--select2 CSS -->
    <link href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Page plugins css -->
    <link href="{{asset('assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{asset('assets/dist/css/pages/progressbar-page.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/node_modules/prism/prism.css')}}">

    <style>
        .select2-selection {
            height: 36px !important;
            line-height: 34px;
        }
    </style>
</head>

<body class="skin-purple fixed-layout">
    @include('layouts.preloader')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @include('layouts.navbar')
        

        @include('layouts.aside')


        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                @yield('migajas')
                @include('layouts.alertas')
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @yield('contenido')
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        @include('layouts.footer')
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="{{asset('assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/prism/prism.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{asset('assets/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <!--Wave Effects -->
        <script src="{{asset('assets/dist/js/waves.js')}}"></script>
        <!--Menu sidebar -->
        <script src="{{asset('assets/dist/js/sidebarmenu.js')}}"></script>
        <!--stickey kit -->
        <script src="{{asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
        <!--Custom JavaScript -->
        <script src="{{asset('assets/dist/js/custom.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
        <!-- Sweet-Alert  -->
        <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('assets/node_modules/moment/moment.js')}}"></script>
        <!-- Date Picker Plugin JavaScript -->
        <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <!-- Clock Plugin JavaScript -->
        <script src="{{asset('assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
        <script>
            $(".close").click(function(){
                $(".alert").alert("close");
            });
        </script>
        @yield('scripts')
</body>

</html>