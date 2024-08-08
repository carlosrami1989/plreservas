<?php

namespace App\Http\Controllers\Modulos\Administracion;

use App\Models\Modulos\Administracion\Seguimiento;
use App\Models\Modulos\Administracion\Tareas;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Carbon\Carbon;
use URL;
use Google\Service\Calendar\Calendar;

use Illuminate\Support\Facades\Redirect;

class SeguimientoController extends Controller
{
    public function GetSeguimiento($id_tareas)
    {
        try {
            $listasSeguimiento = Seguimiento::select(
                'id_tareas',
                'titulo',
                'observacion',
                'ruta_imagen',
                'fecha_seguimiento',
                'usuario_ingreso',
            )
                ->datosSeguimiento()
                ->where('id_tareas', $id_tareas)
                ->OrderBy('fecha_seguimiento', 'desc')
                ->get();



            return response()->json(['listasSeguimiento' => $listasSeguimiento], 200);
        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function GetApi()
    {
        try {

            require_once '../vendor/autoload.php';
// Refer to the PHP quickstart on how to setup the environment:
// https://developers.google.com/calendar/quickstart/php
// Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
// credentials.

$event = new Google_Service_Calendar_Event(array(
    'summary' => 'Google I/O 2015',
    'location' => '800 Howard St., San Francisco, CA 94103',
    'description' => 'A chance to hear more about Google\'s developer products.',
    'start' => array(
      'dateTime' => '2015-05-28T09:00:00-07:00',
      'timeZone' => 'America/Los_Angeles',
    ),
    'end' => array(
      'dateTime' => '2015-05-28T17:00:00-07:00',
      'timeZone' => 'America/Los_Angeles',
    ),
    'recurrence' => array(
      'RRULE:FREQ=DAILY;COUNT=2'
    ),
    'attendees' => array(
      array('email' => 'lpage@example.com'),
      array('email' => 'sbrin@example.com'),
    ),
    'reminders' => array(
      'useDefault' => FALSE,
      'overrides' => array(
        array('method' => 'email', 'minutes' => 24 * 60),
        array('method' => 'popup', 'minutes' => 10),
      ),
    ),
  ));
  $client = new Google_Client();
  $calendarId = 'c_75b6a41b1c5094d3b97c845cfcfdd4dca5c0f251d68e11ecf8c2761ffffe7372@group.calendar.google.com';
      $client->setApplicationName("CALENDARIO");
                $client->setDeveloperKey("AIzaSyCS5HQA8hon0qzLjPzhyrN2y75a438uGFw");
              //  $service = new Google\Service\Books($client);
                $service = new  Google_Service_Calendar($client);
  $event = $service->events->insert($calendarId, $event);
  printf('Event created: %s\n', $event->htmlLink);
            // $client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json'));
            // $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
            // $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            // $client->setPrompt('select_account consent');
            // $client->setRedirectUri($redirect_uri);
            // if (!isset($_GET['code'])) {
            //     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            // }
            //    $client->setApplicationName("CALENDARIO");
            // $client->setDeveloperKey("86687403788-2m0vu5nvanfde09vior0bu6rc6g7itkt.apps.googleusercontent.com");
            // $service = new Google_Service_Calendar($client);
            // $query = 'Henry David Thoreau';
            // $optParams = [
            //   'filter' => 'free-ebooks',
            // ];
            // $results = $service->volumes->listVolumes($query, $optParams);

            // foreach ($results->getItems() as $item) {
            //     $item['volumeInfo']['title'], "<br /> \n";
            // } 




            // require_once  '../vendor/autoload.php';
            //     $client = new Google_Client();
            //     $client->setApplicationName("CALENDARIO");
            //     $client->setDeveloperKey("AIzaSyCS5HQA8hon0qzLjPzhyrN2y75a438uGFw");
            //   //  $service = new Google\Service\Books($client);
            //     $service = new  Google_Service_Calendar($client);
            //     $query = 'Henry David Thoreau';
            //     // $optParams = [
            //     // 'filter' => 'free-ebooks',
            //     // ];
            //     $results = $service->volumes->listVolumes($query, $optParams);

            //     $client = new Google_Client();
            // $client->setApplicationName('CALENDARIO');
            // $client->setScopes('https://www.googleapis.com/auth/calendar.readonly');
            // $client->setAuthConfig(storage_path('app/google-calendar/service-account-credentials.json'));
            // $client->setAccessType('offline');
            // $client->setRedirectUri("http://127.0.0.1");
            // $client->setPrompt('select_account consent');

            // $tokenPath = storage_path('app/google-calendar/oauth-token.json');

            // if (!file_exists(dirname($tokenPath))) {
            //     mkdir(dirname($tokenPath), 0700, true);
            // }
            // file_put_contents($tokenPath, json_encode($client->getAccessToken()));


            // if (file_exists($tokenPath)) {
            //      //   dd();
            //     $accessToken = json_decode(file_get_contents($tokenPath), true);
            //     $client->setAccessToken($accessToken);
            //     return  response()->json(['listasSeguimiento' =>"entr"], 200);
            // }
            return response()->json(['listasSeguimiento' => $client], 200);

        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    public function GetApiAcces()
    {
        try {
            require_once '../vendor/autoload.php';

            $client = new Google_Client();
            $client->setAuthConfig(storage_path('app/google-calendar/oauth-credentials.json'));
            $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
            $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

            $tokenPath = storage_path('app/google-calendar/oauth-token.json');

            // if (!file_exists(dirname($tokenPath))) {
            //     mkdir(dirname($tokenPath), 0700, true);
                $auth_url = $client->createAuthUrl();
             // return view( header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL))); 
            // }else {
            //      mkdir(dirname($tokenPath), 0700, true);
            //     file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            //     // $client->authenticate($_GET['code']);
            //     // $_SESSION['access_token'] = $client->getAccessToken();
            //     $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            //     header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

            // }



            // if (!isset($_GET['code'])) {
              
            // } else {
            //     $client->authenticate($_GET['code']);
            //     $_SESSION['access_token'] = $client->getAccessToken();
            //     $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            //     header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

            // }
            //   $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
            //  $texto = "Open the following link in your browser:\n%s\n"+$authUrl;
            // print 'Enter verification code: ';
            // $authCode = trim(fgets(STDIN));

            // // Exchange authorization code for an access token.
            // $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

            // $client->setAccessToken($accessToken);

            //     $tokenPath = storage_path('app/google-calendar/oauth-token.json');

            // if (!file_exists(dirname($tokenPath))) {
            //     mkdir(dirname($tokenPath), 0700, true);
            // }
            // file_put_contents($tokenPath, json_encode($client->getAccessToken()));


            // if (file_exists($tokenPath)) {
            //      //   dd();
            //     $accessToken = json_decode(file_get_contents($tokenPath), true);
            //     $client->setAccessToken($accessToken);
            return  response()->json(['listasSeguimiento' =>filter_var($auth_url, FILTER_SANITIZE_URL)], 200);
            // }
            // return  $client;

        } catch (Exception $e) {
            return response()->json(['mensaje' => $e->getMessage()], 500);
        }
    }
    //

    //
    public function createSeguimientoTarea(Request $request)
    {

        try {
            //code.
            $user = Auth::user();
            // $var = tbIngresoInfo::All();
            //return  response()->json(['data' =>$user], 200);
            $crear = Seguimiento::UpdateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'id_tareas' => $request->id_tareas,
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