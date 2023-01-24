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
                    <div class="row">
                        <div class='col-md-2'>
                            <label><strong>Tabla teléfonos: &nbsp;&nbsp;</strong></label>
                        </div>
                        <div class='col-md-3'>
                            <label>{{$tabla}}</label>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                        </div>
                        <div class='col-md-2'>
                            <label><strong>Tipo de Cuenta: &nbsp;&nbsp;</strong></label>
                        </div>
                        <div class='col-md-2'>
                            <label>{{$tipo_mostrar}}</label>
                        </div>
                        <div class='col-md-2'>
                            <label><strong>Descripcion: &nbsp;&nbsp;</strong></label>
                        </div>
                        <div class='col-md-3'>
                            <label>{{$datos->descripcion}}</label>
                        </div>
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                        </div>
                        <div class='col-md-2'>
                            <label><strong>{{$qi}}</strong></label>
                        </div>
                        <div class='col-md-2'>
                            <label>{{$datos->queue}}</label>
                        </div>                     
                        <div class='col-md-2'>
                            <label>&nbsp;</label>
                        </div>
                    </div>
                    <hr>
                    <h5><strong>Reportes</strong></h5>
                    <form class='form validate-form' method="post" id="formDatos" action="{{route('cuentas.reporte')}}" style='margin-bottom: 0;' enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class='form-group col-md-4'>
                                <label>Selecciona el reporte a generar</label>
                                <select class="select2 form-control form-select" style="width: 100%; height:36px;" name="tipo_reporte" id="tipo_reporte">
                                    <option value="" selected>-------- REPORTES DE ROBOTICAS --------</option>
                                    <option value="reporteador_roboticas">Reporteador </option>
                                </select> 
                            </div> 
                            <div class="form-group col-md-3">
                                <label>Fecha Inicio:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" data-autoclose="true" id='fecha_ini' name='fecha_ini' data-date-format="yyyy-mm-dd" value="{{old('fecha_ini',date("Y-m-d"))}}">
                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Fecha Fin:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control mydatepicker" placeholder="dd/mm/yyyy" data-autoclose="true" id='fecha_fin' name='fecha_fin' data-date-format="yyyy-mm-dd" value="{{old('fecha_ini',date("Y-m-d"))}}">
                                        <span class="input-group-text"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            <div class='form-group col-md-2'>
                                <div><label>&nbsp;</label></div> 
                                <button class='btn btn-success pull-right' type='button' id="btnEmitirReporte">
                                <i class='fa fa-file-excel-o'></i>
                                Generar
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="cuenta_id" value="{{$cuenta_id}}">
                        <input type='hidden' name='tabla' id="tabla" value="{{$tabla}}"/>
                    </form>
                    <hr>
                    {{-- <h5><strong>Gráficas</strong></h5> --}}
                    <div class="row">
                        <div class="col-sm-12">
                           <h2 align="center">AVANCE DE LA CUENTA ROBÓTICA</h2>
                        </div> 
                      </div> 
                      <div class="row">
                        <div class="col-sm-12" >
                           <div class="progress progress-striped" id='graficaBarraTotal'>
                                
                            </div>
                        </div> 
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-6">
                           <h2 align="center">DE LOS PROCESADOS</h2>
                        </div> 
                        <div class="col-sm-6">
                           <h2 align="center">DE LOS ANSWERED</h2>
                        </div> 
                      </div> 
                      <div class="row">
                         <div class="col-sm-6">
                             <div align="center" id="graficaProcesados" class="chart chart-lg">
                              
                             </div>                                         
                         </div>
                         <div class="col-sm-6">
                             <div align="center" id="graficaAnswered" class="chart chart-lg">
                              
                             </div>                                         
                         </div>
                      </div>
                </div>
            </div>	
        </div>
    </div>
@endsection
@section('scripts')
    <!--Morris JavaScript -->
    <script src="{{asset('assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('assets/node_modules/morrisjs/morris.js')}}"></script>
    {{-- <script src="{{asset('assets/dist/js/pages/morris-data.js')}}"></script> --}}
<script>
    $(".select2").select2();
    $('.mydatepicker, #datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });

  // Verificamos que los datos para emitir el reporte sean correctos
  $("#btnEmitirReporte").click(function(){
     if($("#tipo_reporte").val()==""){
        Notify( "Debe seleccionar el reporte que quiere emitir", 'bottom-right', '3000', 'danger', 'fa-warning', true );
        return false;
     }
     if($("#fecha_inicio").val()==""  ){
        Notify( "Debe seleccionar la fecha inicial del reporte", 'bottom-right', '3000', 'danger', 'fa-warning', true );
        $("#fecha_inicio").focus();
        return false;
     }
     
     if($("#fecha_fin").val()=="" ){
        Notify( "Debe seleccionar la fecha final del reporte", 'bottom-right', '3000', 'danger', 'fa-warning', true );
        $("#fecha_fin").focus();
        return false;
     }
     $("#formDatos").submit();
  });
 
  // ===================================================================
  $(window).bind("load", function () {
   
     themeprimary = '#03A9F2';
     themesecondary = '#00C292';
     themethirdcolor = '#FA9578'; 
     themefourthcolor = '#808000'; 
     themefifthcolor = '#66ff66'; 
     themesixthcolor = '#787F91'; 
      
     
     idcuenta = $('#idcuenta').val();
     tabla = $('#tabla').val();
     
     pintarGraficas();

   });


var CargaRegistros = function () {
    return {
        init: function () {
            Morris.Donut({
                element: elemento,
                data: arregloDatos,
                colors: colores,
                formatter: function (y) { return y + "%" }
            });
        }
    };    
}();



// Funcion que pinta las graficas    
function pintarGraficas(){
   // Pintamos la barra de porcentaje
   $.ajax({     
     url: "/estadisticas_barraTotal/"+idcuenta+"/"+tabla,
     type:"GET",
     success: function(data) {
       $("#graficaBarraTotal").html(data);
     }
    });
    //Pintamos el detalle de los procesados
    $.ajax({     
       url: "/estadisticas_procesados/"+idcuenta+"/"+tabla,
       type:"GET",
       dataType: "json",
       success: function(data) {
         $("#graficaProcesados").html("");
         arregloDatos = data;
         elemento = "graficaProcesados";
         colores = [ themeprimary, themesecondary ,themethirdcolor, themefourthcolor, themefifthcolor, themesixthcolor ];
         CargaRegistros.init();
       }
     });

    //Pintamos el detalle de los ANSWERED
    $.ajax({     
       url: "/estadisticas_answered/"+idcuenta+"/"+tabla,
       type:"GET",
       dataType: "json",
       success: function(data) {
         $("#graficaAnswered").html("");
         arregloDatos = data;
         elemento = "graficaAnswered";
         colores = [  themesecondary, themethirdcolor, themefourthcolor, themefifthcolor, themeprimary ];
         CargaRegistros.init();
       }
     });
};
</script>
@endsection