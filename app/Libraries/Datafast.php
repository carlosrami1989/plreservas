<?php

namespace App\Libraries;

class Datafast
{
    private $entityId;
    private $authorization;
    private $baseUrl;

    public function __construct($entityId, $authorization, $baseUrl = 'https://test.oppwa.com/v1')
    {
        $this->entityId = $entityId;
        $this->authorization = $authorization;
        $this->baseUrl = $baseUrl;
    }

    public function getCheckoutId($amount, $currency, $paymentType = 'DB')
    {
        $url = $this->baseUrl . "/checkouts";
        $data = http_build_query([
            'entityId' => $this->entityId,
            'amount' => $amount,
            'currency' => $currency,
            'paymentType' => $paymentType
        ]);

        $response = $this->makeRequest('POST', $url, $data);
        return $response;
    }

    public function getPaymentStatus($resourcePath)
    {
        $url = $this->baseUrl . $resourcePath;
        $url .= "?entityId=" . $this->entityId;

        $url  = str_replace("/v1/v1", "/v1", $url);




        $response = $this->makeRequest('GET', $url);

//        dd($response);
        return $response;
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
            'Authorization: Bearer ' . $this->authorization,
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
}
