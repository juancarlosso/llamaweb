<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Zenix - Crypto Admin Dashboard" />
	<meta property="og:title" content="Zenix - Crypto Admin Dashboard" />
	<meta property="og:description" content="Zenix - Crypto Admin Dashboard" />
	<meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
    <title>{{config('app.name')}}</title>
    <!-- Favicon icon -->
    @include('layouts.favicon')
	<link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    @include('layouts.preloader')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <form method="post" class="form-horizontal form-material text-center" id="frmDatos" action="{{route('recover-password')}}">
                                    @csrf
                                    @include('layouts.alertas')
                                    <div class="auth-form">
                                        <div class="text-center mb-3">
                                            <img src="{{asset('assets/dist/images/logo_unika.png')}}" width="200" alt="">
                                        </div>
                                        <h4 class="text-center mb-4">RECUPERA PASSWORD</h4>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/custom.min.js')}}"></script>
	<script src="{{asset('assets/js/deznav-init.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        </script>

</body>
</html>
