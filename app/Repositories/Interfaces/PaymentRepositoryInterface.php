<?php

namespace App\Repositories\Interfaces;

use App\Models\Payment;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    public function create(array $data): Payment;
    public function findByTransactionId(string $transactionId): ?Payment;
    public function updateStatus(Payment $payment, string $status, ?string $transactionId = null, ?string $failureReason = null): bool;

    public function pay(mixed $validated);

    public function verify(Request $request);
}
