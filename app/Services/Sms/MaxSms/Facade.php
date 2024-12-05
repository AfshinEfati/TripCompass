<?php

namespace App\Services\Sms\MaxSms;

use App\Services\Sms\Sms;
use App\Services\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class Facade implements SmsInterface
{

    public function sendToken(array $data)
    {
        $key = 'vVSdvkIUBlerGynmmJgYBgOlAkdi3sV_ovFbA7Y-PB8=';
        $pattern = 'kmwficl9c1iudv9';
        $base_url = 'https://api2.ippanel.com/api/v1/sms/pattern/normal/send';
        $body = [
            "code" =>$pattern,
            "sender" => "+9810005828366822",
            "recipient" => '+98'.$data['mobile'],
            "variable" => [
                "verification-code" => $data['token'],
            ]
        ];
        return Http::timeout(0)->withHeaders(['apikey'=>$key])->post($base_url, $body);
    }
}
