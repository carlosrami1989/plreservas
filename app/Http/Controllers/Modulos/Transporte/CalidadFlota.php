<?php

namespace App\Http\Controllers\Modulos\Transporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalidadFlota extends Controller
{
    //
    public function ConsultarCliente($placa){
        try {
            $Lista = tb_cliente::where('placa',$placa)->get();
             
           
                return  response()->json(['data' => $Lista], 200);
          
        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }
}
