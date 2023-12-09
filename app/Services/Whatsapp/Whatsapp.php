<?php

namespace App\Services\Whatsapp;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class Whatsapp
{
    protected mixed $api_key;
    
    public function __construct()
    {
        $this->api_key = config('services.whatsapp.api_key');
    }
    
    public function checkContact()
    {
        $client = new Client();

        $response = $client->post(
            'https://waba.ivosights.com/api/v1/contacts/check',
            [
                'headers' => [
                    'X-API-KEY' => $this->api_key,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'contacts' => [
                        '+6285156028260',
                    ],
                ],
            ]
        );
    }

    public function sendOTP($whatsappId, $code)
    {
        $client = new Client();
        
        $client->post(
            'https://waba.ivosights.com/api/v1/messages/send-template-message',
            [
                'headers' => [
                    'X-API-KEY' => $this->api_key,
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'wa_id' => $whatsappId,
                    'template_id' => '65681ff040d1cd74864d8882',
                    "components" => [
                        [
                            "type" => "body",
                            "parameters" => [
                                [
                                    "type" => "text",
                                    "text" => $code
                                ]
                            ]
                        ],
                        [
                            "type" => "button",
                            "sub_type" => "url",
                            "index" => 0,
                            "parameters" => [
                                [
                                    "type" => "text",
                                    "text" => $code
                                ]
                            ]
                        ]
                    ],
                ],
            ]
        );
    }
}
