<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
 

Route::post('insert_mes', [DataController::class, 'store_mes']);
Route::post('insert_dia', [DataController::class, 'store_dia']);
Route::post('insert_gastos', [DataController::class, 'store_gastos']);
Route::get('Consulta_mes', [DataController::class, 'index']);


