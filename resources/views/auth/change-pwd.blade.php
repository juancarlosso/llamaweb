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

<body class="skin-default card-no-border">
    @include('layouts.preloader')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">
            <div class="login-box card">
                <div class="card-body">
                    <form method="post" class="form-horizontal form-material" id="frmDatos" action="{{route('change-password-update')}}">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" />
                        <h3 class="text-center m-b-20">RECUPERA PASSWORD</h3>
                        @include('layouts.alertas')
                        <div class="form-group">
                            <label class="mb-1"><strong>Password</strong></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Confirmar</strong></label>
                            <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirmacion">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Cambiar Password</button>
                        </div>
                        <br>
                        <div class="text-center">
                            <a href="{{route('login')}}" class="btn btn-info btn-block" type="button">Ir a Login</a>
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
    </script>
    
</body>

</html>