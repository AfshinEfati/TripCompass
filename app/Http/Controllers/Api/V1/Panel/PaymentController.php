<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Panel\Payment\PayRequest;
use App\Http\Resources\Api\Panel\PaymentResource;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use StatusTrait;

    public function __construct(public PaymentService $service)
    {
    }

    public function index()
    {
        $payments = $this->service->getByUserId();
        $payments = PaymentResource::collection($payments);
        return $this->successResponse($payments, 'Payments retrieved successfully');
    }

    public function pay(PayRequest $request)
    {
        $payment = $this->service->pay($request->validated());
        return $this->successResponse($payment, 'Payment created successfully');
    }

    public function verify(Request $request)
    {
        $payment = $this->service->verify($request);
        $payment = PaymentResource::make($payment);
        return $this->successResponse($payment, 'Payment verified successfully');
    }

    public function show(Payment $payment)
    {
        $payment = PaymentResource::make($payment);
        return $this->successResponse($payment, 'Payment retrieved successfully');
    }
}
