@extends('layouts.app')

@section('titulo')
    Usuarios
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Usuarios</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                <li class="breadcrumb-item active"><a href="{{route('home')}}">Editar Usuarios</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('usuarios.index')}}"><i class="fa fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Usuario</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('usuarios.update',$usuario->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="name" value="{{old('name',$usuario->name)}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" placeholder="" name="email" value="{{old('email',$usuario->email)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Estado<span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="status" name="status">
                                        <option value='1' {{ (old("status",$usuario->status) == '1' ? "selected" : "") }}>Activo</option>
                                        <option value='0' {{ (old("status",$usuario->status) == '0' ? "selected" : "") }}>Inactivo</option>
                                     </select>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                            <div class="widget-footer" align="right">
                                <a href="{{route('usuarios.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary mr-3"><i class="fas fa-check"></i> Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>	
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(".select2").select2();
</script>
@endsection