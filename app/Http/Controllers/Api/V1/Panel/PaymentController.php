<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Payment\PayRequest;
use App\Services\PaymentService;
use App\Traits\StatusTrait;
use Illuminate\Support\Facades\Request;

class PaymentController extends Controller
{
    use StatusTrait;

    public function __construct(public PaymentService $service)
    {
    }

    public function pay(PayRequest $request)
    {
        $payment = $this->service->pay($request->validated());
        return $this->successResponse($payment, 'Payment created successfully');
    }

    public function verify(Request $request)
    {
        $payment = $this->service->verify($request);
    }
}
