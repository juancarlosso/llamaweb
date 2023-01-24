@extends('layouts.app')

@section('titulo')
    Barrida
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Barrida</a></li>
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
                    <h4 class="card-title">Barrida de Cuenta</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('cuentas.barridaUpdate')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Seleccione los dispositions que serán reintegrados:</label>
                                    <select class="select2 form-control form-select" name="dispo[]" style="width:100%" multiple id="dispo">
                                        <option value="ANSWERED-H">ANSWERED - HUMAN</option>
                                        <option value="ANSWERED-M">ANSWERED - MACHINE</option>
                                        <option value="ANSWERED-N">ANSWERED - NOTSURE</option>
                                        <option value="NO ANSWER">NO ANSWER</option>
                                        <option value="BUSY">BUSY</option>
                                        <option value="FAILED">FAILED</option>
                                        <option value="SINCANAL">SINCANAL</option>
                                     </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label class="checkbox-inline">
                                    <input class='checkbox-slider slider-icon colored-success' type='checkbox'  name='activarcuenta' id='activarcuenta' value='ok'>
                                    <span class="text"> &nbsp;&nbsp;Activar cuenta</span>
                                    </label>	
                                </div>
                            </div>

                            <input type="hidden" name="idcuenta" id="idcuenta" value="{{$cuenta->id}}">
                            <div class="widget-footer" align="right">
                                <a href="{{route('cuentas.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
                                <button type="button" class="btn btn-primary mr-3" onclick="barrido();"><i class="fas fa-check"></i> Reintegrar</button>
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
    
    function barrido(id){
        Swal.fire({
            title: '¿Barrido de Cuenta?',
            text: "Esta acción modifica el estado actual de los registros ¿Desea continuar con el proceso?",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Si!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $('#frmDatos').submit();
            }
        })
        }


    $("#form_barrida").submit(function(){
	
        if(form_barrida.elements["dispo[]"].selectedIndex == -1) {
            Notify( "Debe seleccionar por lo menos un dispositions para la nueva barrida", 'bottom-right', '3000', 'danger', 'fa-tags', true );
            return false;
        }
        
        return true;
    });
</script>
@endsection