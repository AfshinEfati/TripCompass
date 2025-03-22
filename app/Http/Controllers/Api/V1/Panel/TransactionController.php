<?php

namespace App\Http\Controllers\Api\V1\Panel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\TransactionResource;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use StatusTrait;
    public function __construct(public TransactionService $service)
    {
    }

    public function index()
    {
        $transactions = $this->service->getByUserId();
        $transactions = TransactionResource::collection($transactions);
        return $this->successResponse($transactions, 'Transactions retrieved successfully');
    }

    public function store(Request $request)
    {
       return $this->unauthorizedResponse([],'You are not authorized to access this resource');
    }

    public function show(Transaction $transaction)
    {
        return $this->successResponse(TransactionResource::make($transaction), 'Transaction retrieved successfully');
    }

    public function update(Request $request, Transaction $transaction)
    {
        return $this->unauthorizedResponse([],'You are not authorized to access this resource');
    }

    public function destroy(Transaction $transaction)
    {
        return $this->unauthorizedResponse([],'You are not authorized to access this resource');
    }
}
