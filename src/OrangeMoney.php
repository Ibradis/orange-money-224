<?php

namespace Ibradis\OrangeMoney;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OrangeMoney
{
    protected Client $client;
    protected array $config;

    public function __construct()
    {
        $this->client = new Client();
        $this->config = config('orange_money');
    }

    /**
     * Générer le token d'authentification
     */
    public function getAccessToken(): string
    {
        try {
            $response = $this->client->post('https://api.orange.com/oauth/v3/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->config['client_id'] . ':' . $this->config['client_secret']),
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Accept'        => 'application/json',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'] ?? throw new \Exception('Token non récupéré');
        } catch (RequestException $e) {
            throw new \Exception('Erreur getAccessToken : ' . $e->getMessage());
        }
    }

    /**
     * Créer un paiement
     */
    public function createPayment(string $orderId, float $amount, string $reference): array
    {
        try {
            $token = $this->getAccessToken();

            $response = $this->client->post($this->config['base_url'] . '/webpayment', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                ],
                'json' => [
                    'merchant_key' => $this->config['merchant_key'],
                    'currency'     => 'OUV',
                    'order_id'     => $orderId,
                    'amount'       => $amount,
                    'return_url'   => $this->config['return_url'],
                    'cancel_url'   => $this->config['cancel_url'],
                    'notif_url'    => $this->config['notif_url'],
                    'lang'         => 'fr',
                    'reference'    => $reference,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception('Erreur createPayment : ' . $e->getMessage());
        }
    }

    /**
     * Vérifier le statut d'une transaction
     */
    public function checkStatus(string $orderId, float $amount, string $payToken, string $token = ""): array
    {
        try {
            $token = $token ?? $this->getAccessToken();

            $response = $this->client->post($this->config['base_url'] . '/transactionstatus', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                ],
                'json' => [
                    'order_id'  => $orderId,
                    'amount'    => $amount,
                    'pay_token' => $payToken,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \Exception('Erreur checkStatus : ' . $e->getMessage());
        }
    }
}
