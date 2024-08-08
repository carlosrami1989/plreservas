<?php

namespace App\Http\Controllers\Modulos\Transporte;

use App\Http\Controllers\Controller;
use App\Imports\GuiasUpload;
use Illuminate\Http\Request;
use App\Models\Modulos\Parametrizacion\tb_cliente;
use App\Models\Modulos\Parametrizacion\tb_descripcion_check;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuiasImport;
use App\Models\Modulos\Parametrizacion\tb_guias_upload;
use App\Models\Modulos\Parametrizacion\tb_orden_comp;

class CalidadFlotaController extends Controller
{
    //
    public function ConsultarCliente()
    {
        try {


            $Lista = tb_cliente::All();


            return response()->json(['data' => $Lista], 200);

        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }
    //App\Models\Modulos\Parametrizacion;
    public function ConsultarDescripcion()
    {
        try {


            $Lista = tb_descripcion_check::with('Items')->get();


            return response()->json(['data' => $Lista], 200);

        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }
    function GetConsultar($id)
    {
        try {
            $lista = 0;
            $lista = tb_guias_upload::where('orden', $id)->count();
            return $lista;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function GetConsultarOrden($fechaini,$fechafin,$orden,$guia)
    {
        try {
        
            $listaR = tb_guias_upload::with('OrdenLis')->get();

            return response()->json(['data' => $listaR], 200);

        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
            //throw $th;
        }
    }
    public function UploadGuias(Request $request)
    {
        try {


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                // $request->file('archivo')->store('public');

                $name = $file->getClientOriginalName();
                $ruta = storage_path("/app/" . $name);
                $var = copy($file, $ruta);
                sleep(4);
               // $path = storage_path('app') . '\\' . $name;
                $path = storage_path("/app/" . $name);

                $data = Excel::toCollection(collect([]), $path);

                $Lista = [];
                foreach ($data as $value) {
                    # code...
                    foreach ($value as $item) {
                        # code...
                        array_push($Lista, $item);
                    }

                    // }
                }
                unset($Lista[0]);
                unset($Lista[1]);



                // tb_guias_upload::created($var);

            }

            $listaFinal = [];
          
            foreach ($Lista as $key => $value) {
                $objeto = array();

                $listaContador = tb_guias_upload::where('orden', $value[1])->first();

                if ( $listaContador == null || $listaContador == "" ) {
                    # code...
                    $var = new tb_guias_upload();
                   //  return response()->json(['data' =>date('Y-m-d')], 200);
           
                    $objeto['id'] = $value[1];
                   // $var->id = 0;

                    $objeto['orden'] = $value[1];
                    $var->orden = $value[1];

                    $objeto['cliente'] = $value[2];
                    $var->cliente = $value[2];

                    $objeto['estacion'] = $value[3];
                    $var->estacion = $value[3];
                    
                    $objeto['codigo'] = $value[4];
                    $var->codigo = $value[4];

                    $objeto['cod_estacion'] = $value[5];
                    $var->cod_estacion = $value[5];

                    $objeto['fecha_emision'] = $value[7];
                    $var->fecha_emision = $value[7];

                    $objeto['fecha_vencimiento'] = $value[8];
                    $var->fecha_vencimiento = $value[8];

                    $objeto['fecha_venta'] = $value[9];
                    $var->fecha_venta = $value[9];

                    $objeto['volumen'] = $value[10];
                    $var->volumen = $value[10];

                    $objeto['producto'] = $value[11];
                    $var->producto = $value[11];

                    $objeto['valor'] = $value[12];
                    $var->valor = $value[12];

                    $objeto['factura'] = $value[13];
                    $var->factura = $value[13];

                    $objeto['autorizacion'] = $value[14];
                    $var->autorizacion = $value[14];

                    $objeto['fecha_autorizacion'] =  $value[15];
                    $var->fecha_autorizacion =$value[15] != null||  $value[15] == ""?date('Y/m/d') : $value[15];

                    $objeto['clave_acceso'] = $value[16];
                    $var->clave_acceso = $value[16];

                    $objeto['correo'] = $value[17];
                    $var->correo = $value[17];

                    $objeto['identificacion'] = $value[19];
                    $var->identificacion = $value[19];

                    $objeto['estado_upload'] = $value[0];
                    $var->estado_upload = $value[0];

                    $objeto['estado_orden'] = 1;
                    $var->estado_orden = 1;

                    $objeto['estado_existe'] = 0;
                   // $var->estado_existe = 0;

                    $var->save();

                    $objeto['id'] = $var->id;
    

                }else{
                    $objeto['id'] = $listaContador->id;
                    $objeto['orden'] = $listaContador->orden;
                    $objeto['cliente'] = $value[2];
                    $objeto['estacion'] = $value[3];
                    $objeto['codigo'] = $value[4];
                    $objeto['cod_estacion'] = $value[5];
                    $objeto['fecha_emision'] = $value[7];
                    $objeto['fecha_vencimiento'] = $value[8];
                    $objeto['fecha_venta'] = $value[9];
                    $objeto['volumen'] = $value[10];
                    $objeto['producto'] = $value[11];
                    $objeto['valor'] = $value[12];
                    $objeto['factura'] = $value[13];
                    $objeto['autorizacion'] = $value[14];
                    $objeto['fecha_autorizacion'] = $value[15];
                    $objeto['clave_acceso'] = $value[16];
                    $objeto['correo'] = $value[17];
                    $objeto['identificacion'] = $value[19];
                    $objeto['estado_upload'] = $value[0];
                    $objeto['estado_orden'] = 1;
                    $objeto['estado_existe'] = 1;
                }
              


               

                array_push($listaFinal, $objeto);
                
            }
            //  tb_guias_upload::created($var);
            // return redirect()->back();
            return response()->json(['data' => $listaFinal], 200);
            


        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }


    public function UpdateComplemento(Request $request)
    {
        try {
            $request->validate([
                'guia' => 'required|not_in:0',
                'id_estacion_w' => 'required|not_in:0',
                // 'estacion_w' => 'required|not_in:0',
                'orden' => 'required|not_in:0',
                'placa' => 'required|not_in:0',
                'km' => 'required',
                'galones' => 'required|not_in:0',
                'observacion' => 'required|not_in:0',
            ]);

            $orden_count = tb_orden_comp::where('orden', $request->orden)->get();

            if (count($orden_count) > 0) {
                # code...
                return response()->json(['data' => 'YA EXISTE UNA ORDEN GENERADA','status' => 0], 200);
            }

            $guias_count = tb_orden_comp::where('guia', $request->guia)->get();

            if (count($guias_count) > 0) {
                # code...
                return response()->json(['data' => 'YA EXISTE UNA ORDEN CON EL NUMERO DE GUIA','status' => 1], 200);
            }


            $createOrden = new tb_orden_comp();

            $createOrden->orden =  $request->orden;
            $createOrden->cliente =  $request->cliente;
            $createOrden->estacion =  $request->estacion;
            $createOrden->codigo =  $request->codigo;
            $createOrden->cod_estacion =  $request->cod_estacion;
            $createOrden->id_estacion_w =  $request->id_estacion_w["id"];
            $createOrden->estacion_w =  $request->id_estacion_w["descripcion"];
            $createOrden->fecha_emision =  $request->fecha_emision;
            $createOrden->fecha_vencimiento =  $request->fecha_vencimiento;
            $createOrden->fecha_venta =  $request->fecha_venta;
            $createOrden->guia =  $request->guia;
            $createOrden->nombre =  $request->nombre;
            $createOrden->placa =  $request->placa;
            $createOrden->km =  $request->km;
            $createOrden->estado_upload =  "LIQ";
            $createOrden->observacion =  $request->observacion;
            $createOrden->estado_orden =  1;

            $createOrden->save();
            $crear = tb_guias_upload::UpdateOrCreate([
                'orden'=>$request->orden,
            ],
            [   
                'estado_upload' =>  "LIQ",
                'updated_at'=> date('Y/m/d'), 
                
            ]
    
            );
           
            


          
           
            //  tb_guias_upload::created($var);
            // return redirect()->back();
            return response()->json(['data' => $createOrden,'status' => 2], 200);
            


        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }
}