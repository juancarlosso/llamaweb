@extends('layouts.app')

@section('titulo')
    Clientes
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Clientes</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar Clientes</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('clientes.index')}}"><i class="fa fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Cliente</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('clientes.update',$cliente->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Nombre<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="nombre" value="{{old('nombre',$cliente->nombre)}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Ejecutivo<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="ejecutivo" value="{{old('ejecutivo',$cliente->ejecutivo)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Teléfono de ejecutivo<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="telefono" value="{{old('telefono',$cliente->telefono)}}">
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                            <div class="widget-footer" align="right">
                                <a href="{{route('clientes.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
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