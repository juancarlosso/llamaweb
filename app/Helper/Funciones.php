<?php
 namespace App\Helper;
 
 use Illuminate\Support\Facades\DB;

class Funciones
{
    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public static function fechas_bd ($fecha, $tipo)
    {
        $fecha = chop($fecha);
        if ($fecha <> null) {
            $fecha = substr($fecha,-4) . "-" . substr($fecha,3,2) . "-" . substr($fecha,0,2);
            if ($tipo == "datetime")
            {
                $fecha = $fecha . " 00:00:00";
            }
            elseif ($tipo == "date"){
            $fecha = $fecha;
            }
        } else{
        }
        return $fecha;
    }

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public static function fechas_view ($fecha, $tipo)
    {
        $fecha = chop($fecha);
        if ($fecha <> null) {
            $fecha = substr($fecha,-2). "-" .substr($fecha,5,2) . "-" . substr($fecha, 0,4);
            if ($tipo == "datetime")
            {
                $fecha = $fecha . " 00:00:00";
            }
            elseif ($tipo == "date"){
                $fecha = $fecha;
            }
        } else{
        }
        return $fecha;
    }
}