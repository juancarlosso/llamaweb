@extends('layouts.app')

@section('titulo')
    Cuentas
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Cuentas</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('cuentas.index')}}">Cuentas</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar Cuenta</a></li>
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
                    <h4 class="card-title">Editar Cuenta</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('cuentas.update',$cuenta->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tabla de Teléfonos</label>
                                    <input type="text" class="form-control" placeholder="" name="tabla_telefonos" value="{{old('tabla_telefonos',$cuenta->tabla_telefonos)}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Descripcion</label>
                                    <input type="text" class="form-control" placeholder="" name="descripcion" value="{{old('descripcion',$cuenta->descripcion)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Tipo:</label>
                                    <select class="select2 form-control form-select" style="width: 100%; height:36px;" id="tipo_robotica" name="tipo_robotica">
                                        <option value='A' {{ (old("tipo_robotica",$cuenta->tipo_robotica) == 'A' ? "selected" : "") }}>Automatica</option>
                                        <option value='Q' {{ (old("tipo_robotica",$cuenta->tipo_robotica) == 'Q' ? "selected" : "") }}>Transferida hacia QUEUE</option>
                                        <option value='I' {{ (old("tipo_robotica",$cuenta->tipo_robotica) == 'I' ? "selected" : "") }}>Transferida hacia IVR</option>
                                     </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label id="lbl_tipo">...</label>
                                    <input type="text" class="form-control" placeholder="" id='dato_tipo' name='dato_tipo' value="{{old('dato_tipo',$cuenta->dato_tipo)}}">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Canales</label>
                                    <input type="text" class="form-control" placeholder="" id='canales' name='canales' value="{{old('canales',$cuenta->canales)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Grabación</label>
                                    <input type="text" class="form-control" placeholder="" id='grabacion' name='grabacion' value="{{old('grabacion',$cuenta->grabacion)}}">
                                </div>
                               
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Fecha_inicio:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" data-autoclose="true" id='fecha_ini' name='fecha_ini' value="{{old('fecha_ini',$cuenta->fecha_ini)}}">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div>
                                </div>
                                <div class='form-group col-sm-3'>
                                    <label>Hora Inicio:</label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                                        <input type="text" class="form-control" value="05:00" id='hora_ini' name='hora_ini' value="{{old('hora_ini',$cuenta->hora_ini)}}">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                </div> 
                                <div class="form-group col-md-3">
                                    <label>Fecha_Fin:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" data-autoclose="true" id='fecha_fin' name='fecha_fin' value="{{old('fecha_fin',$cuenta->fecha_fin)}}">
                                            <span class="input-group-text"><i class="icon-calender"></i></span>
                                    </div>
                                </div>
                                <div class='form-group col-sm-3'>
                                    <label>Hora Fin:</label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true" >
                                        <input type="text" class="form-control" value="05:00" id='hora_fin' name='hora_fin' value="{{old('hora_fin',$cuenta->hora_fin)}}">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Servidor Asterisk:</label>
                                    <select class="select2 form-control form-select" style="width: 100%; height:36px;" id="asterisk_id" name="asterisk_id">
                                        @foreach ($asterisks as $asterisk)
                                            <option value='{{$asterisk->id}}' {{ (old("asterisk_id",$cuenta->asterisk_id) == $asterisk->id ? "selected" : "") }}>{{$asterisk->descripcion}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class='form-group col-sm-3'>
                                    <label>Troncal:</label>
                                    <input class='form-control'  id='troncal' name='troncal' type='text' value="{{old('troncal',$cuenta->troncal)}}" size="25" maxlength="50" >                             
                                </div> 
                                <div class='form-group col-sm-4'>
                                    <label>Email:</label>
                                    <input class='form-control'  id='email' name='email' type='text' value="{{old('email',$cuenta->email)}}" size="25" maxlength="50">                             
                                </div> 

                                <div class="form-group col-md-1">
                                    <label>Activar:</label>
                                    <select class="select2 form-control form-select" style="width: 100%; height:36px;" id="activa" name="activa">
                                        <option value='N' {{ (old("activa",$cuenta->activa) == 'N' ? "selected" : "") }}>NO</option>
                                        <option value='S' {{ (old("activa",$cuenta->activa) == 'S' ? "selected" : "") }}>SI</option>
                                     </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class='form-group col-sm-3'>
                                    <label>CALLERID:</label>
                                    <input class='form-control'  id='callerid' name='callerid' type='text' value="{{old('email',$cuenta->callerid)}}">                             
                                </div> 
                            </div>
                            <input type="hidden" name="slot" id="slot" value="{{$cuenta->slot}}">
                            {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                            <div class="widget-footer" align="right">
                                <a href="{{route('cuentas.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
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
    $('.mydatepicker, #datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'top',
        autoclose: true,
        'default': 'now'
    });

    $("#tipo_robotica").change(function(){
        switch($("#tipo_robotica").val()) {
        case "A": $("#lbl_tipo").html("..."); break;
        case "Q": $("#lbl_tipo").html("Cola:"); break;
        case "I": $("#lbl_tipo").html("IVR:"); break;
        default:  $("#lbl_tipo").html(".."); break;
        }
        $("#dato_tipo").focus();
    });
</script>
@endsection