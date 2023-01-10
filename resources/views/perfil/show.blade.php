@extends('layouts.app')

@section('titulo')
    Perfil
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Perfil</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Perfil</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Regresar</a>
            {{-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button> --}}
        </div>
    </div>
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" id="1">Perfil</h4>
                <div class="basic-form">
                    <form id="frmDatos" method="post" action="{{route('perfil.update',auth()->user()->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nombre<span class="text-danger"></span></label>
                                <input type="text" class="form-control" placeholder="" name="name" value="{{auth()->user()->name}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="" name="email" value="{{auth()->user()->email}}" readonly>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group mt-1">
                            <div class="col-xs-12">
                            <div class="alert alert-info" role="alert">
                                Si deseas cambiar tu password, coloca el nuevo password y su confirmación.
                                Deja los campos vacíos si no deseas cambiarlo.
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" placeholder="" name="password" value="" autocomplete="new-password">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirmar password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" placeholder="" name="password_confirmation" value="">
                            </div>
                        </div>
                            {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                        <div class="widget-footer" align="right">
                        
                        <button type="submit" class="btn btn-primary mr-3"><i class="fas fa-check"></i> Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection