<?php
namespace ibradis\OrangeMoney;

use GuzzleHttp\Client;

class OrangeMoney
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->client = new Client();
        $this->config = config('orange_money');
    }

    public function getAccessToken()
    {
        $response = $this->client->post('https://api.orange.com/oauth/v3/token', [
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($this->config['client_id'].':'.$this->config['client_secret']),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }

    public function createPayment($orderId, $amount, $reference)
    {
        $token = $this->getAccessToken();

        $response = $this->client->post('https://api.orange.com/orange-money-webpay/dev/v1/webpayment', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'merchant_key' => $this->config['merchant_key'],
                'currency' => 'OUV',
                'order_id' => $orderId,
                'amount' => $amount,
                'return_url' => $this->config['return_url'],
                'cancel_url' => $this->config['cancel_url'],
                'notif_url' => $this->config['notif_url'],
                'lang' => 'fr',
                'reference' => $reference,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}