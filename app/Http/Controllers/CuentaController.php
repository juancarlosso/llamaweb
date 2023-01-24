<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Importa;
use App\Models\Asterisk;
use App\Helper\Funciones;
use Illuminate\Http\Request;
use App\Imports\CuentaImport;
use App\Exports\reporteadorExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CuentaImportRequest;

class CuentaController extends Controller
{
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function index()
    {
        $cuentas = Cuenta::orderBy('descripcion')
                    ->paginate(config('constantes.itemsPorPagina'));
        $porcentaje = 0;
        $cuentas->each(function($cuenta, $key){
            if($cuenta->activa=="S")
            { 

                $tablaTelefonos= $cuenta->tabla_telefonos;
                $sqlAvance="SELECT 
                ( SELECT COUNT(*) FROM {$tablaTelefonos} WHERE status = '0' ) AS sin_procesar,
                ( SELECT COUNT(*) FROM {$tablaTelefonos} WHERE status <> '0' ) AS procesados ,
                ( SELECT COUNT(*) FROM {$tablaTelefonos} ) AS total_registros ;";
                $resultAvance    = DB::select($sqlAvance);
                
                $total_registros = $resultAvance[0]->total_registros;
                $procesados      = $resultAvance[0]->procesados;
                $sin_procesar    = $resultAvance[0]->sin_procesar;
                if($procesados==0||$sin_procesar==0||$procesados==0){
                    $porcentaje = 0;
                }
                else{
                    $porcentaje =  round( ( $procesados / $total_registros ) * 100 );
                }  
                $cuenta->porcentaje = $porcentaje;                             
            } 
        });
        
        return view('cuentas.index')->with('cuentas',$cuentas);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function create()
    {
        $asterisks = Asterisk::all();
        return view('cuentas.create')->with('asterisks',$asterisks);
    }

     /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function store(Request $request)
    {
        $activa = $request->activa;
        $slot = 0;
        if( $activa == 'S' )  {
            $slot = $this->obtener_slot();
            if( $slot == 0 )  {
                $activa = "N";
            }
        }

        $queue_robotica="";
        $ivr_robotica  ="";
        if($request->tipo_robotica == "Q") {
            $queue_robotica = $request->dato_tipo;
        }   
        if($request->tipo_robotica == "I"){
            $ivr_robotica = $request->dato_tipo;
        }
        
        $fechaini = Funciones::fechas_bd($request->fecha_ini,"");
        $fechafin = Funciones::fechas_bd($request->fecha_fin,"");
        $hora_ini= date("H:i:s",strtotime($request->hora_ini));
        $hora_fin   = date("H:i:s",strtotime($request->hora_fin));
        
        $cuenta = Cuenta::create();
        $cuenta->descripcion = $request->descripcion;
        $cuenta->tabla_telefonos = $request->tabla_telefonos;
        $cuenta->tipo_robotica = $request->tipo_robotica;
        $cuenta->canales = $request->canales;
        $cuenta->grabacion = $request->grabacion;
        $cuenta->fecha_ini = $fechaini;
        $cuenta->hora_ini = $hora_ini;
        $cuenta->fecha_fin = $fechafin;
        $cuenta->hora_fin = $hora_fin;
        $cuenta->asterisk_id = $request->asterisk_id;
        $cuenta->email = $request->email;
        $cuenta->activa = $activa;
        $cuenta->tabla_resultados = $request->tabla_resultados;
        $cuenta->bloque = 1;
        $cuenta->ignorar = '';
        $cuenta->cantidad_barridas = 0;
        $cuenta->dispo_barrer = '';
        $cuenta->pausa = 1;
        $cuenta->mostrar = 'S';
        $cuenta->idcuenta = 0;
        $cuenta->queue = $queue_robotica;
        $cuenta->ivr = $ivr_robotica;
        $cuenta->troncal = $request->troncal;
        $cuenta->incluir_buzon = $request->incluir_buzon;
        $cuenta->slot = $slot;
        $cuenta->save();

        $ultimoInsertado = $cuenta->id;

        // Si la tabla ya existe, se le antepondra el ID creado
        $sql = "SHOW TABLES LIKE '{$request->tabla_telefonos}'"; 
        $result = DB::select($sql); 

        if( count($result) > 0 )  {
            $nombre_corto = $ultimoInsertado . $request->tabla_telefonos;
            $sql = "UPDATE cuentas SET tabla_telefonos='$nombre_corto' WHERE id = '{$ultimoInsertado}' ";
            DB::select($sql);		   
        }	   
        else{
            $nombre_corto = $request->tabla_telefonos;
        }

        $sql="CREATE TABLE `{$nombre_corto}` (
            `telefono` varchar(50) NOT NULL DEFAULT '99999999',
            `status` int(9) NOT NULL DEFAULT '0',
            `tipo` varchar(50) NOT NULL DEFAULT 'NORMAL',
            `zap` varchar(20) NOT NULL DEFAULT '',
            `disposition` varchar(20) NOT NULL DEFAULT '',
            `fecha_hora` datetime DEFAULT NULL,
            `tiempo` varchar(20) NOT NULL DEFAULT '',
            `amdcause` varchar(50) NOT NULL DEFAULT '',
            `amd` varchar(20) NOT NULL DEFAULT '',
            KEY `telefono` (`telefono`),
            KEY `status` (`status`),
            KEY `disposition` (`disposition`),
            KEY `amd` (`amd`)
            )";
        DB::statement($sql);

        return redirect()->route('cuentas.index')->with('success','La cuenta ha sido creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function edit(Cuenta $cuenta)
    {
       $cuenta->fecha_ini = Funciones::fechas_view($cuenta->fecha_ini,'');
       $cuenta->fecha_fin = Funciones::fechas_view($cuenta->fecha_fin,'');
       if($cuenta->tipo_robotica == "Q") {
            $cuenta->dato_tipo = $cuenta->queue;
        }   
        if($cuenta->tipo_robotica == "I"){
            $cuenta->dato_tipo = $cuenta->ivr;
        }
       $asterisks = Asterisk::all();
        return view('cuentas.edit')->with('cuenta',$cuenta)->with('asterisks',$asterisks);
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function update(Request $request, Cuenta $cuenta)
    {
        $activa = $request->activa;
        $slot =  $request->slot;
        if( $activa == 'S' && $slot == 0)  {
            $slot = $this->obtener_slot();
            if( $slot == 0 )  {
                $activa = "N";
            }
        }

        $queue_robotica="";
        $ivr_robotica  ="";
        if($request->tipo_robotica == "Q") {
            $queue_robotica = $request->dato_tipo;
        }   
        if($request->tipo_robotica == "I"){
            $ivr_robotica = $request->dato_tipo;
        }
        
        $fechaini = Funciones::fechas_bd($request->fecha_ini,"");
        $fechafin = Funciones::fechas_bd($request->fecha_fin,"");
        $hora_ini= date("H:i:s",strtotime($request->hora_ini));
        $hora_fin= date("H:i:s",strtotime($request->hora_fin));
        
        $cuenta->descripcion = $request->descripcion;
        $cuenta->tabla_telefonos = $request->tabla_telefonos;
        $cuenta->tipo_robotica = $request->tipo_robotica;
        $cuenta->canales = $request->canales;
        $cuenta->grabacion = $request->grabacion;
        $cuenta->fecha_ini = $fechaini;
        $cuenta->hora_ini = $hora_ini;
        $cuenta->fecha_fin = $fechafin;
        $cuenta->hora_fin = $hora_fin;
        $cuenta->asterisk_id = $request->asterisk_id;
        $cuenta->email = $request->email;
        $cuenta->activa = $activa;
        $cuenta->tabla_resultados = $request->tabla_resultados;
        $cuenta->bloque = 1;
        $cuenta->ignorar = '';
        $cuenta->cantidad_barridas = 0;
        $cuenta->dispo_barrer = '';
        $cuenta->pausa = 1;
        $cuenta->mostrar = 'S';
        $cuenta->idcuenta = 0;
        $cuenta->queue = $queue_robotica;
        $cuenta->ivr = $ivr_robotica;
        $cuenta->troncal = $request->troncal;
        $cuenta->incluir_buzon = $request->incluir_buzon;
        $cuenta->slot = $slot;
        $cuenta->save();

        return redirect()->route('cuentas.index')->with('success','La Cuenta ha sido actualizada');
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        return redirect()->route('cuentas.index')
                ->with('success','La cuenta ha sido eliminada');
    }


    public function obtener_slot(){
        $slot = 0;
        $consulta="SELECT slots_activos
        FROM
        (
        SELECT activa, GROUP_CONCAT( slot ORDER BY slot SEPARATOR ',') AS slots_activos
        FROM cuentas
        WHERE activa = 'S'
        GROUP BY activa
        ) AS A";
        $result = DB::select($consulta);

        if(count($result) > 0) {
            $slots_activos = $result[0]->slots_activos;
            $slot=0;
            for($n=1;$n<=5;$n++){
                if(!preg_match( "/$n/",$slots_activos)) 	{
                    $slot=$n; 
                    break;
                }
            }
        }
        else {
            $slot=1;
        }
        return $slot;
    }


    public function importarIndex($id){
        return view('cuentas.importar')->with('cuenta_id',$id);
    }

    public function importData(CuentaImportRequest $request){        
        Importa::truncate();
		Excel::import(new CuentaImport, request()->file('import'));
        $cuenta = Cuenta::findOrfail($request->cuenta_id);
        $consulta="INSERT INTO {$cuenta->tabla_telefonos} (telefono) SELECT telefono from cuenta_importa";
        //dd($cuenta);
        DB::select($consulta);
		return redirect()->route('cuentas.index')->with('success','El archivo de telefonos ha sido importado');
	}


    public function estadisticas($id){

        $sql = "SELECT * FROM cuentas WHERE id = '{$id}'";
        $resultado    = DB::select($sql);
        $datos= $resultado[0];
        $tabla = $datos->tabla_telefonos; 
        switch($datos->tipo_robotica) {
                case 'A': $tipo_mostrar = "Auto" ; $qi = " "; break;
                case 'Q': $tipo_mostrar = "Queue"; $qi = " [" . $datos->queue . "] "; break;
                case 'I': $tipo_mostrar = "Ivr"  ; $qi = " [" . $datos->ivr . "]" ; break;
                default:
                $tipo_mostrar = "Error!";
                $qi = "Error";
                break;
        }
        return view('cuentas.estadisticas')->with('cuenta_id',$id)->with('tabla',$tabla)->with('tipo_mostrar',$tipo_mostrar)->with('qi',$qi)->with('datos',$datos);

    }

    public function reporteador(Request $request) {

        $tabla = $request->tabla;
        $DESDE = $request->fecha_ini;
        $HASTA = $request->fecha_fin;
        return Excel::download(new reporteadorExport($tabla, $DESDE, $HASTA), 'reportecuentarobotica.xlsx');
    }

    public function barraTotal($idcuenta,$tabla)
    {
        // Extraemos la informacion
        $tablaTelefonos=$tabla;
        $sql="SELECT 
        ( SELECT COUNT(*) FROM {$tablaTelefonos} WHERE status='0' ) AS sin_procesar,
        ( SELECT COUNT(*) FROM {$tablaTelefonos} WHERE status<>'0' ) AS procesados ,
        ( SELECT COUNT(*) FROM {$tablaTelefonos} ) AS total_registros ";
        $resultAvance    = DB::select($sql);
        $datosAvance     = $resultAvance[0];
        $total_registros = $datosAvance->total_registros;
        $procesados      = $datosAvance->procesados;
        $sin_procesar    = $datosAvance->sin_procesar;
        if($procesados==0||$total_registros==0){
            $porcentaje = 0;
        }
        else{
            $porcentaje =  round( ( $procesados / $total_registros ) * 100 );
        }
                                
                $grafica = "<div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='{$porcentaje}' aria-valuemin='0' aria-valuemax='100' style='width: {$porcentaje}%'>
        <span>
        {$porcentaje}% 
        </span>
        </div>" ;      
                                
        return $grafica;	
    }

    public function procesados($idcuenta,$tabla){

        $outp     = array();
                                        
        // Extraemos el total de los registros
        $sql="SELECT COUNT(*) AS total_recorridos FROM {$tabla} WHERE status<>0 ";// echo $sql;
        $result    = DB::select($sql);
        $datos = $result[0];
        $total_registros = $datos->total_recorridos;
        // Extraemos los valores				   
        $consulta="SELECT disposition, COUNT(*) AS cantidad 
        FROM {$tabla}
        WHERE status <> 0
        GROUP BY disposition
        ORDER BY cantidad DESC";       
        $result    = DB::select($consulta);
        foreach($result as $key => $datos){
            $porcentaje = ($datos->cantidad * 100)/$total_registros;
            $outp[] = array("label"=> $datos->disposition, "value" => round($porcentaje));
        }
        
        if (count($result) == 0) die ("Lo sentimos no hay valores");
        
        //Regresa el arreglo Json
        echo  json_encode($outp); 
    }


    public function answered($idcuenta, $tabla){
        $outp     = array();
										
		// Extraemos el total de los registros
		$sql="SELECT COUNT(*) AS total_recorridos FROM {$tabla} WHERE disposition='ANSWER' OR disposition='ANSWERED'";// echo $sql;
		$result = DB::select($sql);
		$datos = $result[0];
		$total_registros = $datos->total_recorridos;
		// Extraemos los valores				   
        $consulta="SELECT amd, COUNT(*) AS cantidad 
        FROM {$tabla}
        WHERE disposition='ANSWER' OR disposition='ANSWERED'
        GROUP BY amd";       
        $result = DB::select($consulta);
        foreach($result as $key => $datos){
            $porcentaje = ($datos->cantidad * 100)/$total_registros;
            $outp[] = array("label"=> $datos->amd, "value" => round($porcentaje));
        }
        
        if (count($result) == 0)  die ("Lo sentimos no hay valores");
        
        //Regresa el arreglo Json
        echo  json_encode($outp);
    }

    public function barrida($idcuenta)
    {
        $cuenta = Cuenta::findOrfail($idcuenta);
        return view('cuentas.barrida')->with('cuenta',$cuenta);
    }

    public function barridaUpdate(Request $request)
    {
        
        $cuenta = Cuenta::findOrfail($request->idcuenta);

        // ************* Generamos el reporte de lo que se reintegrara  *****************************//
        $dispo = $request->dispo;
        $activar_cuenta = $request->activarcuenta;
        $linea = 1;
        $cuerpo_tabla = '';
        $consulta = "SELECT COUNT(telefono) AS cantidad FROM {$cuenta->tabla_telefonos} WHERE disposition = 'PROCESADO'";
        $result = DB::select($consulta);
        $datos  = $result[0];
        $cuerpo_tabla.= "<tr>
                        <th scope='row'>$linea</th>
                        <td>PROCESADOS</td>
                        <td align='center'>{$datos->cantidad}</td>";
        if($datos->cantidad){
            $estado = "Reintegrados";
        }
        else{
            $estado = "No reintegrados";
        }
        $cuerpo_tabla.="<td>{$estado}</td>
                            </tr>";


        for( $x=0; $x<count($dispo); $x++ )
        {
            $dis=$dispo[$x];
            $linea++;
            if($dis=='ANSWERED-H')
            { 
                $consulta = "select COUNT(telefono) as cantidad from {$cuenta->tabla_telefonos} where disposition = 'ANSWERED' AND ( amd LIKE '%HUMAN%' OR amd LIKE '%PERSON%' )";
                $result = DB::select($consulta);
                $datos  = $result[0];
                $cuerpo_tabla.= "<tr>
                                <th scope='row'>$linea</th>
                                <td>ANSWERED - HUMAN</td>
                                <td align='center'>{$datos->cantidad}</td>";
            }
            if($dis=='ANSWERED-M')
            { 
                $consulta = "select COUNT(telefono) as cantidad from {$cuenta->tabla_telefonos} where disposition = 'ANSWERED' AND amd LIKE '%MACHINE%'";
                $result = DB::select($consulta);
                $datos  = $result[0];
                $cuerpo_tabla.= "<tr>
                                <th scope='row'>$linea</th>
                                <td>ANSWERED - MACHINE</td>
                                <td align='center'>{$datos->cantidad}</td>";
            }
            if($dis=='ANSWERED-N')
            { 
                $consulta = "select COUNT(telefono) as cantidad from {$cuenta->tabla_telefonos} where disposition = 'ANSWERED' AND amd LIKE '%NOTSURE%'";
                $result = DB::select($consulta);
                $datos  = $result[0];
                $cuerpo_tabla.= "<tr>
                                <th scope='row'>$linea</th>
                                <td>ANSWERED - NOTSURE</td>
                                <td align='center'>{$datos->cantidad}</td>";
            }
            if( preg_match("/{$dis}/","NO ANSWER,BUSY,FAILED,SINCANAL") )
            {
                $consulta = "select COUNT(telefono) as cantidad from {$cuenta->tabla_telefonos} where disposition = '$dis' ";
                $result = DB::select($consulta);
                $datos  = $result[0];
                $cuerpo_tabla.= "<tr>
                                <th scope='row'>$linea</th>
                                <td>{$dis}</td>
                                <td align='center'>{$datos->cantidad}</td>";
            }
            if($datos->cantidad){
                $estado = "Reintegrados";
            }
            else{
                $estado = "No reintegrados";
            }
            $cuerpo_tabla.="<td>{$estado}</td>
                                </tr>";
            
        }	

        //  *************************** Inicia el proceso de reintegro de registros *********************
        $hay_otro=false;
        $hay_answered_h=false;
        $consulta = "UPDATE {$cuenta->tabla_telefonos} SET status=0, disposition='SINDISPOSITION' WHERE disposition='PROCESADO' ";
        DB::select($consulta);
        $consulta = "UPDATE {$cuenta->tabla_telefonos} 
                    SET disposition='SINDISPOSITION',
                    amd='SINAMD',
                    status=0, 
                    tiempo=0,
                    fecha_hora = NULL, 
                    amdcause=''
                    WHERE ";
        for( $x=0; $x<count($dispo); $x++ )
        {
            $dis=$dispo[$x];
            if($dis=='ANSWERED-H')
            { 
                $hay_answered_h = true;
                $consulta .= " ( disposition = 'ANSWERED' AND ( amd LIKE '%HUMAN%' OR amd LIKE '%PERSON%' ) )";
            }
            if($dis=='ANSWERED-M')
            { 
                if( $hay_answered_h ) { $consulta .= " OR "; }
                $hay_answered_m = true;
                $consulta .= " ( disposition = 'ANSWERED' AND amd LIKE '%MACHINE%' )";
            }
            if($dis=='ANSWERED-N')
            { 
                if( $hay_answered_m || $hay_answered_h ) { $consulta .= " OR "; }
                $hay_answered_n = true;
                $consulta .= " ( disposition = 'ANSWERED' AND amd LIKE '%NOTSURE%' )";
            }
            if( preg_match("/{$dis}/","NO ANSWER,BUSY,FAILED,SINCANAL") )
            {
                if( $hay_answered_h || $hay_answered_m  || $hay_answered_n  || $hay_otro ) { $consulta .= " OR "; }
                $consulta .= " disposition = '$dis' ";
                $hay_otro = true;
            }
            
        }		 
        
        DB::select($consulta);
        
        if($activar_cuenta == "ok"){
            $estado_cuenta = "activada";
            $consulta = "UPDATE cuentas set activa = 'S' WHERE id='{$request->idcuenta}' ";
            
        }
        else{
            $estado_cuenta = "desactivada";
            $consulta = "UPDATE cuentas set activa = 'N' WHERE id='{$request->idcuenta}' ";
        }
        
        DB::select($consulta);

        return view('cuentas.barridaUpdate')->with('cuenta',$cuenta)->with('cuerpo_tabla',$cuerpo_tabla)->with('estado_cuenta',$estado_cuenta);
    }

}
