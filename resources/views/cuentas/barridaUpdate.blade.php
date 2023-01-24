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
                        <form id="frmDatos" method="post" action="{{route('cuentas.index')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <table class="table">
                                    <thead class="thead-default" >
                                      <tr>
                                        <th align="center">#</th>
                                        <th align="center">DISPOSITION</th>
                                        <th align="center">CANTIDAD REGISTROS</th>
                                        <th align="center">ESTADO REINTEGRO</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tabla">
                                        {{$cuerpo_tabla}}
                                        {{-- <tr> 
                                            <th scope='row'>1</th> 
                                            <td>PROCESADOS</td> 
                                            <td align='center'>0</td>
                                            <td>No reintegrados</td> 
                                        </tr>
                                        <tr> 
                                            <th scope='row'>2</th> 
                                            <td>ANSWERED - MACHINE</td> 
                                            <td align='center'>0</td>
                                            <td>No reintegrados</td> 
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>
                            <hr>
                            <div class='col-sm-12'>
                                <span class="text">  La cuenta se encuentra {{$estado_cuenta}}</span>
                                </label>	
                            </div>
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
@section('scripts')
<script>
    $(".select2").select2();
</script>
@endsection