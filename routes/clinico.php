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
 


   Route::group(['prefix' => 'modulos/clinico', 'middleware' => ['auth:web'], 'verified'], function () {

    /* SubModulo Medico */
    Route::namespace('Modulos\Administracion')->prefix('reserva')->group(function () {
        //Modulo de Cirugia
        Route::get('cargar_sv/{id}', 'GetValidarUsuario@ReservacionController');
        Route::get('GetReserva/{fechaini}/{fechafin}/{local}', 'ReservacionController@GetReserva');
        //Modulo de genero
        
        
       
    });
   });


  
  