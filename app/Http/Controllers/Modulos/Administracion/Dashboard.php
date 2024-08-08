<?php

namespace App\Http\Controllers\Modulos\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Modulos\Parametrizacion\TbTipoDesecho;
use App\Models\Modulos\Parametrizacion\TbClasificacionDesecho;
use App\Models\Modulos\Parametrizacion\TbClasificacionDesechosDescripcion;
use App\Models\Modulos\Parametrizacion\tbResponsable;
//use App\Models\Modulos\Parametrizacion­\tbIngresoInfo;
use App\Models\Modulos\Parametrizacion\tbIngresoInfo;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Modulos\Parametrizacion\tb_consulta_dia;
use App\Models\Modulos\Parametrizacion\tb_consulta_mes;
use App\Models\Modulos\Parametrizacion\tb_estaciones;
use App\Models\Modulos\Parametrizacion\tb_gastos;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Modulos\Parametrizacion\tbUsuarioPerfil;
use Exception;

class Dashboard extends Controller
{
    public function ConsultarUsuario()
    {
        try {
            $user = Auth::user();


            return response()->json(['user' => $user], 200);

        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }
    public function User()
    {
        try {


            $resultado = User::All();


            return response()->json(['data' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }
    //
    public function IncipSession($id)
    {
        try {


            $resultado = User::where("id", $id)->get();


            return response()->json(['data' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }
    public function ConsultarInformacion()
    {
        try {


            $resultado = DB::select("call buscarDatos");


            return response()->json(['data' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarDatos()
    {

        try {
            $fecha = date('Y-m-d');
            $resultado = tbResponsable::all();

            $kilos_dia = tbIngresoInfo::whereDate('created_at', $fecha)->get();
            $kilos_total = tbIngresoInfo::all();





            return response()->json([
                'toal_registro' => $resultado->count(),
                'kilos_dia' => $kilos_dia->sum('peso'),
                'kilos_total' => $kilos_total->sum('peso')
            ], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarCalender($id)
    {
        try {


            $resultado = User::where("id", $id)->get();


            return response()->json(['data' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarMes($estacion, $mes, $anio)
    {
        try {

            if ($mes == 99) {
                # code...
                $resultado = tb_consulta_mes::where("estacion", $estacion)
                    ->where("anio", 2024)
                    ->get()->groupBy('mes');
            } else {

                $resultado = tb_consulta_mes::where("estacion", $estacion)->
                    where("mes", $mes)->
                    where("anio", $anio)
                    ->get();
            }

            // $resultado =tb_consulta_mes::where("estacion",$estacion)->
            // where("mes",$mes)
            // ->get()->groupBy('mes');



            return response()->json(['Resp' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['Resp' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarDia($estacion)
    {
        try {



            $resultado = tb_consulta_dia::where("estacion", $estacion)->get()->groupBy('dia');


            return response()->json(['Resp' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['Resp' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarEstaciones()
    {
        try {



            $resultado = tb_estaciones::all();


            return response()->json(['Resp' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['Resp' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarGastosEDS($estacion, $mes, $anio)
    {
        try {

            if ($estacion == 0) {
                $resultado = tb_gastos::where("mes", $mes)
                    ->where("anio", $anio)
                    ->get();
            } else {
                $resultado = tb_gastos::where("id_estacion", $estacion)
                    ->where("mes", $mes)
                    ->where("anio", $anio)
                    ->get();
            }




            return response()->json(['Resp' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['Resp' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function ConsultarDiaPorEstacion($fecha)
    {
        try {

            $fecha_actual = date($fecha);
            //sumo 1 día
            //echo date("d-m-Y", strtotime($fecha_actual . "+ 1 days"));
            //resto 1 día
            //echo date("d-m-Y", strtotime($fecha_actual . "- 1 days"));

            # code...
            $resultado = tb_consulta_dia::selectRaw("dia,SUM(total) as total_dolares")
            ->selectRaw("SUM(galones) as galones")
            ->where('dia', '=', $fecha_actual)
            ->DatosEstacion()    
            ->groupBy('estacion','dia')
            ->orderby('total_dolares','desc')
            ->get();

            // $resultado =tb_consulta_mes::where("estacion",$estacion)->
            // where("mes",$mes)
            // ->get()->groupBy('mes');



            return response()->json(['Resp' => $resultado], 200);
        } catch (Exception $e) {
            return response()->json(['Resp' => $e->getMessage()], 500);
            //throw $th;
        }
    }

    public function createreporteExcel(Request $request){

        //return  response()->json(['data' =>$request->all()], 200);
        try {

            $fecha_actual = date( $request->fecha);
            //sumo 1 día
            //echo date("d-m-Y", strtotime($fecha_actual . "+ 1 days"));
            //resto 1 día
            //echo date("d-m-Y", strtotime($fecha_actual . "- 1 days"));

            # code...
            $resultado = tb_consulta_dia::selectRaw("dia,SUM(total) as total_dolares")
            ->selectRaw("SUM(galones) as galones")
            ->where('dia', '=', $fecha_actual)
            ->DatosEstacion()    
            ->groupBy('estacion','dia')
            ->orderby('total_dolares','desc')
            ->get();
 
    
            $fecha = date('y-m-d');
    
         
            $nameExcel = 'Reporte Por Estacion Efectivo-'.$fecha. '.xls';
           //return  response()->json(['data' =>$resultado], 200);
          
            return Excel::download(new UsersExport($resultado,'Reporte General de Desechos'), 
            $nameExcel, header("Content-Type: application/vnd.ms-excel;"));
    
        
    
           
     
        } catch (Exception $e) {
            return  response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }

}