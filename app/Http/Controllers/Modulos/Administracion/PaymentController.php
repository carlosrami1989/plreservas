<?php

namespace App\Http\Controllers\Modulos\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatafastService;
use App\Models\Modulos\Parametrizacion\tb_datafast;
use Exception;

class PaymentController extends Controller
{
    //
    protected $datafastService;

    public function __construct(DatafastService $datafastService)
    {
        $this->datafastService = $datafastService;
    }

    public function createPayment(Request $request)
    {

        /// se hace validacion de que los montos sean correcto

    //     $amount = $request->amount;
    //    // $currency = $request->input('currency');
    //     $currency = 'USD';

    //     $response = $this->datafastService->createCheckout($amount, $currency);


        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";

        $url = "https://eu-prod.oppwa.com/v1/checkouts";
        $data = http_build_query([
                'entityId' =>'8ac9a4ce91c263070191c77866491ba4',
                'amount' => $request->amount,
                'currency' => 'USD',
                'paymentType' =>'DB',
                'customer.givenName' =>$request->givenName,
                'customer.middleName' =>$request->middleName,
                'customer.surname' =>$request->apellidos,
                'customer.ip' =>$request->ip,
                'customer.merchantCustomerId' =>$request->merchantCustomerId,
                'merchantTransactionId' =>$request->merchantTransactionId,
                'customer.email' =>$request->email,
                'customer.identificationDocType' =>'IDCARD',
                'customer.identificationDocId' =>$request->identificationDocId,
                'customer.phone' =>$request->phone,
                // 'billing.street1' =>$request->street1,
                // 'billing.country' =>$request->country,
                // 'shipping.street1' =>$request->street1,
                // 'shipping.country' =>$request->country,
                
                      'billing.street1' =>'sur',
            'billing.country' =>'EC',
            'shipping.street1' =>'sur',
            'shipping.country' =>'EC',
                'customParameters[SHOPPER_ECI]' =>'0103910',
                'customParameters[SHOPPER_PSERV]' =>'17913101',
                'customParameters[SHOPPER_VAL_BASE0]' =>$request->SHOPPER_VAL_BASE0,
                'customParameters[SHOPPER_VAL_BASEIMP]' =>$request->SHOPPER_VAL_BASEIMP,
                'customParameters[SHOPPER_VAL_IVA]' =>$request->SHOPPER_VAL_IVA,
                'customParameters[SHOPPER_MID]' =>'4100006439',
                'customParameters[SHOPPER_TID]' =>'BP458387',
                'risk.parameters[USER_DATA2]' =>'RESERVA PIZZALIBRE',
                'customParameters[SHOPPER_VERSIONDF]' =>'2',
               // 'testMode' =>'EXTERNAL',
                'cart.items[0].name' =>'RESERVA WEB',
                'cart.items[0].description' =>'RESERVA WEB PIZZA LIBRE',
                'cart.items[0].price' =>$request->valor_reserva,
                'cart.items[0].quantity' => $request->cantidad,
    
            ]);

        // $data = http_build_query([
        //     'entityId' =>'8ac9a4ce91c263070191c77866491ba4',
        //     'amount' => 1.12,
        //     'currency' => 'USD',
        //     'paymentType' =>'DB',
        //     'customer.givenName' =>'Carlos',
        //     'customer.middleName' =>'Enrique',
        //     'customer.surname' =>'Ramirez Victor',
        //     'customer.ip' =>'192.168.10.1',
        //     'customer.merchantCustomerId' =>'00000000001',
        //     'merchantTransactionId' =>'00001',
        //     'customer.email' =>'tic@pizzalibregye.com',
        //     'customer.identificationDocType' =>'IDCARD',
        //     'customer.identificationDocId' =>'0930066691',
        //     'customer.phone' =>'0980956053',
        //     'billing.street1' =>'sur',
        //     'billing.country' =>'EC',
        //     'shipping.street1' =>'sur',
        //     'shipping.country' =>'EC',
        //     'customParameters[SHOPPER_ECI]' =>'0103910',
        //     'customParameters[SHOPPER_PSERV]' =>'17913101',
        //     'customParameters[SHOPPER_VAL_BASE0]' =>1,
        //     'customParameters[SHOPPER_VAL_BASEIMP]' =>0,
        //     'customParameters[SHOPPER_VAL_IVA]' =>0.12,
        //     'customParameters[SHOPPER_MID]' =>'4100006439',
        //     'customParameters[SHOPPER_TID]' =>'BP458387',
        //     'risk.parameters[USER_DATA2]' =>'RESERVA PIZZALIBRE',
        //     'customParameters[SHOPPER_VERSIONDF]' =>'2',
        //    // 'testMode' =>'EXTERNAL',
        //     'cart.items[0].name' =>'RESERVA WEB',
        //     'cart.items[0].description' =>'RESERVA WEB PIZZA LIBRE',
        //     'cart.items[0].price' =>1,
        //     'cart.items[0].quantity' => 1,

        // ]);

        $response = $this->makeRequest('POST', $url, $data);



        return response()->json(['data' =>   $response], 200);
        //return view('payment.checkout', ['response' => $response]);
    }
    private function makeRequest($method, $url, $data = null)
    {
        $ch = curl_init();

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . 'OGFjOWE0Y2U5MWMyNjMwNzAxOTFjNzc0MmRhYzFiNWV8JUVCVXJUK3g/NjVNZlhVWkxvQmQ=',
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        return json_decode($response, true);
    }
    public function paymentStatus(Request $request)
    {
        try {
            //code...
            $resourcePath = $request->input('resourcePath');
     
        $url = "https://eu-prod.oppwa.com/v1" . $resourcePath;
         $url .= "?entityId=" . "8ac9a4ce91c263070191c77866491ba4";

         $url  = str_replace("/v1/v1", "/v1", $url);




        $response = $this->makeRequest('GET', $url);

        $create = tb_datafast::create([
            'id'=>0, 
            'ndc'=> $response["ndc"], 
            'codigo'=> $response["result"]['code'], 
            'mensaje'=> $response["result"]['description'], 
            'holder'=>$response["card"]['holder'], 
            'des_campo1'=> "0", 

        ]);

        return view('payment.status', ['statusResponse' => $response]);

        } catch (Exception $e) {

            return view('payment.status', ['statusResponse' => $e->getMessage()]);
            //throw $th;
          
        }
         
//        dd($response);
       


//return response()->json(['data' =>   $response], 200);
    }
}
