<?php

namespace App\Repositories\Contracts;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Services\PaymentService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
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
     * @throws BindingResolutionException
     */
    public function pay(mixed $validated)
    {
        $payment = App::make(\App\Services\Payment\Payment::class);
        $payment =  $payment->pay($validated);
        dd($payment);
    }
}
