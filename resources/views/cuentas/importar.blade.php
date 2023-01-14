@extends('layouts.app')

@section('titulo')
    Importar Telefonos
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Importar Telefonos</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('cuentas.index')}}">Cuentas</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Importar Telefonos</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('cuentas.index')}}"><i class="fa fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')
    <div class="row">        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Importar Telefonos</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('cuentas.import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="form-label">Seleccionar Archivo Xlsx</label>
                                        <input type="file" class="form-control" id="import" name="import">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="cuenta_id" value="{{$cuenta_id}}">
                            <div class="widget-footer" align="right">
                                <a href="{{route('cuentas.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary mr-3"><i class="fas fa-check"></i> Importar</button>
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
</script>
@endsection