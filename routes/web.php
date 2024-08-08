<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    
    return view('layuts.app');
});
Route::get('/izq', function () {
    return view('auth.izquierda');
});
Route::get('/med', function () {
    return view('auth.medio');
});Route::get('/der', function () {
    return view('auth.derecha');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => ['auth:web'], 'verified'], function () {
    Route::get('/logout', 'Modulos\Administracion\tipo_desechos@Salir');
});

 
Route::get('/test', function() {
    return view('auth.register');
 });

 Route::get('/test2', function() {
    return view('auth.forgot-password');
 });

 Route::get('/prueba', function(){

 
// Set the redirect URL back to the site to handle the OAuth2 response. This handles both the success and failure journeys.
//$client->setRedirectUri(URL::to('/') . '/oauth2callback');

//     $event = new Event;

//     $event->name = 'pueba carlos prueba dos';
//     $event->description = 'Event description';
//     $event->startDateTime = Carbon::now();
//     $event->endDateTime = Carbon::now()->addHour();
//     //$event->addScope("https://www.googleapis.com/auth/calendar");
//   $event->addAttendee(['email' => 'cramirez@operoil.com']);
//     $event->save();
//    return $client;
});

 //Route::get('/{any}', function() { return view('your-main-view'); })->where('any', '(.*)');
//  $prefijo = config('global.router_prefix');
//  //$prefijo ="";
//   Route::get($prefijo . '/{any}', 'AppController@index')->where('any', '.*');
//   Route::get($prefijo, 'AppController@index')->where('any', '.*');