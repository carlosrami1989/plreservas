<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Modulos\Parametrizacion\tb_consulta_dia;
use App\Models\Modulos\Parametrizacion\tb_consulta_mes;
use App\Models\Modulos\Parametrizacion\tb_gastos;
use App\Models\Modulos\Parametrizacion\tb_complementos_bi;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['data' => "holaa"], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_complemento(Request $request)
    {


        try {
            $estacion = 0;
            foreach ($request->all() as $item) {
                foreach ($item as $item2) {
                    $estacion == $item2["estacion"];
                     
                }
            }


            
            tb_complementos_bi::query()->where('estacion',$estacion)->delete();
        //    $delete->truncate();

            foreach ($request->all() as $item) {
                foreach ($item as $item2) {
                    tb_complementos_bi::create(

                        [
                            'id' => 0,
                            'mes' => $item2["mes"],
                            'descripcion' => $item2["descripcion"],
                            'galones' => $item2["galones"],
                            'total' => $item2["total"],
                            'estacion' => $item2["estacion"],
                        ]

                    );
                }
            }
            return response()->json([
                'data' => "llego",
                'datallego' => "ok"
            ], 200);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store_mes(Request $request)
    {


        try {
            $estacion = 0;
            // foreach ($request->all() as $item) {
            //     foreach ($item as $item2) {
            //         $estacion == $item2["estacion"];
                     
            //     }
            // }
            $estacion = $request[0][0]["estacion"];


            

         

            
            tb_consulta_mes::where('estacion',$estacion)->delete();
        //    $delete->truncate();

            foreach ($request->all() as $item) {
                foreach ($item as $item2) {
                    tb_consulta_mes::create(

                        [
                            'id' => 0,
                            'mes' => $item2["mes"],
                            'anio' => $item2["anio"],
                            'descripcion' => $item2["descripcion"],
                            'galones' => $item2["galones"],
                            'total' => $item2["total"],
                            'estacion' => $item2["estacion"],
                        ]

                    );
                }
            }
            return response()->json([
                'data' => "llego",
                'datallego' => "ok"
            ], 200);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store_dia(Request $request)
    {


        try {

            $estacion = 0;
            // foreach ($request->all() as $item) {
            //     foreach ($item as $item2) {
            //         $estacion == $item2["estacion"];
                     
            //     }
            // }

            
            $estacion = $request[0][0]["estacion"];


            

            tb_consulta_dia::where('estacion',$estacion)->delete();
        

            //    $delete->truncate();
            // return response()->json([
            //     'data' => "llego",
            //     'datallego' => $lista
            // ], 200);

            foreach ($request->all() as $item) {
                foreach ($item as $item2) {
                    tb_consulta_dia::create(

                        [
                            'id' => 0,
                            'dia' => $item2["dia"],
                            'mes' => $item2["mes"],
                            'anio' => $item2["anio"],
                            'descripcion' => $item2["descripcion"],
                            'galones' => $item2["galones"],
                            'total' => $item2["total"],
                            'estacion' => $item2["estacion"],

                        ]

                    );
                }
            }
            return response()->json([
                'data' => "llego",
                'datallego' => "ok"
            ], 200);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store_gastos(Request $request)
    {
 
        try {

           

            $Lista = [];
           
            $Lista = $request->all();
            // return response()->json([
            //     'data' => "llego",
            //     'datallego' => date("m")
            // ], 200);
            $mes = (int)date("m");
           
        //    $delete->truncate();
        tb_gastos::query()->where('mes',$mes)->delete();

            foreach ($Lista  as $item2) {
       
                    tb_gastos::create(

                        [
                            'id' => 0,
                            'mes' => $item2["mes"],
                            'anio' => $item2["anio"],
                            // 'cia_nombre' => $item2["cia_nombre"],
                            'id_estacion_obrero' => $item2["id"],
                            'id_estacion' => $item2["id_web"],
                            'estacion' => $item2["nombre"],
                            'pc_codcta' => $item2["pc_codcta"],
                            'pc_nomcta' => $item2["pc_nomcta"],
                            'cc_concepto' => $item2["cc_concepto"],
                            'cc_fecha' => $item2["cc_fecha"],
                            // 'cc_persona' => $item2["cc_persona"],
                            'cc_fechagra' => $item2["cc_fecgra"],
                            'dc_glosa' => $item2["dc_glosa"],
                            'dc_valdeb' => $item2["dc_valdeb"],
                            'dc_valhab' => $item2["dc_valhab"],

                        ]

                    );
               
            }
            return response()->json([
                'data' => "llego",
                'datallego' => "ok"
            ], 200);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}