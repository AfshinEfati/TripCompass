<?php

namespace App\Services\Payment\Zibal;

use Exception;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Exceptions\InvoiceNotFoundException;
use Shetabit\Payment\Facade\Payment;

class Verify
{
    public mixed $reference_id = null;
    public mixed $message;
    public bool $verified = false;
    public mixed $gateway;

    /**
     * @throws InvoiceNotFoundException
     * @throws Exception
     */
    public function __construct(Request $request, \App\Models\Payment $payment)
    {
        $this->gateway = $payment->gateway;
        try {
            $receipt = Payment::via('zibal')
                ->config([
                    'merchantId' => $this->gateway->config['merchant'],
                ])
                ->amount($payment->amount)->verify();
            $this->reference_id = $receipt->getReferenceId();
            $this->verified = true;
            $this->message = 'پرداخت با موفقیت انجام شد';
        } catch (InvalidPaymentException $exception) {
            $this->message = $exception->getMessage();
        }
    }

    public function getLink(): array
    {
        return [
            'reference_id' => $this->reference_id,
            'message' => $this->message,
            'verified' => $this->verified
        ];
    }
}
