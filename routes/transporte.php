<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'modulos/transporte', 'middleware' => ['auth:web'], 'verified'], function () {

    /* SubModulo Medico */
    Route::namespace('Modulos\Transporte')->prefix('transporte')->group(function () {
        //Modulo de tareas
        Route::get('GetCliente', 'CalidadFlotaController@ConsultarCliente');
        Route::get('GetDescripcion', 'CalidadFlotaController@ConsultarDescripcion');

        Route::post('subir', 'CalidadFlotaController@UploadGuias');

        Route::get('GetOrden/{fechaini}/{fechafin}/{orden}/{guia}', 'CalidadFlotaController@GetConsultarOrden');
        Route::post('UpdateOrden', 'CalidadFlotaController@UpdateComplemento');


 
        // Route::post('createTarea', 'CalidadFlotaController@createTarea');
    });
   });

   $prefijo = config('global.router_prefix');
   //$prefijo ="";
    Route::get($prefijo . '/{any}', 'AppController@index')->where('any', '.*');
    Route::get($prefijo, 'AppController@index')->where('any', '.*');