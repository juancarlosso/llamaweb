
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
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>{{config('app.name')}}</title>
    
    <!-- page css -->
    <link href="{{asset('assets/dist/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/dist/css/style.min.css')}}" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-purple card-no-border">
    @include('layouts.preloader')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">
            <div class="login-box card">
                <div class="card-body">
                    <form method="post" class="form-horizontal form-material" id="loginform" action="{{route('login.custom')}}">
                        @csrf
                        <h3 class="text-center m-b-20">ACCESO AL PANEL</h3>
                        @include('layouts.alertas')
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" placeholder="E-mail" name="email"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" placeholder="Password" name="password"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="ms-auto">
                                        <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i> ¿Olvidaste tu password?</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn w-100 btn-lg btn-info btn-rounded text-white" onclick="entrar();">Entrar</button>
                            </div>
                        </div>
                    </form>
                    <form method="post" class="form-horizontal" id="recoverform" action="{{route('recover-password')}}" >
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>RECUPERA PASSWORD</h3>
                                @include('layouts.alertas')
                                <p class="text-muted">Ingresa tu correo y te enviaremos tu acceso.</p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email" name="email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-3">
                                <button class="btn btn-primary btn-lg w-100 text-uppercase waves-effect waves-light" onclick="recuperPasswd()">Recuperar</button>
                            </div>
                        <br>
                            <div class="col-xs-3">
                                <button class="btn btn-secondary btn-lg w-100 text-uppercase waves-effect waves-light" onclick="regresar()">Regresar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });

        function recuperPasswd(){
            $('#recoverform').submit();
        }

        function entrar(){
            $('#loginform').submit();
        }

        function regresar() {
            $("#loginform").fadeIn();
            $("#recoverform").slideUp();
        }
    </script>
    
</body>

</html>