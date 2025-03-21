<?php

namespace App\Repositories\Contracts;

use AllowDynamicProperties;
use App\Helpers\ResponseHelper;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Services\GatewayService;
use App\Services\PaymentService;
use App\Traits\PaymentManagement;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

#[AllowDynamicProperties] class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    use PaymentManagement;

    public function __construct(Payment $model, public GatewayService $gatewayService)
    {
        parent::__construct($model);
    }

    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    public function findByTransactionId(string $transactionId): ?Payment
    {
        return Payment::where('transaction_id', $transactionId)->first();
    }

    public function updateStatus(Payment $payment, string $status, ?string $transactionId = null, ?string $failureReason = null): bool
    {
        return $payment->update([
            'status' => $status,
            'transaction_id' => $transactionId,
            'failure_reason' => $failureReason,
        ]);
    }

    /**
     */
    public function pay(mixed $validated)
    {
        $gateway = $this->gatewayService->getGateway();
        $payment = $this->model->create([
            'user_id' => auth()->id(),
            'gateway_id' => $gateway->id,
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);
        $pay = (new \App\Services\Payment\Payment());
        return $pay->pay($payment);
    }

    public function verify(Request $request)
    {
        $this->payment = $this->model->find($request->payment_id);
        $this->request = $request;
        $this->gateway = $this->payment->gateway;
        if ($this->payment->status == 'pending') {
            $payVerify = $this->processBankVerification();
            if ($payVerify['verified']) {
                $this->updateStatus($this->payment, 'success', null, null);
                User::find($this->payment->user_id)->update([
                    'balance' => DB::raw('balance + ' . $this->payment->amount)
                ]);
            }else{
                $this->updateStatus($this->payment, 'failed', null, $payVerify['message']);
            }
        }
        return $this->payment->refresh();

    }

    private function processBankVerification()
    {
        $verificationMethods = [
            'Zibal' => 'verifyZibalPayment',
        ];

        if (isset($verificationMethods[$this->gateway->driver])) {
            $method = $verificationMethods[$this->gateway->driver];
            return $this->$method();
        }
        return ['status' => false, 'message' => 'Gateway driver not found'];
    }

    private function verifyZibalPayment()
    {
        $this->status = $this->getZibalStatus($this->request['status']);
        if ($this->status['status'] === 'payed') {
            $pay = new \App\Services\Payment\Payment();
            return $pay->verify($this->request, $this->payment);
        }
        if ($this->status['status'] === 'done') {
            return ['verified' => true, 'message' => $this->status['provider_response']];
        }
        return ['verified' => false, 'message' => $this->status['provider_response']];
    }

}
