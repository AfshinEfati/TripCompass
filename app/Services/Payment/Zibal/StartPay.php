<?php

namespace App\Services\Payment\Zibal;

use App\Models\Gateway;
use App\Models\Payment as PaymentModel;
use Exception;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;
use Shetabit\Multipay\RedirectionForm;

class StartPay
{
    public mixed $link;
    public mixed $message;
    public mixed $payable = false;
    public mixed $refId;
    public mixed $bank_id = 1;
    public string $gateway_name = 'زیبال';
    public Gateway $gateway;
    public mixed $response;

    public function __construct(
        PaymentModel $payment,
        string       $callback,
    )
    {
        $this->gateway = $payment->gateway;
        try {
            /** @var RedirectionForm $response */
            $response = \Shetabit\Payment\Facade\Payment::via('zibal')
                ->config([
                    'merchantId' => $this->gateway->config['merchant'],
                    'callbackUrl' => $callback
                ])->callbackUrl($callback)->purchase(
                    (new Invoice)->amount($payment->amount)->detail(['mobile' => '0' . $payment->user->mobile]),
                    function ($driver, $transactionId) {
                    }
                )->pay()->toJson();
            $response = json_decode($response);
            $action = "{$response->action}";
            $refId = basename($action);
            $this->link = $action;
            $this->refId = $refId;
            $this->payable = true;
            $this->message = 'لینک پرداخت با موفقیت ایجاد شد';
            $this->bank_id = $this->gateway->id;
        } catch (Exception $exception) {
            $this->link = null;
            $this->message = $exception->getMessage();
        }
    }

    public function returnData(): array
    {
        return [
            'link' => $this->link,
            'message' => $this->message,
            'payable' => $this->payable,
            'refId' => $this->refId ?? '',
            'bank_id' => $this->bank_id,
            'bank_detail_id' => $this->gateway->id,
            'gateway_name' => $this->gateway_name,
        ];
    }
}
