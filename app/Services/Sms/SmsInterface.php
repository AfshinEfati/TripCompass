<?php

namespace App\Services\Sms;

interface SmsInterface
{
    public function sendToken(array $data);
}
