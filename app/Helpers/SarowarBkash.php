<?php

namespace App\Helpers;
use SarowarBkashHelper;

class SarowarBkash
{
 use SarowarBkashHelper;

    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl;
    }
    private function baseUrl()
    {
        if (config("bkash.sandbox") == true) {
            $this->baseUrl = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized';
        } else {
            $this->baseUrl = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized';
        }
    }

    protected function headers()
    {
        return [
            "Content-Type"     => "application/json",
            "X-KM-IP-V4"       => $this->getIp(),
            "X-KM-Api-Version" => "v-0.2.0",
            "X-KM-Client-Type" => "PC_WEB"
        ];
    }

}