<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Importa;
use App\Models\Asterisk;
use App\Helper\Funciones;
use Illuminate\Http\Request;
use App\Imports\CuentaImport;
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

}
