<?php

namespace App\Http\Controllers\Modulos\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatafastService;
use App\Models\Modulos\Parametrizacion\tb_datafast;


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

        $url = "https://test.oppwa.com/v1/checkouts";
        $data = http_build_query([
            'entityId' =>'8ac7a4c88fbf34f6018fc0b90e47029c',
            'amount' => 10.12,
            'currency' => 'USD',
            'paymentType' =>'DB',
            'customer.givenName' =>'Carlos',
            'customer.middleName' =>'Enrique',
            'customer.surname' =>'Ramirez Victor',
            'customer.ip' =>'192.168.10.1',
            'customer.merchantCustomerId' =>'00000000001',
            'merchantTransactionId' =>'00001',
            'customer.email' =>'tic@pizzalibregye.com',
            'customer.identificationDocType' =>'IDCARD',
            'customer.identificationDocId' =>'0930066691',
            'customer.phone' =>'0980956053',
            'billing.street1' =>'sur',
            'billing.country' =>'EC',
            'shipping.street1' =>'sur',
            'shipping.country' =>'EC',
            'customParameters[SHOPPER_ECI]' =>'0103910',
            'customParameters[SHOPPER_PSERV]' =>'17913101',
            'customParameters[SHOPPER_VAL_BASE0]' =>10,
            'customParameters[SHOPPER_VAL_BASEIMP]' =>0,
            'customParameters[SHOPPER_VAL_IVA]' =>0.12,
            'customParameters[SHOPPER_MID]' =>'1000000505',
            'customParameters[SHOPPER_TID]' =>'PD100406',
            'risk.parameters[USER_DATA2]' =>'DATAFAST',
            'customParameters[SHOPPER_VERSIONDF]' =>'2',
            'testMode' =>'EXTERNAL',
            'cart.items[0].name' =>'RESERVA WEB',
            'cart.items[0].description' =>'RESERVA WEB PIZZA LIBRE',
            'cart.items[0].price' =>10,
            'cart.items[0].quantity' => 1,

        ]);

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
            'Authorization: Bearer ' . 'OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA==',
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
         $resourcePath = $request->input('resourcePath');
     
        $url = "https://test.oppwa.com/v1" . $resourcePath;
         $url .= "?entityId=" . "8ac7a4c88fbf34f6018fc0b90e47029c";

         $url  = str_replace("/v1/v1", "/v1", $url);




        $response = $this->makeRequest('GET', $url);

        // $create = tb_datafast::create([
        //     'id'=>0, 
        //     'ndc'=> $response["ndc"], 
        //     'codigo'=> $response["result"]['code'], 
        //     'mensaje'=> $response["result"]['description'], 
        //     'holder'=>$response["card"]['holder'], 
        //     'des_campo1'=> "0", 

        // ]);

//        dd($response);
       
return view('payment.status', ['statusResponse' => $response]);

//return response()->json(['data' =>   $response], 200);
    }
}
