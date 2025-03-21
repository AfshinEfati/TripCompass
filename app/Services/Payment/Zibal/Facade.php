<?php

namespace App\Services\Payment\Zibal;

use App\Models\Payment;
use App\Services\Payment\PaymentInterface;
use Illuminate\Http\Request;

class Facade implements PaymentInterface
{

    public function startPay(Payment $payment, string $callback): array
    {
        return (new StartPay($payment,$callback))->returnData();
    }

    public function verify(Request $request, Payment $payment)
    {
        return (new Verify($request, $payment))->getLink();
    }
}
