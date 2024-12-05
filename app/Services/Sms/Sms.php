<?php

namespace App\Services\Sms;

class Sms implements SmsInterface
{

    public function sendToken(array $data)
    {
        $driver = $data['driver'];
        $class = 'App\Services\Sms\\' . $driver . '\Facade';
        $sms = new $class();
        return $sms->sendToken($data);
    }
}
