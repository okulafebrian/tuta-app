<?php

namespace App\Services\Whatsapp;

use Illuminate\Support\Facades\Http;

class Whatsapp
{
    protected mixed $api_key;
    protected mixed $wa_contact_check_url;
    protected mixed $wa_send_template_message_url;
    
    public function __construct()
    {
        $this->api_key = config('services.whatsapp.api_key');
        $this->wa_send_template_message_url = config('services.whatsapp.wa_send_template_message_url');
    }

    public function sendOTP($whatsappId, $code)
    {   
        $data = [
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
        ];

        $headers = [
            'X-API-KEY' => $this->api_key,
            'Accept' => 'application/json',
        ];

        return Http::withHeaders($headers)->post($this->wa_send_template_message_url, $data)->json();
    }
}
