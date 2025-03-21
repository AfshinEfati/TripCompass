<?php

namespace App\Services\Payment;

use Illuminate\Http\Request;

interface PaymentInterface
{
    public function startPay(\App\Models\Payment $payment, string $callback);

    public function verify(Request $request, \App\Models\Payment $payment);
}
