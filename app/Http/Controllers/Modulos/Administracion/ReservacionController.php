<?php

namespace App\Http\Controllers\Modulos\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modulos\Parametrizacion\tb_sucursal;
use App\Models\Modulos\Parametrizacion\tb_sucursal_mesa;
use App\Models\Modulos\Parametrizacion\tb_cliente;

use App\Models\Modulos\Parametrizacion\tb_reservas_clientes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use stdClass;
use Mail;
use App\Mail\ReservaCallReceived;
use App\Models\User;
use Hash;

use Exception;

class ReservacionController extends Controller
{
    public function UserAdmin($usuario,$password)
    {
        try {


            $band = false;
            $mensaje = "";

            $resultado = User::where('email',$usuario)->where('password',Hash::make($password))->first();

            if ($resultado != null) {
                # code...
                $band = true;
                $mensaje = "Inicio realizado de manera correcta";
                 

            } 

            return response()->json(['band' => $band,'data' =>Hash::make( $password),'mensaje' => $mensaje], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }
    //
    public function GetReserva($fechaini,$fechafin,$local)
    {
        try {
            $user = Auth::user();

            if ($user->profesion == 0) {
                # code...
                $lista = tb_reservas_clientes::DatosReserva()
                ->get();
                             
            }else{
                $lista = tb_reservas_clientes::where("id_sucursal", $user->profesion)
                ->DatosReserva()
                ->get();
            }

            



            return response()->json(['data' => $lista], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function GetCliente($cedula)
    {
        try {
            $lista = tb_cliente::where("cedula", $cedula)
                 ->first();
                         



            return response()->json(['data' => $lista], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function GetFechaReserva($fecha,$id_sucursal,$id_mesa)
    {
        try {
            $listaReserva = tb_reservas_clientes::select("hora_reserva")->whereDate('fecha_reserva', $fecha)
            ->where("id_sucursal", $id_sucursal)
            ->where("id_mesa",$id_mesa)->get();

            // $startTime = date("Y-m-d 12:00:00");

            // //display the starting time
            // echo 'Starting Time: '.$startTime;

            // //add 1 hour to time
            // $cenvertedTime = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($startTime)));
            $listaHorario = tb_sucursal::select('hora_inicio','hora_fin')->where('Sucursal_Id',$id_sucursal)->first();
           // $startTime = date("Y-m-d "+ $listaHorario->hora_inicio );

            list($h, $m, $s) = explode(':', $listaHorario->hora_inicio); 
            $hora_inicio = ($h * 3600) + ($m * 60) + $s; 

            list($hf, $mf, $sf) = explode(':', $listaHorario->hora_fin); 
            $hora_fin = ($hf * 3600) + ($mf * 60) + $sf; 


            $times = array();

            foreach ( range( $hora_inicio, $hora_fin, 3600 ) as $timestamp ) {
    
                    $hour_mins = gmdate( 'H:i', $timestamp );
    
                    if ( ! empty( $format ) )
                            $times[$hour_mins] = gmdate( $format, $timestamp );
                    else $times[$hour_mins] = $hour_mins;
            }
           
             $ListValidada = array();
            foreach ($times as   $item) {
                
                $myObj = new stdClass();
                # code...
                $valor_comparar = "";
                $valor_comparar = $item;

               $listaBuscar = $listaReserva->where('hora_reserva',$item)->first();



               
                    # code...
                    if ($listaBuscar != null) {
                        
                        $myObj->hora = $item;
                        $myObj->estado = 1;
                        
                    }else{
                        $myObj->hora = $item;
                        $myObj->estado = 0;
                       
                    }
               
                $ListValidada[] = $myObj;
               

                
               

              
              
            }

            
            return response()->json(['data' => $times,
            'times' => $times,
            'hola' => $hora_inicio,
            'listaReserva' => count($listaReserva),
             'listaValida' => $ListValidada,
        ], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function PostValidarUsuario(Request $request)
    {
        // return response()->json(['data' => $request->all()], 200);
        
            // $lista = tb_sucursal::where('Empresa_Id', 1)
            //              ->get();

            $id_cliente_reserva = 0;
            $celular = 0;
            $alergias = "";
            $transaccion =  0;

            if ($request->id != 0) {
                # code...
                $reserva = tb_reservas_clientes::where('id',$request->id)->first();
                $id_cliente_reserva = $reserva->id_cliente_reserva;
                $celular = $reserva->celular;
                $alergias = $reserva->descripcion;
                $transaccion = $reserva->descripcion;

            } else{
                $id_cliente_reserva = $request->id_cliente_reserva;
                $celular = $request->celular;
                $alergias = $request->descripcion;
                $transaccion = $request->transaccion;

            }
            

            $request->validate([
                'id_empresa' => 'required|not_in:0',
                'id_sucursal' => 'required|not_in:0',
                'id_mesa' => 'required|not_in:0',
                'numero_persona' => 'required|not_in:0',
                //'id_cliente_reserva' => 'required|not_in:0',
                'fecha_reserva' => 'required|not_in:0',
                'hora_reserva' => 'required|not_in:0',
                //'descripcion' => 'required|not_in:0',
               // 'celular' => 'required|not_in:0',
                // 'pago' => 'required|not_in:0',
                // 'transaccion' => 'required|not_in:0',
                // 'valor' => 'required|not_in:0',
                
            ]);
            try {
                
            
               
                $fechaActual = Carbon::now();
                $GrabarCliente = tb_reservas_clientes::UpdateOrCreate(
                    [
                        'id' =>$request->id,
                    ],
                    [
                        
                        'id_empresa' => $request->id_empresa,
                        'id_sucursal' => $request->id_sucursal,
                        'id_mesa' => $request->id_mesa,
                        'id_cliente_reserva' => $id_cliente_reserva,
                        'numero_persona' => $request->numero_persona,
                        'fecha_reserva' => $request->fecha_reserva,
                        'hora_reserva' => $request->hora_reserva,
                        'hora_reserva_t' => $request->hora_reserva,
                        'descripcion' => $alergias,
                        'celular' => $celular,
                        'pago' => $request->pago,
                        'transaccion' => $transaccion,
                        'src' => "",
                        'valor' =>0,
                        'color' => "",
                        'icono' => "",
                        
                        'updated_at' => $fechaActual,
                        'created_at' => $fechaActual,
                        'estado' => 1,
                  
                    ]
    
                );
                // $lista = tb_sucursal::where('Empresa_Id', 1)
                //              ->get();
                $wasCreated = $GrabarCliente->wasRecentlyCreated;

                $consultar = tb_cliente::where('id', $request->id_cliente_reserva)->first();

                $reservaEnviar = tb_reservas_clientes::DatosReserva()->where('id',$GrabarCliente->id)->first();

                $subject = "RESERVA PIZZA LIBRE";
                $for = $reservaEnviar->correo;
               // $for = "tic@pizzalibregye.com";
                
                Mail::to($for)
                ->send(new ReservaCallReceived($reservaEnviar,$subject));
    
    
                return response()->json(['data' => $wasCreated], 200);
            
 
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function PostValidarUsuarioCliente(Request $request)
    {
        $request->validate([
            'nombres' => 'required|not_in:0',
            'apellidos' => 'required|not_in:0',
            'cedula' => 'required|not_in:0',
            'correo_electronico' => 'required|not_in:0|email',
            'celular' => 'required|not_in:0',
            
        ]);
        try {
            
            $buscarCliente = tb_cliente::where('cedula','=', $request->cedula)->first();

           
            $fechaActual = Carbon::now();
            $GrabarCliente = tb_cliente::UpdateOrCreate(
                [
                    'id' => $buscarCliente == null?0:$buscarCliente->id,
                ],
                [
                    
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'cedula' => $request->cedula,
                    'telefono' => $request->celular,
                    'direccion' =>$buscarCliente == null?0:$buscarCliente->direccion,
                    
                    'correo' => $request->correo_electronico,
                    'usu_created' => 1,
                    'usu_update' => 1,
                    'updated_at' => $fechaActual,
                    'created_at' => $fechaActual,
                    'pcip' => 0,
                    'status' => 1,
                ]

            );
            // $lista = tb_sucursal::where('Empresa_Id', 1)
            //              ->get();
            $wasCreated = $GrabarCliente->wasRecentlyCreated;


            return response()->json(['data' => $wasCreated, 'id' => $GrabarCliente->id], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
        }
    }
    public function GetSucursal()
    {
        try {
            $lista = tb_sucursal::where('Empresa_Id', 1)
                         ->get();



            return response()->json(['data' => $lista], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }

    public function GetMesasPorSucursal($id_sucursal)
    {
        try {
            $lista = tb_sucursal_mesa::where('id_sucursal', $id_sucursal)
                         ->get();



            return response()->json(['data' => $lista], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function createSeguimientoTarea(Request $request)
    {

        try {
            //code.
            $user = Auth::user();

            // $var = tbIngresoInfo::All();
            //return  response()->json(['data' =>$user], 200);
            $crear =  tb_sucursal_mesa::UpdateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'id_empresa' => $request->id_empresa,
                    'titulo' => $request->titulo,
                    'observacion' => $request->observacion,
                    'ruta_imagen' => $request->ruta_imagen,
                    'usuario_ingreso' => $user->id,
                    'usuario_modificacion' => $user->id,
                ]

            );
            $fechaActual = Carbon::now();
            if ($request->chk_finalizar) {
                # code...
                $crear = Tareas::UpdateOrCreate(
                    [
                        'id' => $request->id_tareas,
                    ],
                    [

                        'estado_tarea' => 2,
                        'usuario_modificacion' => $user->id,
                        'updated_at' => $fechaActual,
                    ]

                );
            }

            $wasCreated = $crear->wasRecentlyCreated;




            return response()->json(['data' => $wasCreated], 200);
        } catch (Exception $e) {
            return response()->json(['data' => $e->getMessage()], 500);
            //throw $th;
        }
    }
}
