<?php

namespace App\Http\Controllers\Modulos\Administracion;
use App\Models\Modulos\Administracion\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;


class PersonaController extends Controller
{
    //
    //
    public function ConsultarPersona($apellidos){
        try {
            $persona = Persona::All();
           
                return  response()->json(['persona' => $persona], 200);
          
        } catch (Exception $e) {
            return response()->json(['msj' => $e->getMessage()], 500);
        }
    }

   
}
