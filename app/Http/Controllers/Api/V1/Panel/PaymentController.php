<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Payment\PayRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(public PaymentService $service)
    {
    }

    public function pay(PayRequest $request)
    {
        $payment = $this->service->pay($request->validated());
    }
}
