<?php

namespace App\Services\Payment;

use App\Models\Gateway;
use App\Repositories\Interfaces\GatewayRepositoryInterface;
use App\Services\GatewayService;
use App\Traits\PaymentManagement;
use App\Models\Payment as PaymentModel;

class Payment
{
    use PaymentManagement;

    private GatewayService $gatewayService;
    public function __construct()
    {

    }
    public function pay(PaymentModel $payment)
    {
        $gateway1 = $payment->gateway;

        $paymentData = $this->prepareForPay($payment->id);
        $callback = $paymentData['verifyUrl'];
        $driver = ucfirst($gateway1->driver);
        $class = 'App\Services\Payment\\' . $driver . '\Facade';
        $gateway = new $class();
        return $gateway->startPay($payment, $callback);
    }

    public function verify(\Illuminate\Http\Request $request, PaymentModel $payment)
    {
        $gateway = $payment->gateway;
        $driver = ucfirst($gateway->driver);
        $class = 'App\Services\Payment\\' . $driver . '\Facade';
        $gateway = new $class();
        return $gateway->verify($request, $payment);
    }

}
