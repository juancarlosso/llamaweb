@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    <h3 class="text-success"><i class="fa fa-check-circle"></i> ¡Muy bien!</h3> {{$message}}
</div>
@endif

@if($message = Session::get('danger'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    <h3 class="text-danger"><i class="fa fa-exclamation-circle"></i> Error!</h3> {{$message}}
</div>
@endif

@if($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    <h3 class="text-warning"><i class="fa fa-exclamation-circle"></i> ¡Cuidado!</h3> {{$message}}
</div>
@endif

@if($message = Session::get('info'))
<div class="alert alert-info alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> ¡Información!</h3> {{$message}}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-inner--text">
       @foreach ($errors->all() as $error)
                 {{ $error }}<br>
       @endforeach
    </span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
</div>
@endif