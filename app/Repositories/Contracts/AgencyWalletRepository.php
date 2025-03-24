<?php

namespace App\Repositories\Contracts;

use App\Repositories\Interfaces\AgencyWalletRepositoryInterface;
use App\Models\AgencyWallet;
use App\Repositories\BaseRepository;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyWalletRepository extends BaseRepository implements AgencyWalletRepositoryInterface
{
    public function __construct(AgencyWallet $model, public TransactionService $transactionService)
    {
        parent::__construct($model);
    }

    public function charge(mixed $validated)
    {
        $user = auth()->user();
        $wallet = $this->model->firstOrNew([
            'agency_id' => $validated['agency_id'],
        ]);
        $wallet->balance = ($wallet->balance ?? 0) + $validated['amount'];
        $wallet->save();
        $user->update(['balance' => $user->balance - $validated['amount']]);
        $this->transactionService->store([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'type' => 'withdraw',
            'agency_id' => $validated['agency_id'],
            'wallet_id' => $wallet->id,
            'description' => "شارژ کیف پول آژانس {$wallet->agency->name_fa}"
        ]);
        return $wallet;
    }
}
